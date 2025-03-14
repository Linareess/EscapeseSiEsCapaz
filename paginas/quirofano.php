<?php
session_start();
$correcta="hhelibe";
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    if ($p == $correcta) {
        $_SESSION['alias'] = 4;
    } else if (empty($_SESSION["alias"])) {
        header("Location: ../index.php"); // Redirige si no hay alias
        exit();
    }}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape Room - Nivel 3: Quirófano</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000;
            color: #fff;
            overflow: hidden;
            height: 100vh;
            width: 100vw;
        }
        
        #background {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('/api/placeholder/1920/1080');
            background-size: cover;
            background-position: center;
            filter: brightness(0.2) contrast(1.3) saturate(0.5) hue-rotate(240deg);
            z-index: -1;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(5, 11, 92, 0.6) 0%, rgba(0,0,0,0.9) 100%);
            z-index: 0;
        }
        
        .flicker {
            animation: flicker 8s infinite alternate;
        }
        
        @keyframes flicker {
            0%, 18%, 22%, 25%, 53%, 57%, 100% {
                opacity: 1;
            }
            20%, 24%, 55% {
                opacity: 0.7;
            }
        }
        
        #game-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }
        
        #monitor {
            width: 80%;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.9);
            border: 3px solid #111;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(120, 0, 170, 0.5);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }
        
        #monitor::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, transparent, rgba(120, 0, 170, 0.8), transparent);
            animation: scanline 6s linear infinite;
        }
        
        @keyframes scanline {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(100vh);
            }
        }
        
        #question-container {
            text-align: center;
            font-size: 24px;
            color: #a30;
            text-shadow: 0 0 8px #a30;
            margin-bottom: 30px;
        }
         
        #options-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }   
        
        .option {
            padding: 10px 15px;
            background-color: rgba(15, 10, 20, 0.9);
            border: 1px solid #603;
            color: #b8a;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: left;
        }
        
        .option:hover {
            background-color: rgba(60, 0, 50, 0.8);
            transform: scale(1.02);
            box-shadow: 0 0 10px rgba(120, 0, 170, 0.5);
        }
        
        #timer-container {
            width: 80%;
            max-width: 800px;
            height: 20px;
            background-color: rgba(0, 0, 0, 0.9);
            border: 1px solid #603;
            margin-bottom: 20px;
        }
          
        #timer-bar {
            height: 100%;
            width: 100%;
            background-color: #803;
            transition: width 1s linear;
        }
        
        #health-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .health-unit {
            width: 30px;
            height: 30px;
            background-color: #800;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        }
        
        .health-lost {
            background-color: #300;
        }
        
        #inventory {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: rgba(20, 0, 30, 0.8);
            border: 1px solid #503;
            padding: 10px;
            display: flex;
            gap: 10px;
        }
        
        .inventory-item {
            width: 50px;
            height: 50px;
            background-color: #111;
            border: 1px solid #603;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #a8a;
        }
        
        #clue-container {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(30, 0, 30, 0.9);
            border: 1px solid #503;
            padding: 10px;
            max-width: 300px;
            font-size: 16px;
            color: #a08;
            transform: translateX(320px);
            transition: transform 0.5s ease;
        }
        
        #game-over, #level-complete {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }
        
        #game-over h1, #level-complete h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        #game-over h1 {
            color: #800;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }
        
        #level-complete h1 {
            color: #508;
            text-shadow: 0 0 10px rgba(120, 0, 170, 0.5);
        }
        
        .restart-btn, .next-level-btn {
            padding: 15px 30px;
            font-size: 20px;
            background-color: #222;
            color: #bbb;
            border: 1px solid #444;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .restart-btn:hover, .next-level-btn:hover {
            background-color: #333;
            box-shadow: 0 0 15px rgba(120, 0, 170, 0.5);
        }
        
        .beep {
            animation: beep 0.5s ease;
        }
        
        @keyframes beep {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .shake {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        /* Efectos sangrientos adicionales */
        .blood-drops {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
        }
        
        .blood-drop {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #800;
            border-radius: 50% 50% 50% 0;
            box-shadow: 0 0 10px rgba(150, 0, 0, 0.8);
            opacity: 0.8;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>
    <div id="background"></div>
    <div class="overlay"></div>
    
    <div class="blood-drops">
        <div class="blood-drop" style="top: 10%; left: 5%; transform: rotate(45deg) scale(2);"></div>
        <div class="blood-drop" style="top: 15%; left: 90%; transform: rotate(30deg) scale(3);"></div>
        <div class="blood-drop" style="top: 60%; left: 80%; transform: rotate(60deg) scale(1.5);"></div>
        <div class="blood-drop" style="top: 80%; left: 15%; transform: rotate(20deg) scale(2.5);"></div>
        <div class="blood-drop" style="top: 40%; left: 50%; transform: rotate(75deg) scale(4);"></div>
    </div>
    
    <div id="game-container">
        <div id="health-container">
            <div class="health-unit"></div>
            <div class="health-unit"></div>
            <div class="health-unit"></div>
        </div>
        
        <div id="timer-container">
            <div id="timer-bar"></div>
        </div>
        
        <div id="monitor" class="flicker">
            <div id="question-container">Cargando sistema...</div>
            <div id="options-container"></div>
        </div>
        
        <div id="inventory">
            <div class="inventory-item" data-item="jeringa">💉</div>
            <div class="inventory-item" data-item="llave">🔑</div>
            <div class="inventory-item" data-item="medicina">💊</div>
        </div>
        
        <div id="clue-container">
            Pista: Observa cuidadosamente los síntomas antes de elegir el tratamiento.
        </div>
    </div>
    
    <div id="game-over">
        <h1>PACIENTE FALLECIDO</h1>
        <p>Has cometido demasiados errores. El paciente no ha sobrevivido.</p>
        <button class="restart-btn">Reintentar</button>
    </div>
    
    <div id="level-complete">
        <h1>NIVEL COMPLETADO</h1>
        <p>¡Has salvado al paciente! Puedes continuar al siguiente nivel.</p>
        <button class="next-level-btn">Siguiente Nivel</button>
    </div>
    
    <script>
        // Configuración del juego
        const questions = [
            {
                question: "Que numero es Primo",
                options: [
                    { text: "97", correct: true },
                    { text: "91", correct: false },
                    { text: "143", correct: false },
                    { text: "121", correct: false }
                ],
                clue: "sus factores se dividen entre 3 sin decimales?"
            },
            {
                question: "¿Quién formuló la ecuación que describe la relatividad general?",
                options: [
                    { text: "Isaac Newton", correct: false },
                    { text: "Max Planck", correct: false },
                    { text: "Albert Einstein", correct: true },
                    { text: "Nikola Tesla", correct: false }
                ],
                clue: "Me gustan las manzanas"
            },
            {
                question: "¿Cuál de estos países no tiene salida al mar?",
                options: [
                    { text: "Paraguay", correct: true },
                    { text: "Portugal", correct: false },
                    { text: "Malasia", correct: fasle },
                    { text: "Venezuela", correct: false }
                ],
                clue: "Tendriamos que sacar el Paraguas no?"
            },
            {
                question: "En programación, ¿qué significa el acrónimo JSON?",
                options: [
                    { text: "JavaScript Oriented Notation", correct: false },
                    { text: "Java Object Naming", correct: false },
                    { text: "JavaScript Object Notation", correct: true },
                    { text: "Java Standard Output Notation", correct: false }
                ],
                clue: "Como es el formato del archivo?"
            },
            
            {
                question: "Si un caracol sube 3 metros de día pero resbala 2 metros de noche en un pozo de 10 metros, ¿cuántos días tardará en salir?",
                options: [
                    { text: "7 días", correct: false },
                    { text: "9 días", correct: false },
                    { text: "8 días", correct: true },
                    { text: "10 días", correct: false }
                ],
                clue: "Cuantos Metros sube cada dia?"
            }
        ];
        
        // Variables del juego
        let currentQuestionIndex = 0;
        let health = 3;
        let timeLeft = 100;
        let timerInterval;
        let clueShown = false;
        
        // Elementos del DOM
        const questionContainer = document.getElementById('question-container');
        const optionsContainer = document.getElementById('options-container');
        const timerBar = document.getElementById('timer-bar');
        const healthUnits = document.querySelectorAll('.health-unit');
        const clueContainer = document.getElementById('clue-container');
        const monitor = document.getElementById('monitor');
        const gameOverScreen = document.getElementById('game-over');
        const levelCompleteScreen = document.getElementById('level-complete');
        
        
        
        // Iniciar juego
        function startGame() {
            currentQuestionIndex = 0;
            health = 3;
            resetHealthDisplay();
            showQuestion(currentQuestionIndex);
            gameOverScreen.style.display = 'none';
            levelCompleteScreen.style.display = 'none';
        }
        
        // Mostrar pregunta actual
        function showQuestion(index) {
            const question = questions[index];
            questionContainer.textContent = question.question;
            
            // Limpiar opciones anteriores
            optionsContainer.innerHTML = '';
            
            // Crear nuevos botones de opciones
            question.options.forEach((option, i) => {
                const button = document.createElement('button');
                button.classList.add('option');
                button.textContent = option.text;
                button.addEventListener('click', () => selectAnswer(option.correct));
                optionsContainer.appendChild(button);
            });
            
            // Actualizar la pista
            clueContainer.textContent = "Pista: " + question.clue;
            clueShown = false;
            clueContainer.style.transform = 'translateX(320px)';
            
            // Reiniciar el temporizador
            resetTimer();
        }
        
        // Seleccionar respuesta
        function selectAnswer(isCorrect) {
            clearInterval(timerInterval);
            
            if (isCorrect) {
                // Respuesta correcta
                monitor.classList.add('beep');
                setTimeout(() => {
                    monitor.classList.remove('beep');
                    currentQuestionIndex++;
                    
                    if (currentQuestionIndex >= questions.length) {
                        // Completó todas las preguntas
                        levelComplete();
                    } else {
                        showQuestion(currentQuestionIndex);
                    }
                }, 1000);
            } else {
                // Respuesta incorrecta
                monitor.classList.add('shake');
                addBloodEffect(); // Añadir efecto de sangre en respuesta incorrecta
                
                setTimeout(() => {
                    monitor.classList.remove('shake');
                    loseHealth();
                    
                    if (health <= 0) {
                        gameOver();
                    } else {
                        // Mostrar pista después de respuesta incorrecta
                        showClue();
                    }
                }, 500);
            }
        }
        
        // Perder salud
        function loseHealth() {
            health--;
            healthUnits[health].classList.add('health-lost');
            // Efecto de sangre al perder salud
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    addBloodEffect();
                }, i * 300);
            }
        }
        
        // Resetear visualización de salud
        function resetHealthDisplay() {
            healthUnits.forEach(unit => {
                unit.classList.remove('health-lost');
            });
        }
        
        // Mostrar pista
        function showClue() {
            clueShown = true;
            clueContainer.style.transform = 'translateX(0)';
            
            // Ocultar la pista después de 8 segundos
            setTimeout(() => {
                if (clueShown) {
                    clueContainer.style.transform = 'translateX(320px)';
                    clueShown = false;
                }
            }, 8000);
        }
        
        // Resetear temporizador
        function resetTimer() {
            clearInterval(timerInterval);
            timeLeft = 100;
            timerBar.style.width = '100%';
            
            timerInterval = setInterval(() => {
                timeLeft -= 1;
                timerBar.style.width = timeLeft + '%';
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    loseHealth();
                    
                    if (health <= 0) {
                        gameOver();
                    } else {
                        // Muestra pista si se acaba el tiempo
                        showClue();
                        resetTimer();
                    }
                }
                
                // Cambiar color del temporizador cuando queda poco tiempo
                if (timeLeft <= 20) {
                    timerBar.style.backgroundColor = '#500';
                } else {
                    timerBar.style.backgroundColor = '#803';
                }
            }, 200); // Ajusta este valor para cambiar la velocidad del temporizador
        }
        
        // Juego terminado
        function gameOver() {
            clearInterval(timerInterval);
            gameOverScreen.style.display = 'flex';
            // Muchos efectos de sangre en game over
            for (let i = 0; i < 15; i++) {
                setTimeout(() => {
                    addBloodEffect();
                }, i * 200);
            }
        }
        
        // Nivel completado
        function levelComplete() {
            clearInterval(timerInterval);
            levelCompleteScreen.style.display = 'flex';
        }
        
        // Event listeners
        document.querySelector('.restart-btn').addEventListener('click', startGame);
        document.querySelector('.next-level-btn').addEventListener('click', () => {
            alert('¡Felicidades! Has completado el nivel 3. El próximo nivel está en desarrollo.');
        });
        
        // Iniciar el juego
        window.addEventListener('load', startGame);
    </script>
</body>
</html>