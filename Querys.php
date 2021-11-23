<?php
include_once 'Conexion.php';

function addData($encabezado, $datos)
{
    $conn = new Conexion();


    if ($conn->connection() != null) :

        //return implode(",", $encabezado);
        //return implode(",", $datos[0]);

        $head = implode(",", $encabezado);
        $salida = "";

        for ($i = 0; $i < sizeof($datos); $i++) :

            $data = implode(",", $datos[$i]);
            $query = "INSERT INTO datoscsv(" . $head . ") VALUES";
            //$query = ") VALUES ";

            for ($j = 0; $j < sizeof($encabezado); $j++) :


                //echo '' . $datos[$i][$j];

                if ($j == 0):
                    
                    $query .= "(".intval($datos[$i][$j]);

                
                else:

                    $query .= ",'".$datos[$i][$j]."'";
                    
                endif;

                if ($j == (sizeof($encabezado) - 1)):

                    $query .= ");";
                endif;    

            endfor;

            //$salida .= $query ."</br>";
            
            //$query = "INSERT INTO datoscsv(".$head.") VALUES (15 , 'titulo 15', 'marca 15', 'nombre 15');";


            $stmt = $conn->connection()->prepare($query);

            //$stmt->bindValue(':encabezado', $head);
            //$stmt->bindValue(':id', intval($datos[$i][0]));
            //$stmt->bindValue(':datos', $data);

            if (!$stmt->execute()) :
                return $stmt->errorInfo();
            endif;

        endfor;
        return "Fin del proceso";
    else :

        return "Error de conexion";
    endif;
}
