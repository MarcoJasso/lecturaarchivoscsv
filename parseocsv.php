<?php

include_once 'Querys.php';


if (isset($_POST['datos']) && isset($_POST['encabezado'])):
    
    $datos = $_POST['datos'];
    $encabezado = $_POST['encabezado'];

    print_r(addData($encabezado, $datos));

else:

    echo 'Sin datos para guardar';

endif;
/*
print_r($encabezado);

for ($i = 0; $i < sizeof($datos); $i++):

    for ($j = 0; $j < sizeof($encabezado); $j++):

         echo ''.$datos[$i][$j];

    endfor;
    echo '</br>';

endfor;
*/