<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga CSV</title>
</head>

<body>
    <h1>Seleccionar paraprocesar y luego mostar tabla</h1>
    <input type="file" name="archivocsv" id="archivocsv" accept=".csv , .CSV">
    <hr>
    <pre id="contenido" style=" max-height: 450px; overflow: scroll;"></pre>
    <input type="button" value="Guardar" id="btn-guardar">
    <div id="pruebalista"></div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let encabezados = new Array()
    let datosContenido = new Array()
    let contenidoLista = new Array()

    function crearTabla(data) {

        const contenido = data.split(/\r?\n|\r/)
        let tabla = '<table style="width: 100%; border-collapse: collapse;">'

        for (let fila = 0; fila < contenido.length - 1; fila++) {

            const celdas = contenido[fila].split(',')

            if (fila == 0) {
                tabla += '<thead>'
                tabla += '<tr>'
            } else {
                tabla += '<tr>'
                contenidoLista.push(celdas)
            }


            for (let rowCell = 0; rowCell < celdas.length; rowCell++) {


                if (fila == 0) {

                    tabla += '<th>'
                    tabla += celdas[rowCell]
                    tabla += '</th>'

                    encabezados.push(celdas[rowCell])

                } else {

                    tabla += '<td>'
                    tabla += celdas[rowCell]
                    tabla += '</td>'
                }


            }

            if (fila === 0) {
                tabla += '</tr>'
                tabla += '</thead>'
                tabla += '<tbody>'
            } else {
                tabla += '</tr>'
            }

        }
        tabla += '</thead>'
        tabla += '</tbody>'
        tabla += '</table>'

        console.log(encabezados)
        console.log(contenidoLista)
        ///document.querySelector('#pruebalista').innerHTML = datosContenido
        document.querySelector('#contenido').innerHTML = tabla
    }

    function leerArchivoCSV(evt) {

        let archivo = event.target.files[0]
        let fileReader = new FileReader()

        fileReader.onload = (e) => {
            crearTabla(e.target.result)
        }

        fileReader.readAsText(archivo)
    }

    document.querySelector('#archivocsv')
        .addEventListener('change', leerArchivoCSV, false)
</script>

<script>
    $('#btn-guardar').on('click', function() {
        $.ajax({
            method: 'post',
            url: 'parseocsv.php',
            data: {
                'encabezado': encabezados,
                'datos': contenidoLista
            },
            success: function(exp) {
                $('#pruebalista').html(exp)
                
                encabezados = new Array()
                datosContenido = new Array()
                contenidoLista = new Array()
            }
        })
    })
</script>

</html>