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
    <title>Escape Room: El Laboratorio Maldito - Primer Reto</title>
    <link rel="icon" href="../user-ninja-solid.svg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=VT323&family=Special+Elite&display=swap');
        
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #030303;
            color: #c2c2c2;
            font-family: 'Special Elite', cursive;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/lab-background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(20,0,20,0.7) 100%);
            z-index: -1;
        }

        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                rgba(0, 0, 0, 0.1),
                rgba(0, 0, 0, 0.1) 1px,
                transparent 1px,
                transparent 2px
            );
            pointer-events: none;
            z-index: 2;
            opacity: 0.3;
            animation: scanline 10s linear infinite;
        }

        @keyframes scanline {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 0 100%;
            }
        }

        @keyframes textFlicker {
            0% {
                opacity: 0.8;
                text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
            }
            5% {
                opacity: 0.9;
            }
            10% {
                opacity: 0.8;
                text-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
            }
            15% {
                opacity: 1;
            }
            25% {
                opacity: 0.85;
                text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
            }
            30% {
                opacity: 1;
            }
            100% {
                opacity: 0.9;
            }
        }

        @keyframes breathe {
            0%, 100% {
                box-shadow: 0 0 15px rgba(200, 0, 0, 0.2), 0 0 20px rgba(150, 0, 0, 0.1), inset 0 0 10px rgba(150, 0, 0, 0.1);
            }
            50% {
                box-shadow: 0 0 20px rgba(200, 0, 0, 0.3), 0 0 30px rgba(150, 0, 0, 0.2), inset 0 0 15px rgba(150, 0, 0, 0.2);
            }
        }

        @keyframes glitch {
            0% {
                transform: translate(0);
            }
            20% {
                transform: translate(-2px, 2px);
            }
            40% {
                transform: translate(-2px, -2px);
            }
            60% {
                transform: translate(2px, 2px);
            }
            80% {
                transform: translate(2px, -2px);
            }
            100% {
                transform: translate(0);
            }
        }

        @keyframes backgroundPulse {
            0%, 100% {
                background-color: rgba(20, 2, 2, 0.9);
            }
            50% {
                background-color: rgba(30, 3, 3, 0.9);
            }
        }

        @keyframes fogAnimation {
            0%, 100% {
                opacity: 0.4;
                transform: translateX(-5%) translateY(-5%);
            }
            50% {
                opacity: 0.7;
                transform: translateX(5%) translateY(5%);
            }
        }

        h1, h2 {
            font-family: 'VT323', monospace;
            color: #bd1a1a;
            letter-spacing: 2px;
            animation: textFlicker 5s infinite;
            text-transform: uppercase;
        }

        h1::after {
            content: "";
            display: block;
            width: 70%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #bd1a1a, transparent);
            margin: 10px auto;
        }

        p {
            line-height: 1.6;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
        }

        .container {
            background: rgba(20, 2, 2, 0.9);
            border-radius: 8px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 0 25px rgba(150, 0, 0, 0.3), inset 0 0 15px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
            overflow: hidden;
            max-width: 800px;
            width: 90%;
            animation: breathe 8s infinite, backgroundPulse 15s infinite;
            border: 1px solid rgba(80, 0, 0, 0.3);
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="rgba(100,0,0,0.1)" stroke-width="0.5"/></svg>');
            opacity: 0.2;
            z-index: -1;
        }

        .fog-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000"><filter id="noise"><feTurbulence type="fractalNoise" baseFrequency="0.7" numOctaves="3" stitchTiles="stitch"/><feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 0.03 0"/></filter><rect width="1000" height="1000" filter="url(%23noise)" opacity="0.3"/></svg>');
            pointer-events: none;
            z-index: 3;
            opacity: 0.5;
            mix-blend-mode: overlay;
            animation: fogAnimation 20s ease-in-out infinite;
        }

        .hint-box {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(30, 0, 0, 0.8);
            color: #ff4d4d;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
            border: 1px solid rgba(150, 0, 0, 0.5);
            text-shadow: 0 0 3px #ff0000;
            z-index: 10;
            font-family: 'VT323', monospace;
            letter-spacing: 1px;
            animation: glitch 5s infinite;
        }

        .hint-box::before {
            content: "⚠ ";
            color: #ff0000;
        }

        .timer {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(20, 0, 0, 0.8);
            color: #ff0000;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
            border: 1px solid rgba(150, 0, 0, 0.5);
            font-family: 'VT323', monospace;
            letter-spacing: 2px;
            z-index: 10;
            animation: textFlicker 3s infinite;
        }

        .timer::before {
            content: "⏱ ";
            animation: textFlicker 2s infinite;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background-color: rgba(255, 30, 30, 0.4);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 1s, transform 3s;
            filter: blur(1px);
            z-index: 2;
        }

        .room-image {
            width: 100%;
            height: 300px;
            background-color: #0a0505;
            border: 1px solid #6b0000;
            margin: 20px 0;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/laboratory.jpg');
            background-size: cover;
            background-position: center;
            filter: contrast(1.1) brightness(0.7) saturate(0.9) sepia(0.1);
            box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.8);
            overflow: hidden;
        }

        .room-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, transparent 30%, rgba(0, 0, 0, 0.7) 100%);
            pointer-events: none;
        }

        .room-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 0, 0, 0.03), rgba(0, 0, 0, 0));
            pointer-events: none;
            animation: scanline 4s linear infinite;
        }

        .interactive {
            position: absolute;
            border: 1px solid transparent;
            background-color: rgba(150, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 2;
        }

        .interactive:hover {
            border: 1px dashed rgba(200, 0, 0, 0.5);
            background-color: rgba(150, 0, 0, 0.15);
            box-shadow: 0 0 15px rgba(150, 0, 0, 0.2);
        }

        .interactive:hover::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 0, 0, 0.1);
            animation: glitch 0.5s infinite;
        }

        .terminal {
            width: 100%;
            height: 150px;
            background-color: #0a0a0a;
            color: #c12f2a;
            font-family: 'VT323', monospace;
            font-size: 1.1rem;
            letter-spacing: 1px;
            padding: 10px;
            text-align: left;
            overflow-y: auto;
            margin-top: 20px;
            border: 1px solid #500000;
            background-image: 
                radial-gradient(rgba(80, 0, 0, 0.1) 30%, transparent 31%),
                radial-gradient(rgba(80, 0, 0, 0.1) 30%, transparent 31%);
            background-size: 5px 5px;
            background-position: 0 0, 2.5px 2.5px;
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.8);
            text-shadow: 0 0 3px rgba(255, 0, 0, 0.4);
        }

        .terminal::-webkit-scrollbar {
            width: 5px;
        }

        .terminal::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        .terminal::-webkit-scrollbar-thumb {
            background: #500000;
        }

        .inventory {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }

        .inventory-item {
            width: 50px;
            height: 50px;
            background-color: #1a0505;
            border: 1px solid #500000;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ff4d4d;
            position: relative;
            font-family: 'VT323', monospace;
            font-size: 1.2rem;
            box-shadow: 0 0 10px rgba(150, 0, 0, 0.2), inset 0 0 5px rgba(80, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .inventory-item:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(200, 0, 0, 0.3), inset 0 0 8px rgba(120, 0, 0, 0.4);
        }

        .inventory-item::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 65%, rgba(255, 0, 0, 0.1) 75%, transparent 85%);
            background-size: 200% 200%;
            animation: shine 3s linear infinite;
        }

        @keyframes shine {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        input, button {
            background-color: #0a0505;
            color: #ff4d4d;
            border: 1px solid #500000;
            padding: 8px 15px;
            margin: 10px 5px;
            font-family: 'VT323', monospace;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(100, 0, 0, 0.2);
        }

        input {
            background: linear-gradient(to bottom, #0a0505, #140505);
        }

        input:focus {
            outline: none;
            border-color: #a00000;
            box-shadow: 0 0 10px rgba(200, 0, 0, 0.3);
        }

        button {
            position: relative;
            overflow: hidden;
        }

        button::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 20, 20, 0.1), transparent);
            transition: 0.5s;
        }

        button:hover {
            background-color: #500000;
            color: #fff;
            cursor: pointer;
            border-color: #700000;
            text-shadow: 0 0 5px rgba(255, 100, 100, 0.5);
        }

        button:hover::after {
            left: 100%;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 100;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: rgba(20, 2, 2, 0.95);
            border-radius: 8px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 0 25px rgba(200, 0, 0, 0.3), inset 0 0 15px rgba(0, 0, 0, 0.5);
            max-width: 500px;
            width: 90%;
            border: 1px solid rgba(80, 0, 0, 0.5);
            position: relative;
            animation: glitch 0.2s ease-out, breathe 8s infinite;
        }

        .modal-content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(80, 0, 0, 0.1) 0%, transparent 80%);
            pointer-events: none;
        }

        #player-name {
            color: #ff4d4d;
            font-weight: bold;
            text-shadow: 0 0 5px rgba(255, 0, 0, 0.3);
        }

        /* Efectos de sangre en las esquinas */
        .blood-effect {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
            opacity: 0.4;
        }
        
        .blood-corner {
            position: absolute;
            width: 150px;
            height: 150px;
            background-size: contain;
            background-repeat: no-repeat;
            filter: drop-shadow(0 0 5px rgba(0,0,0,0.5));
        }
        
        .blood-top-left {
            top: 0;
            left: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150"><path d="M0,0 C30,10 70,5 100,30 C120,50 130,80 150,90 L150,0 Z" fill="rgba(120,0,0,0.6)"/></svg>');
        }
        
        .blood-top-right {
            top: 0;
            right: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150"><path d="M150,0 C120,20 100,10 70,20 C40,30 30,60 0,70 L0,0 Z" fill="rgba(120,0,0,0.6)"/></svg>');
        }
        
        .blood-bottom-left {
            bottom: 0;
            left: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150"><path d="M0,150 C30,140 50,130 80,100 C100,80 120,60 140,50 L0,50 Z" fill="rgba(120,0,0,0.6)"/></svg>');
        }
        
        .blood-bottom-right {
            bottom: 0;
            right: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150"><path d="M150,150 C120,140 100,120 70,110 C40,100 20,90 0,70 L150,70 Z" fill="rgba(120,0,0,0.6)"/></svg>');
        }

        /* Efecto de pulsaciones en el fondo */
        .heartbeat {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, transparent 30%, rgba(0, 0, 0, 0.9) 100%);
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
            animation: heartbeat 5s infinite;
        }

        @keyframes heartbeat {
            0%, 100% {
                opacity: 0.1;
            }
            50% {
                opacity: 0.3;
            }
        }
    </style>
