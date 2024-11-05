<?php

class CommentModel
{

    function __construct() {}
    /**
     * Recupera los comentarios de la API y actualiza los campos vacíos en la base de datos
     * @return array Resultado de la operación con detalles
     */
    function recuperarComentarios()
    {
        $link = Model::getInstancia()->getConexion();
        $result = [
            'success' => false,
            'updated_comments' => 0,
            'errors' => [],
            'messages' => [],
        ];

        try {
            $link->beginTransaction();
            // 1. Obtener todos los comentarios que tienen campos vacíos
            $sql = "SELECT id FROM comments WHERE name IS NULL OR email IS NULL OR comment IS NULL";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $commentsToUpdate = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($commentsToUpdate)) {
                $result['messages'][] = "No hay comentarios vacíos para actualizar.";
                $link->commit();
                $result['success'] = true;
                return $result;
            } else {
                $result['messages'][] = "Comentarios encontrados para actualizar: " . count($commentsToUpdate);
            }

            // 2. Obtener los comentarios de la API y actualizar la base de datos
            $updatedCount = 0;
            foreach ($commentsToUpdate as $comment) {
                $commentId = $comment['id'];
                // Obtener el comentario de la API
                $apiUrl = "https://jsonplaceholder.typicode.com/comments/$commentId";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $apiResponse = curl_exec($ch);
                $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($apiResponse === false || $httpStatus != 200) {
                    $result['errors'][] = "Error al obtener el comentario ID $commentId de la API. Código HTTP: $httpStatus";
                    continue;
                }

                $commentData = json_decode($apiResponse, true);

                if ($commentData === null) {
                    $result['errors'][] = "Error al decodificar el comentario ID $commentId de la API.";
                    continue;
                }

                // Actualizar el comentario en la base de datos
                $updateSql = "UPDATE comments SET name = :name, email = :email, comment = :comment WHERE id = :id";
                $updateStmt = $link->prepare($updateSql);
                $updateStmt->bindParam(':name', $commentData['name']);
                $updateStmt->bindParam(':email', $commentData['email']);
                $updateStmt->bindParam(':comment', $commentData['body']);
                $updateStmt->bindParam(':id', $commentId, PDO::PARAM_INT);

                try {
                    $updateStmt->execute();
                    $updatedCount++;
                    $result['messages'][] = "Comentario ID $commentId actualizado correctamente.";
                } catch (PDOException $e) {
                    $result['errors'][] = "Error al actualizar el comentario ID $commentId: " . $e->getMessage();
                    continue;
                }
            }

            $link->commit();
            $result['success'] = true;
            $result['updated_comments'] = $updatedCount;
        } catch (Exception $e) {
            $link->rollBack();
            $result['errors'][] = "Se produjo un error: " . $e->getMessage();
        }

        return $result;
    }
}
