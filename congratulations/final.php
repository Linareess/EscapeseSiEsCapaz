<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["next-level-btn1"]) && $_POST["next-level-btn1"] == "694") {
    $_SESSION["nivel_completado"] = true; // Marca el nivel como completado
} else {
    // Si accede sin presionar el botón, redirige a la página anterior
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Terminando...</title>
    <link rel="icon" href="../user-ninja-solid.svg">
    <style>
        body {
            background: url('./pick/COLOURBOX29233953.webp') no-repeat center center fixed; 
            background-size: cover;
            color: white;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: white;
            text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000, 0 0 15px #ff0000;
            margin-top: 20%;
        }

        p {
            text-align: center;
            font-size: 1.2em;
            color: white;
            margin-top: 20px;
        }

        .hiddenText {
            color: transparent;
            font-size: 1.5em;
            text-align: center;
            transition: color 1.3s ease;
            cursor: pointer;
        }

        .hiddenText:hover {
            color:rgb(51, 44, 44);
        }

        #backButton, #replayButton {
            position: absolute;
            bottom: 20%; /* Subir los botones un poco más */
            left: 50%;
            transform: translateX(-50%);
            background-color: transparent;
            border: 2px solid #ff0000;
            padding: 10px;
            color: #ff0000;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #backButton:hover, #replayButton:hover {
            background-color: rgba(255, 0, 0, 0.2);
        }

        #backButton, #replayButton {
    position: absolute;
    bottom: 20%; /* Subir los botones un poco más */
    left: 50%;
    transform: translateX(-50%);
    background-color: transparent;
    border: 2px solid #ff0000;
    padding: 10px;
    color: #ff0000;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease, filter 0.3s ease;
    box-shadow: 0 0 5px rgba(255, 0, 0, 0.5); /* Sombra para darle profundidad */
}

#backButton:hover, #replayButton:hover {
    background-color: rgba(255, 0, 0, 0.2);
    transform: translateX(-50%) scale(1.3) skew(10deg, 10deg); /* Distorsión y escala */
    filter: blur(6px); /* Filtro de difuminado para un efecto de distorsión */
    box-shadow: 0 0 15px rgba(255, 0, 0, 0.8); /* Aumentamos la sombra */
}


        .fog {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/asfalt-dark.png') repeat;
            opacity: 0.1;
            pointer-events: none;
            animation: fog 10s infinite linear;
        }

        @keyframes fog {
            0% { background-position: 0px 0px; }
            100% { background-position: 100px 100px; }
        }
    </style>
</head>
<body>
    <div class="fog"></div>

    <h1>¡Felicitaciones, has sobrevivido!</h1>
    <p>Has logrado llegar hasta el final... pero, ¿realmente has escapado? La oscuridad siempre está acechando, esperando por tu regreso.</p>

    <p class="hiddenText" onclick="revealText()"> ¿Estas seguro que esto ha acabado? </p>
    <form method="post">
    <button id="replayButton" formaction="../index.php">Volver a Jugar</button>
    </form>
    <?php
    session_destroy();
    ?>
</body>
</html>
