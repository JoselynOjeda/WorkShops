<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <h1>Datos de Usuarios</h1>
    <main>
        <form method="post" action="info_save.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required> <br>
            <br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>
            <br>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required> <br>
            <br>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required><br>
            <br>

            <input type="submit" value="Enviar">
        </form>

    </main>




</body>

</html>