<?php
session_start();

// Verifica que la solicitud sea POST y que el campo 'nivel' esté definido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nivel"])) {
    if ($_POST["nivel"] === "indexx") {
        $_SESSION["nivel_superado"] = true;
        
    } else {
        header("Location: ../index.php"); // Redirige si el valor es incorrecto
        exit();
    }
} else {
    header("Location: ../index.php"); // Redirige si se intenta acceder sin POST
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Jaula Imposible - Escape Room de Terror</title>
    <link rel="icon" href="../user-ninja-solid.svg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');

        body {
            background: url('./picks/6b1ba4a9e754519a668ae70459e806f3e3c84cfa_hq.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #c00;
            font-family: 'Creepster', cursive;
            text-align: center;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        h1 {
            font-size: 4rem;
            text-shadow: 0 0 20px #900, 0 0 30px #600;
            animation: flicker 2s infinite alternate;
            color: #900;
        }

        @keyframes flicker {
            0% { opacity: 1; }
            50% { opacity: 0.8; }
            100% { opacity: 1; }
        }

        .boton {
            background: #200;
            color: #c00;
            border: 2px solid #c00;
            padding: 15px 30px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            box-shadow: 0 0 15px #900;
            margin-top: 20px;
        }

        .boton:hover {
            background: #900;
            color: black;
            box-shadow: 0 0 25px #900;
        }

        .pista {
            position: relative;
            background: rgba(30, 0, 0, 0.8);
            padding: 20px;
            color: #c00;
            font-size: 1.5rem;
            border: 1px solid #600;
            text-shadow: 0 0 5px #600;
            display: none;
            border-radius: 5px;
            margin-top: 20px;
            width: 60%;
        }

        .codigo {
            margin-top: 40px;
            color: #f00;
            font-size: 1.8rem;
            text-shadow: 0 0 10px #600;
        }

        input {
            background: black;
            color: #f00;
            border: 1px solid #900;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            margin-top: 20px;
        }

        #next-level {
            display: none; /* Oculto inicialmente */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>La Jaula Imposible</h1>
    <p>Una sensación de horror recorre tu espalda... algo te observa.</p>
    
    <button class="boton" onclick="mostrarPista()">Ver pista</button>
    <div class="pista" id="pista">Tengo llaves pero no puertas, tengo espacio pero no habitación. ¿Qué soy?</div>
    
    <p class="codigo">Introduce el código antes de que sea demasiado tarde...</p>
    <input type="text" id="codigoEntrada">
    <br>
    <button class="boton" onclick="verificarCodigo()">Abrir Puerta</button>
    <form method="post" action="../reto4/reto4.php">
        <input type="hidden" name="niveel" id="niveel" value="indexxx">
        <button class="boton" type="submit" id="next-level">Ir al Siguiente Nivel</button>
    </form>

    <script>
        function mostrarPista() {
            let pista = document.getElementById('pista');
            pista.style.display = 'block';
            setTimeout(() => {
                pista.style.display = 'none';
            }, 8000);
        }

        function verificarCodigo() {
            const codigo = document.getElementById('codigoEntrada').value.trim().toLowerCase();
            if (codigo === "teclado") {
                document.getElementById('next-level').style.display = 'block'; // Mostrar botón de siguiente nivel
            } else {
                exit();
            }
        }
    </script>
</body>
</html>