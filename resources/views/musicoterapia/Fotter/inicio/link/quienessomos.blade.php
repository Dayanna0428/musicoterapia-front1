<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            flex-direction: column;
        }

        .section img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .section-content {
            max-width: 600px;
        }

        h2 {
            color: #59009A;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        p {
            line-height: 1.6;
            text-align: justify;
        }

        @media (min-width: 768px) {
            .section {
                flex-direction: row;
                text-align: left;
            }

            .section:nth-child(even) {
                flex-direction: row-reverse;
            }

            h2 {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Descripción de Quiénes Somos -->
        <div class="section">
            <img src="{{ asset('image\images\QUIENES SOMOS.png') }}" alt="Imagen representativa de Quiénes Somos">
            <div class="section-content">
                <h2>Quiénes Somos</h2>
                <p>
                    En "Tranquilidad", somos una plataforma dedicada a brindar apoyo emocional y mental a personas que buscan gestionar su bienestar. Nos enfocamos en desarrollar módulos interactivos y dinámicos que ayudan a reducir los efectos de la ansiedad y la depresión, ofreciendo herramientas como mapas de sueños, lecturas inspiradoras, rutinas de ejercicio, citas motivacionales y listas de reproducción musicales cuidadosamente seleccionadas. Nuestro propósito es proporcionar un espacio donde los usuarios puedan encontrar equilibrio emocional y descubrir recursos valiosos para su crecimiento personal.
            </div>
        </div>

        <!-- Misión -->
        <div class="section">
            <img src="{{ asset('image\images\QUIENES SOMOS.png') }}" alt="Imagen de Misión">
            <div class="section-content">
                <h2>Nuestra Misión</h2>
                <p>
                    Nuestra misión en "Tranquilidad" es ser una guía accesible y efectiva en el camino hacia el bienestar emocional. Buscamos ofrecer a cada usuario recursos que le permitan gestionar la ansiedad y la depresión de manera proactiva, a través de un enfoque intuitivo y compasivo. Con herramientas que inspiran a la reflexión y el autocuidado, queremos acompañar a nuestros usuarios en su proceso de crecimiento personal y salud mental.
                </p>
            </div>
        </div>

        <!-- Visión -->
        <div class="section">
            <img src="{{ asset('image\images\QUIENES SOMOS.png') }}" alt="Imagen de Visión">
            <div class="section-content">
                <h2> Nuestra Visión</h2>
                <p>
                    Aspiramos a convertirnos en la plataforma de referencia en el ámbito de la salud emocional y mental en Colombia y en la comunidad hispanohablante. Queremos impactar positivamente en la vida de millones de personas, facilitando un acceso sencillo a recursos de bienestar. Nuestra visión es evolucionar constantemente para adaptarnos a las necesidades de nuestros usuarios, promoviendo una cultura de autocuidado y equilibrio emocional sostenible.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
