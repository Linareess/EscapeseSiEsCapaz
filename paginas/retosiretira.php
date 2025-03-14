<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["alias"])) {
    $_SESSION["alias"] = htmlspecialchars($_POST["alias"]);
} else if (empty($_SESSION["alias"])) {
    header("Location: ../index.php"); // Redirige si no hay alias
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Jaula Imposible</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');
        
        body {
            background: #000;
            color: #f00;
            font-family: 'Orbitron', sans-serif;
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
            font-size: 2.5rem;
            text-shadow: 0 0 10px #f00, 0 0 20px #ff0;
            animation: glitch 1.5s infinite;
        }
        
        @keyframes glitch {
            0% { text-shadow: 3px 3px 0 #ff0000, -3px -3px 0 #00ff00; }
            50% { text-shadow: -3px -3px 0 #ff0000, 3px 3px 0 #00ff00; }
            100% { text-shadow: 3px -3px 0 #ff0000, -3px 3px 0 #00ff00; }
        }
        
        .boton {
            background: #222;
            color: #ff0000;
            border: 2px solid #ff0000;
            padding: 15px 30px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            box-shadow: 0 0 10px #ff0000;
        }
        
        .boton:hover {
            background: #ff0000;
            color: black;
            box-shadow: 0 0 20px #ff0000;
        }
        
        .pista {
            position: fixed;
            top: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.8);
            padding: 10px;
            color: #999;
            font-size: 0.9rem;
            border: 1px solid #666;
            text-shadow: 0 0 5px #666;
            display: none;
        }
        
        .imagen-espacio {
            width: 300px;
            height: 200px;
            background: rgba(255, 0, 0, 0.1);
            margin-top: 20px;
            border: 2px solid #f00;
            background-attachment: fixed;
        }

        .secreto {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: #000;
            background: black;
            padding: 5px;
            border: none;
            visibility: hidden;
        }
        
        .codigo {
            margin-top: 20px;
            color: #0f0;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <h1>La Jaula Imposible</h1>
    <p>Debes encontrar la forma de salir...</p>
    
    <button class="boton" onclick="mostrarPista()">Ver pista</button>
    <div class="pista" id="pista">Solo una combinación secreta abrirá la jaula...</div>
    
    <div class="imagen-espacio">
        <img src="./img/fondo.jpg" class="imagen-espacio" alt="stair">
    </div>

    <p class="codigo">Ingresa el código correcto para abrir la puerta:</p>
    <input type="text" id="codigoEntrada">
    <button class="boton" onclick="verificarCodigo()">Intentar abrir</button>

    <button class="secreto" id="salida" onclick="salir()">Salir</button>
    
    <script>
        function mostrarPista() {
            document.getElementById('pista').style.display = 'block';
            setTimeout(() => {
                document.getElementById('pista').style.display = 'none';
            }, 5000);
        }
        
        function verificarCodigo() {
            const codigo = document.getElementById('codigoEntrada').value;
            if (codigo === "1347") {
                alert("Has desbloqueado la puerta... pero algo acecha en la oscuridad");
                document.getElementById('salida').style.visibility = 'visible';
            } else {
                alert("Código incorrecto... algo se acerca");
            }
        }
        
        function salir() {
            alert("Escapas... pero sientes que alguien te observa.");
        }
    </script>
</body>
</html>