</head>
<body>
    <div class="fog-overlay"></div>
    <div class="blood-effect">
        <div class="blood-corner blood-top-left"></div>
        <div class="blood-corner blood-top-right"></div>
        <div class="blood-corner blood-bottom-left"></div>
        <div class="blood-corner blood-bottom-right"></div>
    </div>
    <div class="heartbeat"></div>
    
    <div class="hint-box">La respuesta está escrita en sangre y elementos...</div>
    <div class="timer" id="timer">10:00</div>
    
    <div class="container">
        <h1>Laboratorio Maldito: Sala de Control</h1>
        <p>Te encuentras atrapado, <span id="player-name"><?php echo $_SESSION["alias"]; ?></span>. Las luces parpadean en esta olvidada sala de control. Un olor a químicos y descomposición flota en el aire. Debes descifrar el código antes de que el tiempo se agote, o quedarás atrapado para siempre en esta pesadilla científica.</p>
        
        <div class="room-image" id="main-room">
            <!-- Elementos interactivos -->
            <div class="interactive" id="computer" style="width: 100px; height: 80px; top: 120px; left: 350px;"></div>
            <div class="interactive" id="drawer" style="width: 80px; height: 60px; top: 200px; left: 150px;"></div>
            <div class="interactive" id="poster" style="width: 60px; height: 90px; top: 60px; left: 550px;"></div>
        </div>
        
        <div class="terminal" id="game-console">
            > Sistema de emergencia inicializado.
            > Bienvenido a la Sala de Control, <?php echo $_SESSION["alias"]; ?>
            > ALERTA: Sistema de contención comprometido.
            > Tiempo restante: 10:00
            > Objetivo: Encontrar el código antes de que sea demasiado tarde.
            > ADVERTENCIA: No hay señales de otros supervivientes.
        </div>
        
        <div class="inventory" id="inventory">
            <!-- Los items se añadirán aquí dinámicamente -->
        </div>
    </div>
    
    <!-- Modal para el ordenador -->
    <div class="modal" id="computer-modal">
        <div class="modal-content">
            <h2>Terminal Corrupto</h2>
            <div class="terminal">
                > Sistema SciLab v3.7 - FALLO CRÍTICO
                > Secuencia de desbloqueo requerida para reestablecer contención.
                > ERROR: "La sangre de los elementos habla"
                > ADVERTENCIA: Múltiples fallos de contención detectados.
            </div>
            <input type="password" id="computer-password" placeholder="Introducir secuencia...">
            <hidden id="computer-p" value="hhelibe">
            <button id="access-btn">Ejecutar</button>
            <button class="close-modal">Retroceder</button>
        </div>
    </div>
    
    <!-- Modal para el cajón -->
    <div class="modal" id="drawer-modal">
        <div class="modal-content">
            <h2>Cajón Oxidado</h2>
            <div class="terminal" id="drawer-terminal">
                > Contenido del cajón:
                > - Una llave manchada de sangre
                > - Una tarjeta de identificación descolorida
                > - Una nota arrugada con marcas extrañas
            </div>
            <button id="key-btn">Tomar llave</button>
            <button id="id-card-btn">Examinar tarjeta</button>
            <button id="note-btn">Leer nota</button>
            <button class="close-modal">Retroceder</button>
        </div>
    </div>
    
    <!-- Modal para la nota -->
    <div class="modal" id="note-modal">
        <div class="modal-content">
            <h2>Nota Ensangrentada</h2>
            <div class="terminal">
                > "He tratado de recordar la secuencia para sobrevivir:
                > Hidrógeno (H) - El primero de todos
                > Helio (He) - Noble hasta el final
                > Litio (Li) - Se consume en la oscuridad
                > Berilio (Be) - Duro pero se quiebra como huesos
                > Los símbolos son nuestra única salvación."
                > [Hay marcas de dedos ensangrentados en los bordes]
            </div>
            <button class="close-modal">Retroceder</button>
        </div>
    </div>
    
    <!-- Modal para la tarjeta de ID -->
    <div class="modal" id="id-card-modal">
        <div class="modal-content">
            <h2>Tarjeta de Identificación</h2>
            <div class="terminal">
                > Tarjeta de acceso: Dra. Elena Sánchez
                > Estado: FALLECIDA
                > Departamento: Química de Elementos Experimentales
                > ID: AZ-79-201
                > Nota manuscrita: "Sus símbolos son lo único que queda de ellos"
                > [La foto muestra a una mujer con expresión de terror]
            </div>
            <button class="close-modal">Retroceder</button>
        </div>
    </div>
    
    <!-- Modal para el póster -->
    <div class="modal" id="poster-modal">
        <div class="modal-content">
            <h2>Tabla Periódica Manchada</h2>
            <div class="terminal">
                > Una antigua tabla periódica cuelga torcida en la pared.
                > Alguien ha marcado con lo que parece ser sangre los elementos: H, He, Li, Be.
                > El elemento Au (Oro) está rodeado por un círculo con una X.
                > Una inscripción escalofriante en el borde dice: "Sus símbolos contienen la clave para escapar"
                > [Algunas letras parecen brillar en la oscuridad]
            </div>
            <button class="close-modal">Retroceder</button>
        </div>
    </div>
    
    <!-- Modal Game Over -->
    <div class="modal" id="game-over-modal">
        <div class="modal-content">
            <h2>Tu Tiempo Ha Terminado</h2>
            <div class="terminal">
                > Las luces se apagan por completo.
                > Un sonido metálico resuena a lo lejos.
                > Tu corazón late con fuerza cuando sientes una presencia acercándose.
                > Has fallado. Ahora eres parte del laboratorio para siempre.
            </div>
            <button onclick="location.reload()">Intentar Sobrevivir Otra Vez</button>
            <button onclick="location.href='../index.php'">Abandonar</button>
        </div>
    </div>
    
    <!-- Modal Victoria -->
    <div class="modal" id="success-modal">
        <div class="modal-content">
            <h2>Sistema Desactivado</h2>
            <div class="terminal">
                > Código aceptado. Protocolo de contención neutralizado.
                > Las puertas se abren con un chirrido escalofriante.
                > Has sobrevivido a esta sala, pero la pesadilla continúa...
                > [Se escuchan sonidos inquietantes desde el siguiente pasillo]
            </div>
            <form method="post" action="./quirofano.php">
                <input type="hidden" name="p" id="p" value="hhelibe">
                <button type="submit">Avanzar hacia lo desconocido</button>
            </form>

        </div>
   </div>
    </body>
    </head>
    <script>
        // Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Elementos principales del juego
    const timer = document.getElementById('timer');
    const gameConsole = document.getElementById('game-console');
    const inventory = document.getElementById('inventory');
    
    // Elementos interactivos
    const computerElement = document.getElementById('computer');
    const drawerElement = document.getElementById('drawer');
    const posterElement = document.getElementById('poster');
    
    // Modales
    const computerModal = document.getElementById('computer-modal');
    const drawerModal = document.getElementById('drawer-modal');
    const noteModal = document.getElementById('note-modal');
    const idCardModal = document.getElementById('id-card-modal');
    const posterModal = document.getElementById('poster-modal');
    const gameOverModal = document.getElementById('game-over-modal');
    const successModal = document.getElementById('success-modal');
    
    // Botones
    const accessBtn = document.getElementById('access-btn');
    const keyBtn = document.getElementById('key-btn');
    const idCardBtn = document.getElementById('id-card-btn');
    const noteBtn = document.getElementById('note-btn');
    
    const computerPassword = document.getElementById('computer-password');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    
    // Estado del juego
    let gameState = {
        timeLeft: 600, // 10 minutos en segundos
        hasKey: false,
        hasIdCard: false,
        hasReadNote: false,
        hasExaminedPoster: false,
        timerInterval: null,
        gameOver: false
    };

    // Iniciar el temporizador
    startTimer();
    
    // Generar algunas partículas en el fondo
    createParticles();
    
    // Configurar eventos para los elementos interactivos
    computerElement.addEventListener('click', function() {
        if (!gameState.gameOver) {
            openModal(computerModal);
            logAction('Has examinado el ordenador de la sala de control.');
        }
    });
    
    drawerElement.addEventListener('click', function() {
        if (!gameState.gameOver) {
            openModal(drawerModal);
            logAction('Has encontrado un cajón oxidado.');
        }
    });
    
    posterElement.addEventListener('click', function() {
        if (!gameState.gameOver) {
            openModal(posterModal);
            gameState.hasExaminedPoster = true;
            logAction('Examinas una antigua tabla periódica manchada de sangre.');
        }
    });
    
    // Configurar botones de los cajones
    keyBtn.addEventListener('click', function() {
        if (!gameState.hasKey) {
            gameState.hasKey = true;
            addToInventory('🔑', 'Llave oxidada');
            logAction('Has tomado una llave manchada de sangre.');
            keyBtn.disabled = true;
            keyBtn.textContent = 'Llave recogida';
        }
    });
    
    idCardBtn.addEventListener('click', function() {
        openModal(idCardModal);
        if (!gameState.hasIdCard) {
            gameState.hasIdCard = true;
            addToInventory('🪪', 'Tarjeta ID');
            logAction('Has examinado la tarjeta de identificación de la Dra. Elena Sánchez.');
        }
    });
    
    noteBtn.addEventListener('click', function() {
        openModal(noteModal);
        if (!gameState.hasReadNote) {
            gameState.hasReadNote = true;
            addToInventory('📝', 'Nota');
            logAction('Has leído la nota ensangrentada sobre los elementos químicos.');
        }
    });
    
    // Botón de acceso al ordenador
    accessBtn.addEventListener('click', function() {
        checkPassword();
    });
    
    // Permitir enviar contraseña con Enter
    computerPassword.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            checkPassword();
        }
    });
    
    
    // Cerrar modales
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            closeModal(modal);
        });
    });
    
    // Funciones del juego
    
    // Verificar contraseña
    function checkPassword() {
        const password = computerPassword.value.trim().toLowerCase();
        // La contraseña es HHeLiBe - primeros 4 elementos de la tabla periódica
        if (password === 'hhelibe') {
            // Éxito
            logAction('¡Código correcto! El sistema de contención ha sido desactivado.');
            clearInterval(gameState.timerInterval);
            openModal(successModal);
        } else {
            // Contraseña incorrecta
            computerPassword.value = '';
            computerPassword.placeholder = 'Código incorrecto. Inténtalo de nuevo...';
            logAction('Has introducido un código incorrecto. El sistema lo rechaza.');
            
            // Hacer que la pantalla parpadee en rojo
            const container = document.querySelector('.container');
            container.style.animation = 'none';
            setTimeout(() => {
                container.style.animation = 'breathe 8s infinite, backgroundPulse 15s infinite';
            }, 10);
            
            // Efecto de pantalla de error
            document.body.classList.add('error');
            setTimeout(() => {
                document.body.classList.remove('error');
            }, 500);
        }
    }
    
    // Iniciar temporizador
    function startTimer() {
        gameState.timerInterval = setInterval(function() {
            gameState.timeLeft--;
            
            // Actualizar visualización del temporizador
            const minutes = Math.floor(gameState.timeLeft / 60);
            const seconds = gameState.timeLeft % 60;
            timer.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            
            // Efectos cuando queda poco tiempo
            if (gameState.timeLeft <= 60) { // Último minuto
                timer.style.color = '#ff0000';
                timer.style.animation = 'textFlicker 0.5s infinite';
            }
            
            // Game over cuando se acaba el tiempo
            if (gameState.timeLeft <= 0) {
                clearInterval(gameState.timerInterval);
                gameState.gameOver = true;
                openModal(gameOverModal);
            }
        }, 1000);
    }
    
    // Registrar acciones en la consola del juego
    function logAction(text) {
        const line = document.createElement('div');
        line.textContent = `> ${text}`;
        gameConsole.appendChild(line);
        gameConsole.scrollTop = gameConsole.scrollHeight;
    }
    
    // Añadir item al inventario
    function addToInventory(icon, tooltip) {
        const item = document.createElement('div');
        item.className = 'inventory-item';
        item.textContent = icon;
        item.title = tooltip;
        
        // Efecto de resplandor al añadir
        item.style.boxShadow = '0 0 15px rgba(255, 0, 0, 0.5)';
        setTimeout(() => {
            item.style.boxShadow = '';
        }, 1000);
        
        inventory.appendChild(item);
    }
    
    // Abrir un modal
    function openModal(modal) {
        // Cerrar cualquier otro modal abierto
        document.querySelectorAll('.modal').forEach(m => {
            m.style.display = 'none';
        });
        
        modal.style.display = 'flex';
        
        // Efecto de glitch al abrir
        setTimeout(() => {
            modal.querySelector('.modal-content').classList.add('glitch-effect');
            setTimeout(() => {
                modal.querySelector('.modal-content').classList.remove('glitch-effect');
            }, 500);
        }, 100);
    }
    
    // Cerrar un modal
    function closeModal(modal) {
        modal.style.display = 'none';
    }
    
    // Crear partículas de polvo/sangre en el fondo
    function createParticles() {
        const container = document.querySelector('.container');
        
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Posición aleatoria
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            
            // Color aleatorio (rojo/marrón)
            const r = 150 + Math.floor(Math.random() * 105);
            const g = Math.floor(Math.random() * 30);
            const b = Math.floor(Math.random() * 30);
            particle.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${Math.random() * 0.3 + 0.1})`;
            
            // Tamaño aleatorio
            const size = Math.random() * 4 + 1;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Añadir al contenedor
            container.appendChild(particle);
            
            // Animación con retraso
            setTimeout(() => {
                particle.style.opacity = Math.random() * 0.5 + 0.1;
                
                // Movimiento lento
                const moveX = (Math.random() - 0.5) * 100;
                const moveY = (Math.random() - 0.5) * 100;
                particle.style.transform = `translate(${moveX}px, ${moveY}px)`;
            }, Math.random() * 2000);
            
            // Regenerar partícula después de un tiempo
            setInterval(() => {
                // Reiniciar posición
                particle.style.opacity = '0';
                particle.style.transform = 'translate(0, 0)';
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Mostrar de nuevo con retraso
                setTimeout(() => {
                    particle.style.opacity = Math.random() * 0.5 + 0.1;
                    const moveX = (Math.random() - 0.5) * 100;
                    const moveY = (Math.random() - 0.5) * 100;
                    particle.style.transform = `translate(${moveX}px, ${moveY}px)`;
                }, 100);
            }, Math.random() * 10000 + 5000);
        }
    }
    
    // Añadir efectos de sonido (si lo deseas)
    function playSound(type) {
        // Esta función se puede implementar si decides añadir sonidos
        // Por ejemplo, podrías usar la Web Audio API para crear efectos de sonido
        // o pre-cargar archivos de audio.
        
        // Ejemplo (necesitarías añadir los archivos de audio):
        // const sound = new Audio(`sounds/${type}.mp3`);
        // sound.play();
    }
    
    // Efectos visuales adicionales al iniciar
    setTimeout(() => {
        // Hacer que el terminal parpadee al inicio
        gameConsole.style.opacity = '0.7';
        setTimeout(() => {
            gameConsole.style.opacity = '1';
        }, 300);
        
        // Mensaje inicial con retraso
        setTimeout(() => {
            logAction('Los sistemas de este laboratorio son antiguos pero aún funcionan...');
            setTimeout(() => {
                logAction('Debes encontrar pistas en esta habitación para averiguar el código de desactivación.');
            }, 2000);
        }, 1000);
    }, 500);
});
    </script>