<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Global | Defensores de la Tierra</title>
    <style>
        :root {
            --primary: #00f2ff;
            --secondary: #7000ff;
            --bg: #050510;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
            background-image: radial-gradient(circle at top, #1a1a2e, #050510);
        }

        h2 {
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
        }

        .ranking-container {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.1rem;
        }

        th {
            text-align: left;
            padding: 15px;
            color: var(--primary);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 2px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .pos { font-weight: 900; color: #ff9800; }
        .user { font-weight: 600; }
        .score { color: var(--primary); font-family: monospace; font-size: 1.3rem; }
        .level { color: #00ff88; font-weight: bold; }

        .btn-back {
            margin-top: 40px;
            padding: 12px 30px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.2s;
        }

        .btn-back:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h2>Top 10 Defensores</h2>

    <div class="ranking-container">
        <?php
        $puerto = 3306; // ⚠️ CAMBIA ESTE NÚMERO POR EL PUERTO QUE PUSISTE EN XAMPP (ej. 3307)
        $conexion = mysqli_connect("localhost", "root", "", "JUEGO_NASA", 3307);

        if (!$conexion) {
            echo "<p style='color: #ff0055;'>Error de conexión: " . mysqli_connect_error() . "</p>";
        } else {
            $sql = "SELECT usuario, puntaje, nivel FROM scores ORDER BY puntaje DESC LIMIT 10";
            $resultado = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($resultado) > 0) {
                echo "<table>";
                echo "<tr>
                    <th>Pos</th>
                    <th>Usuario</th>
                    <th>Nivel</th>
                    <th>Puntaje</th>
                </tr>";

                $posicion = 1;
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td class='pos'>#".$posicion."</td>
                        <td class='user'>".htmlspecialchars($fila['usuario'])."</td>
                        <td class='level'>Lvl ".$fila['nivel']."</td>
                        <td class='score'>".number_format($fila['puntaje'])."</td>
                    </tr>";
                    $posicion++;
                }
                echo "</table>";
            } else {
                echo "<p style='text-align: center; color: #888;'>No hay puntajes registrados todavía.</p>";
            }
            mysqli_close($conexion);
        }
        ?>
    </div>

    <a href="index.html" class="btn-back">Regresar al Juego</a>
</body>
</html>
