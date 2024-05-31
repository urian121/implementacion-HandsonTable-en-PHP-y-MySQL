<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Como usar la libreria HandsonTable en PHP y MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Agregando css de libreria HandsonTable -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css">
</head>

<body>
    <?php
    require_once('bd/configBD.php');
    require_once('consultas.php');
    $getDataEmpleados = getEmpleados($conexion);
    /*
    echo '<pre>';
    print_r($getDataEmpleados);
    echo '</pre>';
    */
    ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <h1 class="text-center fw-bold">
                    Como usar la libreria HandsonTable en PHP y MySQL
                    <hr>
                </h1>
                <a href="javascript:void(0);" class="custom_btn btn btn-success float-right" title="Descargar" onclick="exportData()">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                </a>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div id="content_handsontable"></div>
            </div>
        </div>
    </div>


    <!-- Agregando JS de libreria HandsonTable -->
    <script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
    <script>
        const dataBD = <?php echo $getDataEmpleados; ?>;
        const container = document.querySelector('#content_handsontable');
        const columnasHeaders = ['Nombre', 'Edad', 'Cedula', 'Sexo', 'Cargo', 'Telefono', 'Fecha de Registro'];

        // Definimos los encabezados de las columnas
        const encabezadosColumnas = [
            'nombre', 'edad', 'cedula', 'sexo', 'cargo', 'telefono', 'created_at'
        ];

        // Generamos los objetos de las columnas
        const customColumnHeaders = encabezadosColumnas.map(encabezado => ({
            data: encabezado
        }));


        const hot = new Handsontable(container, {
            //dataBD es la variable que contiene los datos de la base de datos que se obtuvo del servidor PHP.
            data: dataBD,
            colHeaders: columnasHeaders, // Encabezados de columnas personalizados
            columns: customColumnHeaders, // Definición de columnas
            rowHeaders: true, // Mostrar números de filas
            height: 'auto', // Altura automática
            autoWrapRow: true, // Ajuste automático de texto en filas
            autoWrapCol: true, // Ajuste automático de texto en columnas
            licenseKey: 'non-commercial-and-evaluation', // Añade tu licencia aquí si tienes una
            contextMenu: true, // Menú contextual activado
            multiColumnSorting: true, // Ordenamiento multi-columna activado
            filters: true, // Filtros activados
            manualRowMove: true, // Movimiento manual de filas activado
            dropdownMenu: true, // Menú desplegable activado
            hiddenColumns: { // Ocultar columnas
                indicators: true,
            },
            readOnly: true, // Deshabilitar la edición

            // Personalización de las celdas
            /*
             cells: function(row, col, prop) {
                 const cellProperties = {};
                 if (col === 0) { // Columna 'Serial'
                     cellProperties.renderer = function(instance, td, row, col, prop, value, cellProperties) {
                         Handsontable.renderers.TextRenderer.apply(this, arguments);
                         td.style.backgroundColor = '#ffcccb'; // Color de fondo
                     };
                 } else if (col === 1) { // Columna 'Nombre'
                     cellProperties.renderer = function(instance, td, row, col, prop, value, cellProperties) {
                         Handsontable.renderers.TextRenderer.apply(this, arguments);
                         td.style.backgroundColor = '#ccffcc'; // Color de fondo
                     };
                 }
                 // Añadir más condiciones para otras columnas si es necesario
                 return cellProperties;
             },
             */

            // Personalización de los encabezados de las columnas
            /*
                afterGetColHeader: function(col, TH) {
                    if (col >= 0) { // Evita aplicar el estilo al encabezado de las filas
                        TH.style.backgroundColor = 'green'; // Color de fondo para los encabezados de las columnas
                        TH.style.color = '#fff'; // Color del texto
                    }
                }
            */

        });


        // Acciones adicionales
        function exportData() {
            // Obtener los datos de Handsontable
            const data = hot.getData();
            const jsonData = JSON.stringify(data);

            // Crear un formulario y enviar los datos al servidor
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = './reports/reportHandsontableFiltro.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'filterData';
            input.value = jsonData;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        // Acciones adicionales
        function getData1() {
            // Crear un formulario y enviar los datos al servidor
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = './reports/reportHandsontable.php';
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>