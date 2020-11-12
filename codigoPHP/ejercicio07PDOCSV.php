<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 07 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   07. Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el directorio .../tmp/ del servidor
        */ 
        require_once '../config/confDBPDO.php';
        
        
        
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
            
            if (($puntero = fopen("../tmp/exportacion.csv", "r"))) { // abre el puntero en modo lectura
                $sql = 'INSERT INTO Departamento VALUES (:CodDepartamento, :DescDepartamento,:FechaBaja,:VolumenNegocio)';
            
                $consulta = $miDB->prepare($sql);// prepara la consulta
                while (($departamento = fgetcsv($puntero))) { //va recorriendo las lineas del fichero csv
                    $parametros = [ ":CodDepartamento"=>$departamento[0],
                                    ":DescDepartamento"=>$departamento[1],
                                    ":FechaBaja"=>$departamento[2],
                                    ":VolumenNegocio"=>$departamento[3]
                                  ];
            
                    if(empty($parametros[':FechaBaja'])){ // si la fecha de baja esta vacia
                        $parametros[':FechaBaja']=null; // establece el parametro fecha de baja a null
                    }

                    $consulta->execute($parametros); // ejecuta la consulta
                }
                fclose($puntero); // cierra el puntero
                
                echo "<p style='color:green;'>IMPORTACION REALIZADA CORRECTAMENTE</p>";
            }
        
        }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
            echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
            echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
            die(); // Finalizo el script
        }finally{ // codigo que se ejecuta haya o no errores
            unset($miDB);// destruyo la variable 
        }
        
        ?>
            
    </body>
</html>