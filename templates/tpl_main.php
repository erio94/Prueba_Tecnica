<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Técnica</title>
</head>

<body>
    <h1>Prueba Técnica</h1>
    <h2>Operaciones</h2>
    <h3>Imagenes</h3>
    <ul>
        <li><a href="?Image/encontrarImaganesDuplicadas">Encontrar imágenes duplicadas</a></li>
        <li><a href="?Image/eliminarImagenesDuplicadas">Eliminar imágenes duplicadas</a></li>
        <li><a href="?Image/corregirImagenesPrimariasDuplicadas">Corregir imágenes primarias duplicadas</a></li>
    </ul>
    <h3>Comentarios</h3>
    <ul>
        <li>
            <a href="?Comment/recuperarComentarios">Actualizar comentarios</a>
        </li>
    </ul>



    <?php if (isset($result)) : ?>
        <h2>Resultado</h2>
        <pre>
            <?php print_r($result); ?>
        </pre>
    <?php endif; ?>
    <?php
    if (isset($resultado) && $resultado['success']) {
        echo "Operación completada exitosamente.\n";
        echo "Comentarios actualizados: " . $resultado['updated_comments'] . "\n";
        foreach ($resultado['messages'] as $mensaje) {
            echo $mensaje . "\n";
        }
    } else {
        if (isset($resultado) && $resultado['errors']) {
            echo "La operación no se completó correctamente.\n";
            foreach ($resultado['errors'] as $error) {
                echo "Error: " . $error . "\n";
            }
        }
    }
    ?>
</body>
</html>