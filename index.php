<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafío Misterioso</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Estilo general de la página */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #1a1a1a;
            color: #fff;
            font-family: 'Courier New', Courier, monospace;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Efecto Glitch */
        @keyframes glitch-anim {
            0% { transform: translate(2px, 0) skew(0.5deg); }
            20% { transform: translate(-2px, 0) skew(0.5deg); }
            40% { transform: translate(-2px, 0) skew(0.5deg); }
            60% { transform: translate(2px, 0) skew(0.5deg); }
            80% { transform: translate(2px, 0) skew(0.5deg); }
            100% { transform: translate(2px, 0) skew(0.5deg); }
        }

        /* Contenedor central */
        .container {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.8);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .container h1 {
    font-size: 3rem;
    margin-bottom: 0px;
    position: relative;
    animation: glitch-anim 1.5s infinite; /* Animación glitch */
    display: inline-block;
}

.container h1::after {
    content: "¡No esta facil!"; /* Texto actualizado aquí */
    position: absolute;
    top: 0;
    left: 0;
    color: #ff0000;
    text-shadow: 2px 0px 5px rgba(255, 0, 0, 0.8);
    z-index: -1;
    animation: glitch-anim 1.5s infinite reverse; /* Animación glitch invertida */
}
.container h2 {
    font-size: 3rem;
    margin-bottom: 20px;
    position: relative;
    animation: glitch-anim 1.5s infinite; /* Animación glitch */
    display: inline-block;
}

.container h2::after {
    
    position: absolute;
    top: 0;
    left: 0;
    color: #ff0000;
    text-shadow: 2px 0px 5px rgba(255, 0, 0, 0.8);
    z-index: -1;
    animation: glitch-anim 1.5s infinite reverse; /* Animación glitch invertida */
}

        .container p {
            font-size: 1.5rem;
            margin: 20px 0;
            color: #ccc;
        }

        /* Botón misterioso */
        .btn {
            display: inline-block;
            background: linear-gradient(45deg,rgb(33, 1, 41),rgb(46, 40, 39));
            color: #fff;
            padding: 15px 40px;
            font-size: 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
            box-shadow: 0 0 20px rgb(0, 0, 0);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(66, 71, 131, 0.28);
            transition: all 0.4s;
            border-radius: 50%;
            z-index: 0;
            transform: translate(-50%, -50%);
            animation: pulse 3.0s infinite ease-in-out;
        }

        .btn:hover {
            color: #000;
            background: #fff;
        }

        .btn:hover::before {
            width: 0;
            height: 0;
        }

        .btn span {
            position: relative;
            z-index: 1;
        }

        /* Animación de pulsación */
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.5); opacity: 0.8; }
            100% { transform: scale(1); opacity: 0.5; }
        }

        /* Contenedor de imágenes glitched */
        .image-container {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 0;
        }

        .image-container img {
            width: 220px;
            height: 140px;
            border-radius: 10px;
            object-fit: cover;
            transition: all 0.5s ease;
            position: absolute;
            cursor: pointer;
        }

        .image-container img:hover {
            transform: scale(1.2) rotate(10deg);
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.7);
        }

        .image1 { top: 5%; left: 5%; animation: glitch-anim 2s infinite; }
        .image2 { top: 5%; right: 5%; animation: glitch-anim 2.5s infinite; }
        .image3 { bottom: 5%; left: 5%; animation: glitch-anim 3s infinite; cursor: pointer; }
        .image4 { bottom: 5%; right: 5%; animation: glitch-anim 3.5s infinite; cursor: pointer; }
        
        /* Nueva imagen a la izquierda de image4 */
        .image5 {
        bottom: 7%;
        right: 15%; /* Ajusta la distancia a la derecha */
        animation: glitch-anim 4s infinite;
        cursor: pointer;
        width: 150px !important;  /* Nuevo ancho */
        height: 100px !important; /* Nueva altura */
        }


        /* Estilo del pop-up */
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.7);
        }

        #popup img {
            width: 100vw; /* La imagen cubre el 100% del ancho */
            height: 100vh;
            border-radius: 10px;
            z-index: 9999;
            object-fit: cover;
        }
    /* Estilo para el formulario de alias */
#aliasForm {
    margin-top: 20px;
    text-align: center;
    margin-bottom: 10px;
}

#alias {
    padding: 12px;
    font-size: 1.2rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    border-radius: 5px;
    text-align: center;
    width: 80%;
    max-width: 300px;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 0 10px rgba(255, 0, 150, 0.5);
}

#alias:focus {
    outline: none;
    border-color:rgb(255, 0, 0);
    box-shadow: 0 0 15pxrgb(255, 217, 0);
}

/* Animación glitch */
@keyframes glitch-anim {
    0% { transform: translate(2px, 0) skew(0.5deg); text-shadow: 2px 0px 5px rgba(255, 0, 0, 0.8); }
    20% { transform: translate(-2px, 0) skew(0.5deg); text-shadow: -2px 0px 5px rgba(255, 0, 0, 0.6); }
    40% { transform: translate(-2px, 0) skew(0.5deg); text-shadow: 3px -1px 5px rgba(255, 0, 0, 0.8); }
    60% { transform: translate(2px, 0) skew(0.5deg); text-shadow: -1px 2px 5px rgba(255, 0, 0, 0.7); }
    80% { transform: translate(2px, 0) skew(0.5deg); text-shadow: 4px -2px 5px rgba(255, 0, 0, 1); }
    100% { transform: translate(2px, 0) skew(0.5deg); text-shadow: -3px 2px 5px rgba(255, 0, 0, 0.9); }
}

#alias::placeholder {
    color: rgba(255, 255, 0, 0.6);
    font-style: italic;
    animation: glitch 1s infinite alternate;
}
</style>
</head>
<body>
    <div class="image-container">
        <img src="img/img1.jpg" alt="Imagen 1" class="image1">
        <img src="img/img2.jpg" alt="Imagen 2" class="image2">
        <img src="img/img3.jpg" alt="Imagen 3" class="image3">
        <img src="img/img4.jpg" alt="Imagen 4" class="image4" onclick="showPopup();"> <!-- Botón pop-up -->
        <img src="img/click2.gif" alt="Imagen 5" class="image5">
    </div>
    
    <div class="container">
        <header>
        <h2>💀<h2><h1>¡No esta facil!</h1><h2>👹<h2>
            
        </header>
        <main>
        <p>Aqui viene a probar criterio, atencion, sentido comun y conocimiento.</p>
        <form id="aliasForm" action="" method="POST">
                <input type="text" id="alias" name="alias" placeholder="*Ingresar alias*" required>
                <input type="hidden" id="destination" name="destination">
            </form>

            <!-- Botones de acción -->
            <a href="#" class="btn" onclick="submitForm('pages/reto1.php')"><span>Empezar</span></a>
            <a href="#" class="btn" onclick="submitForm('pages/cobarde.html')"><span>Retirarse</span></a>
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
