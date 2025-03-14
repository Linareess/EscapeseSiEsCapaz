<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volando Cerebros</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="./user-ninja-solid.svg">
</head>

<body>
    <div class="image-container">
        <img src="img/img1.jpg" alt="Imagen 1" class="image1">
        <img src="img/img2.jpg" alt="Imagen 2" class="image2">
        <img src="img/img3.jpg" alt="Imagen 3" class="image3">
        <img src="img/img4.jpg" alt="Imagen 4" class="image4" onclick="showPopup();"> <!-- Botón pop-up -->
    </div>

    <div class="container">
        <header>
            <h2>💀</h2>
            <h1>¡No esta facil!</h1>
            <h2>👹</h2>

        </header>
        <main>
            <p>Aqui viene a probar criterio, atencion, sentido comun y conocimiento.</p>
            <form id="aliasForm" method="POST">
                <input type="text" id="alias" name="alias" placeholder="*Ingresar alias*" required>
                <input type="hidden" id="destination" name="destination"><br>
                <button type="submit" class="btn" formaction="./retos1y2/retosiempieza.php">Empezar</button>
            </form>
        </main>
    </div>

    <!-- Pop-up -->
    <div id="popup">
        <img src="img/susto.jpg" alt="Imagen de susto"> <!-- Imagen aterradora para el pop-up -->
    </div>

    <script>
    // Función para mostrar el pop-up
    function showPopup() {
        document.getElementById('popup').style.display = 'block';
        // Esconde el pop-up después de 3 segundos
        setTimeout(function() {
            document.getElementById('popup').style.display = 'none';
        }, 3000); // 3000 ms = 3 segundos
    }
    </script>
</body>

</html>