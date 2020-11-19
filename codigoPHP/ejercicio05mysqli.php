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
         *   @since: 15/11/2020
         *   05.- Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.

        */ 
        require_once '../config/confDBmysqli.php';
        
        $controlador = new mysqli_driver(); // creo un objeto de la clase mysqli_driver
        $controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT; // Establece reporte de errore mysqli y que salte excepcion

        
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new mysqli(); //Instanciamos un objeto mysqli
            $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos
            
            $miDB->autocommit(false); //Deshabilita el modo autocommit
            
            
            $sqlInserccion1="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('FIN', 'Departamento financiero',50.3)";
            $sqlInserccion2="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('MKT', 'Departamento de marketing',500.3)";
            $sqlInserccion3="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('LYO', 'Departamento de logística y operaciones',200.5)";
            
            $resultadoConsulta1 = $miDB->query($sqlInserccion1);
            $resultadoConsulta2 = $miDB->query($sqlInserccion2);
            $resultadoConsulta3 = $miDB->query($sqlInserccion3);
            
            $miDB->commit(); // Confirma los cambios y los consolida
            
            
            echo "<p style='color:green;'>INSTRUCCIONES REALIZADAS CON EXITO</p>";
        }catch (mysqli_sql_exception $miExceptionMysqli) { // Codigo que se ejecuta si hay alguna excepcion
            $miDB->rollback(); // Revierte o deshace los cambios
            echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
            echo "<p style='color:red;'>Código de error: ".$miExceptionMysqli->getCode()."</p>"; // Muestra el codigo del error
            exit("<p style='color:red;'>Error: ".$miExceptionMysqli->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
        }finally{ // codigo que se ejecuta haya o no errores
            $miDB->close(); // Cierra la conexion con la base de datos
        }
        
        ?>
            
    </body>
</html>