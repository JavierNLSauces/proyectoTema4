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
            
            /* Sin consulta preparada
            $sqlInserccion1="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('JJJ', 'Descripcion departamento nuevo 5',50.3)";
            $sqlInserccion2="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('LLL', 'Descripcion departamento nuevo 6',500.3)";

            $sqlInserccion3="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('PPP', 'Descripcion departamento nuevo 7',200.5)";
            
            $numRegistros1 = $miDB->exec($sqlInserccion1);
            $numRegistros2 = $miDB->exec($sqlInserccion2);
            $numRegistros3 = $miDB->exec($sqlInserccion3);
            */
            
            $sql = <<<CONSULTA
                INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES
                (:CodDepartamento1, :DescDepartamento1,:VolumenNegocio1),
                (:CodDepartamento2, :DescDepartamento2,:VolumenNegocio2),
                (:CodDepartamento3, :DescDepartamento3,:VolumenNegocio3); 
CONSULTA;
            
            $resultadoConsulta = $miDB->prepare($sql); // asigno a una variable de tipo PDOStatement
            
            $parametros = [ ":CodDepartamento1" => "FIN",
                            ":DescDepartamento1" => "Departamento financiero",
                            ":VolumenNegocio1" => 50.3,
                            ":CodDepartamento2" => "MKT",
                            ":DescDepartamento2" => "Departamento de marketing",
                            ":VolumenNegocio2" => 20.35,
                            ":CodDepartamento3" => "LYO",
                            ":DescDepartamento3" => "Departamento de logística y operaciones",
                            ":VolumenNegocio3" => 200.15 ];
            
            
            $resultadoConsulta->execute($parametros);
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