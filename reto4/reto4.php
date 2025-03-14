<?php
session_start();

// Verifica que la solicitud sea POST y que el campo 'nivel' esté definido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["niveel"])) {
    if ($_POST["niveel"] === "indexxx") {
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
    <title>Escape Room - La Casa de la Bruja</title>
    <link rel="icon" href="../user-ninja-solid.svg">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #dcdcdc;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            text-align: center;
        }

        #game-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            background-image: url('./picks/istockphoto-481231906-612x612.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #puzzle-box {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }

        .clue {
            font-size: 20px;
            color: #e74c3c;
            margin-top: 15px;
            cursor: pointer;
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
            text-align: center;
            display: none;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #c0392b;
        }
        #next-level-btn1 {
            display: none; /* Oculto inicialmente */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="game-container">
        <div id="puzzle-box">
            <h2>Has quedado atrapado en la casa de la bruja...</h2>
            <p>Para escapar, debes resolver los acertijos que dejó la malvada bruja.</p>
            <p>Encuentra las pistas ocultas en la habitación.</p>
            
            <div id="mirror" class="clue">Observa el espejo roto</div>
            <div id="doll" class="clue">Examina la muñeca de porcelana</div>
            <div id="book" class="clue">Revisa el libro polvoriento</div>
            
            <div id="code-input" class="hidden">
                
                <p>Ingresa el código para abrir la puerta:</p>
                <input type="text" id="code-field" maxlength="4">
                <button id="check-code">Comprobar</button>
                <form method="post" action="../congratulations/final.php">
                    <button class="hidden" type="submit" name="next-level-btn1" value="694" id="next-level-btn1">SALIR DEL ESCAPE ROOM</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Popups para pistas -->
    <div id="popup" class="popup">
        <p id="popup-text"></p>
        <button onclick="closePopup()">Cerrar</button>
    </div>
    
    <script>
        const mirror = document.getElementById('mirror');
        const doll = document.getElementById('doll');
        const book = document.getElementById('book');
        const codeInput = document.getElementById('code-input');
        const codeField = document.getElementById('code-field');
        const checkCodeBtn = document.getElementById('check-code');
        const popup = document.getElementById('popup');
        const popupText = document.getElementById('popup-text');
        
        let clues = { mirror: false, doll: false, book: false };

    
        function showPopup(message) {
            popupText.innerHTML = message;
            popup.style.display = 'block';
        }
        
        function closePopup() {
            popup.style.display = 'none';
        }
        
        function showClue(element, message) {
            if (!clues[element]) {
                clues[element] = true;
                showPopup(message);
                checkAllClues();
            }
        }
        
        function checkAllClues() {
            if (clues.mirror && clues.doll && clues.book) {
                codeInput.classList.remove('hidden');
            }
        }
        
        mirror.addEventListener('click', () => showClue('mirror', "<img src='./picks/num6.png' alt='Espejo roto'><br>¿Espejito...?"));
        doll.addEventListener('click', () => showClue('doll', "<img src='./picks/num9.png' alt='Muñeca poseída'><br>La muñeca susurra: 'No todos los angeles van al cielo, algunas caemos en un lugar mejor'."));
        book.addEventListener('click', () => showClue('book', "<img src='./picks/Designer.jpeg' alt='Libro antiguo'><br>Tras el ocular acaba la combinación."));
        
        checkCodeBtn.addEventListener('click', () => {
            if (codeField.value === "694") {
                showPopup("¡Has escapado de la casa de la bruja!");
                document.getElementById('next-level-btn1').style.display = 'block';
            } else {
                showPopup("La bruja ha atrapado tu alma...");
            }
        });
    </script>
</body>
</html>