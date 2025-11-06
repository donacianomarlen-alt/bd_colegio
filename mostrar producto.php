<?php
include_once("conexion.php");

$conexion_exitosa = false;
$alumnos = [];

if ($conn) {
    $conexion_exitosa = true;

    try {
        $stmt = $conn->query("SELECT id, nombre, apellido, correo, telefono, fecha_nacimiento, ciudad, promedio FROM personas ORDER BY id DESC");
        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al consultar la base de datos: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COLEGIO SADBOYZ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="logo.png">
</head>
<body>
    <div class="browser-window">
        <div class="top-bar">
            <div class="circles">
                <div class="circle circle-red"></div>
                <div class="circle circle-yellow"></div>
                <div class="circle circle-green"></div>
            </div>
            <div class="address-bar"></div>
            <div class="right-icons">
                <div class="icon"></div>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <div class="logo">
                    <img src="logo.jpg" alt="Logotipo" style="width:300px; height:200px;">
                    <h1>COLEGIO SADBOYZ</h1>
                </div>
            </div>

            <div class="actions">
                <button onclick="mostrarMensajeConexion()">Conectar BD</button>
                <button onclick="location.href='index.php'">Volver al inicio</button>
            </div>

            <div class="status-bar" id="status-bar">
                <span class="status-indicator"></span>
            </div>

            <div id="infoContacto" style="display:none; padding: 10px; background-color: #f0f0f0; border-radius: 5px; margin-bottom: 10px;">
                <p><strong>Dirección:</strong> Calle Principal #123, Ciudad</p>
                <p><strong>Teléfono:</strong> 555-1234</p>
            </div>

            <div class="data-table">
                <h2>Listado completo de alumnos (<?php echo count($alumnos); ?> registros)</h2>
                <?php if (count($alumnos) > 0): ?>
                <table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha de nacimiento</th>
                            <th>Ciudad</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['id']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['correo']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['fecha_nacimiento']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['ciudad']); ?></td>
                                <td><?php echo number_format($alumno['promedio'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p>No hay registros de alumnos en la base de datos.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        var conexionExitosa = <?php echo json_encode($conexion_exitosa); ?>;

        function mostrarMensajeConexion() {
            var statusBar = document.getElementById('status-bar');
            var statusIndicator = document.querySelector('.status-indicator');

            if (conexionExitosa) {
                statusIndicator.textContent = '✔';
                statusIndicator.style.color = 'green';
                statusBar.innerHTML = '<span class="status-indicator">✔</span> BD conectada exitosamente';
                statusBar.style.backgroundColor = '#2ecc71';
            } else {
                statusIndicator.textContent = '✖';
                statusIndicator.style.color = 'red';
                statusBar.innerHTML = '<span class="status-indicator">✖</span> Error al conectar a la BD';
                statusBar.style.backgroundColor = '#e74c3c';
            }
        }
    </script>
</body>
</html><?php
include_once("conexion.php");

$conexion_exitosa = false;
$alumnos = [];

if ($conn) {
    $conexion_exitosa = true;

    try {
        $stmt = $conn->query("SELECT id, nombre, apellido, correo, telefono, fecha_nacimiento, ciudad, promedio FROM personas ORDER BY id DESC");
        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al consultar la base de datos: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión - Colegio</title>
    <link rel="icon" href="logo27.jpg">
    <style>
        /* Fondo general */
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(to bottom right, #ffffff, #d6e9ff);
            color: #333;
            min-height: 100vh;
        }

        /* Contenedor principal */
        .container {
            width: 95%;
            max-width: 1400px;
            min-height: 95vh;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            margin: 2.5vh auto;
            overflow: hidden;
        }

        /* Encabezado */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0a4ea3;
            color: white;
            padding: 15px 40px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            animation: pulse 2s ease-in-out infinite;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .logo h1 {
            font-size: 2.2em;
            margin: 0;
            font-weight: 500;
            color: white;
        }

        .estado-conexion {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
        }

        .indicador {
            width: 12px;
            height: 12px;
            background-color: #00ff00;
            border-radius: 50%;
            box-shadow: 0 0 5px #00ff00;
        }

        /* Botones */
        .actions {
            background-color: #f5f8fc;
            padding: 20px 30px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .actions button {
            background-color: #0a4ea3;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .actions button:hover {
            background-color: #082f6b;
            transform: scale(1.05);
        }

        /* Contenido */
        .content {
            padding: 30px;
            overflow-y: auto;
            flex: 1;
        }

        /* Barra de estado */
        .status-bar {
            background-color: #0a4ea3;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(10, 78, 163, 0.3);
        }

        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #00ff00;
            box-shadow: 0 0 5px #00ff00;
        }

        /* Tabla */
        .data-table h2 {
            color: #0a4ea3;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .data-table table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .data-table th,
        .data-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .data-table th {
            background-color: #0a4ea3;
            font-weight: 600;
            color: white;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f2f6ff;
        }

        .data-table tbody tr:hover {
            background-color: #e6f0ff;
            transition: background-color 0.2s;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            background-color: #0a4ea3;
            color: white;
            margin-top: auto;
        }

        /* Animación */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }
            
            .logo h1 {
                font-size: 1.5em;
            }
            
            .data-table table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo27.jpg" alt="Logo del Colegio" class="logo-img">
                <h1>Sistema de Gestión - Colegio</h1>
            </div>
            <div class="estado-conexion">
                <span class="indicador"></span>
                BD conectada
            </div>
        </div>

        <div class="actions">
            <button onclick="mostrarMensajeConexion()">Conectar BD</button>
            <button onclick="location.href='index.php'">Volver al inicio</button>
        </div>

        <div class="content">
            <div class="status-bar" id="status-bar">
                <span class="status-indicator"></span>
                Conectado a la base de datos
            </div>

            <div class="data-table">
                <h2>Listado Completo de Alumnos (<?php echo count($alumnos); ?> registros)</h2>
                <?php if (count($alumnos) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Ciudad</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['id']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['correo']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['fecha_nacimiento']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['ciudad']); ?></td>
                                <td><?php echo number_format($alumno['promedio'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p style="text-align: center; padding: 20px; color: #666;">No hay registros de alumnos en la base de datos.</p>
                <?php endif; ?>
            </div>
        </div>

        <footer>
            <p>© 2025 Sistema de Gestión - Colegio</p>
        </footer>
    </div>

    <script>
        var conexionExitosa = <?php echo json_encode($conexion_exitosa); ?>;

        // Actualizar indicador al cargar la página
        window.onload = function() {
            var indicador = document.querySelector('.indicador');
            if (conexionExitosa) {
                indicador.style.backgroundColor = '#00ff00';
                indicador.style.boxShadow = '0 0 5px #00ff00';
            } else {
                indicador.style.backgroundColor = '#ff0000';
                indicador.style.boxShadow = '0 0 5px #ff0000';
            }
        };

        function mostrarMensajeConexion() {
            var statusBar = document.getElementById('status-bar');
            var statusIndicator = document.querySelector('.status-indicator');

            if (conexionExitosa) {
                statusIndicator.textContent = '✔';
                statusIndicator.style.color = 'white';
                statusBar.innerHTML = '<span class="status-indicator">✔</span> BD conectada exitosamente';
                statusBar.style.backgroundColor = '#2ecc71';
            } else {
                statusIndicator.textContent = '✖';
                statusIndicator.style.color = 'white';
                statusBar.innerHTML = '<span class="status-indicator">✖</span> Error al conectar a la BD';
                statusBar.style.backgroundColor = '#e74c3c';
            }
        }
    </script>
</body>
</html>