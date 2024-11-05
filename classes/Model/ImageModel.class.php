<?php

class ImageModel
{

    function __construct() {}

    /**
     * Encuentra las imagenes duplicadas
     * @return array
     * @throws Exception
     * 
     * */
    function encontrarImaganesDuplicadas()
    {
        $link = Model::getInstancia()->getConexion();
        try {
            // Encontrar imagenes duplicadas
            $stmt = $link->prepare(
                "SELECT product_id, image_id, COUNT(*) AS duplicates_count
                    FROM product_images GROUP BY product_id, image_id HAVING COUNT(*) > 1;"
            );
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception("No se ha encontrar las imagenes duplicadas");
            }

            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al encontrar las imagenes: " . $e->getMessage());
        }
    }

    /**^
     * Elimina las imagenes duplicadas
     * @return int
     * @throws Exception
     */

    function eliminarImagenesDuplicadas()
    {

        $link = Model::getInstancia()->getConexion();

        try {
            // Iniciar transacción
            $link->beginTransaction();
            $stmt = $link->prepare(" DELETE pi
        FROM
            product_images pi
        INNER JOIN (
            SELECT
                product_id,
                image_id,
                MIN(product_image_id) AS min_id
            FROM
                product_images
            GROUP BY
                product_id,
                image_id
            HAVING
                COUNT(*) > 1
        ) duplicates ON
            pi.product_id = duplicates.product_id AND
            pi.image_id = duplicates.image_id AND
            pi.product_image_id > duplicates.min_id;");

            $stmt->execute();
            $link->commit();
            // Devolver el número de filas afectadas
            return $stmt->rowCount();
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $link->rollback();
            throw new Exception("Error al eliminar las imagenes: " . $e->getMessage());
        }
    }


    /**
     * Corrige las imagenes primarias duplicadas
     * @return int
     * @throws Exception
     * 
     */
    function corregirImagenesPrimariasDuplicadas()
    {
        $link = Model::getInstancia()->getConexion();
        try {
            $link->beginTransaction();
            $stmt = $link->prepare(
                "UPDATE
            product_images pi
        INNER JOIN (
            SELECT
                product_id,
                MAX(product_image_id) AS latest_image_id
            FROM
                product_images
            WHERE
                cover = TRUE
            GROUP BY
                product_id
            HAVING
                COUNT(*) > 1
        ) latest ON
            pi.product_id = latest.product_id
        SET
            pi.cover = FALSE
        WHERE
            pi.cover = TRUE AND
            pi.product_image_id < latest.latest_image_id;"
            );

            $stmt->execute();
            $link->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $link->rollback();
            throw new Exception("Error al corregir las imagenes: " . $e->getMessage());
        }
    }
}

