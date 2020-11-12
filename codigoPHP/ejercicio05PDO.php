<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 05 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   05.- Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.

        */ 
        require_once '../config/confDBPDO.php';
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
            
            $miDB->beginTransaction(); //Deshabilita el modo autocommit
            
            
            $sqlInserccion1="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('FIN', 'Departamento financiero',50.3)";
            $sqlInserccion2="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('MKT', 'Departamento de marketing',500.3)";

            $sqlInserccion3="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('LYO', 'Departamento de logística y operaciones',200.5)";
            
            $numRegistros1 = $miDB->exec($sqlInserccion1);
            $numRegistros2 = $miDB->exec($sqlInserccion2);
            $numRegistros3 = $miDB->exec($sqlInserccion3);
            
            $miDB->commit(); // Confirma los cambios y los consolida
            
            
            echo "<p style='color:green;'>INSTRUCCIONES REALIZADAS CON EXITO</p>";
        }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
            echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
            echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
            $miDB->rollBack(); // Revierte o deshace los cambios
            die(); // Finalizo el script
        }finally{ // codigo que se ejecuta haya o no errores
            unset($miDB);// destruyo la variable 
        }
        
        ?>
            
    </body>
</html>