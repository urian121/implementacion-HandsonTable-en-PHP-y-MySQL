<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Reporte HandsonTable</title>

    <head>

    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filterData'])) {
            $data = json_decode($_POST['filterData'], true);

            date_default_timezone_set("America/Bogota");
            $fechaActual = date("d/m/Y");
            $nameFile = 'Reporte_' . $fechaActual . '.xls';

            // Configurar cabeceras para la descarga
            header("Expires: Mon, 26 Jul 2227 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header("Content-type: application/x-msexcel");
            header("Content-Disposition: attachment; filename=\"{$nameFile}\"");
            header("Content-Description: PHP Generado Data");


            echo "<table style='text-align: center;' border='1' cellpadding=1 cellspacing=1>";
            echo "<thead>";
            echo "<tr style='background: #D0CDCD; font-size: 20px'>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Cedula</th>
                    <th>Sexo</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Fecha de Registro</th>
                </tr>";
            echo "</thead>";
            echo "<tbody>";

            // Recorrer el arreglo de datos y mostrarlos en la tabla
            foreach ($data as $row) {
                echo '<tr>';
                foreach ($row as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }
                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
            exit();
        }

        ?>
    </body>

</html>