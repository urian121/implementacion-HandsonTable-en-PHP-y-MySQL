<?php

// Lista de empleados para pintar en el Handsontable, retornando un array de objetos que representa las filas de la tabla
function getEmpleados($conexion)
{
    $sql = "SELECT * FROM tbl_empleados ORDER BY created_at;";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }

    $data = [];
    while ($row = $resultado->fetch_assoc()) {
        $data[] = $row;
    }
    return json_encode($data);
}


// Lista de empleados para el reporte

function getEmpleadosReporte($conexion)
{
    $sql = "SELECT * FROM tbl_empleados ORDER BY created_at DESC;";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
