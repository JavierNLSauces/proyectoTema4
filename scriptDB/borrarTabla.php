<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Borrar tabla Departamento</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 27/10/2020
         *   

        */ 
            require_once '../config/confDBPDO.php';
            echo "<h2>Contenido tabla Departamentos </h2>";
            try { // Bloque de código que puede tener excepciones en el objeto PDO
                $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos
                
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                
                $sql = 'DROP TABLE Departamento';
                $miDB->exec($sql);

               
               echo "<p style='color:green;'>BORRADO CORRECTO</p>";
            }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                echo "<p style='color:red;'>ERROR</p>";
                echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
                echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
            }finally{
                unset($miDB);
            }

        ?> 
    </body>
</html>



