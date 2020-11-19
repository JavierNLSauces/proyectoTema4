<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 06 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   06. Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada. Probar consultas preparadas sin bind, pasando los parámetros en un array a execute.

        */ 
        require_once '../config/confDBmysqli.php';
        
        $controlador = new mysqli_driver(); // creo un objeto de la clase mysqli_driver
        $controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT; // Establece reporte de errore mysqli y que salte excepcion

        
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new mysqli(); //Instanciamos un objeto mysqli
            $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos
                
            
            $consulta = $miDB->stmt_init(); // Inicializa una sentencia y devuelve un objeto para usarlo con mysqli_stmt::prepare()
            $sql = 'INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES (?,?,?)';
            
            $consulta = $miDB->prepare($sql);
            
            $departamentosnuevos = [
                                    ["CodDepartamento" => "RHS", // declaro la primera posicion del array de departamentosnuevos con los datos del primer departamento
                                     "DescDepartamento" => "Departamento de recursos humanos",
                                     "VolumenNegocio" => 35],
                                    ["CodDepartamento" => "CDG", // declaro la segunda posicion del array de departamentosnuevos con los datos del segundo departamento
                                     "DescDepartamento" => "Departamento de control de gestión",
                                     "VolumenNegocio" => 6.25],
                                    ["CodDepartamento" => "CPS", // declaro la tercera posicion del array de departamentosnuevos con los datos del tercer departamento
                                     "DescDepartamento" => "Departamento de compras",
                                     "VolumenNegocio" => 50.2]
            ];
            
            $miDB->autocommit(false); //Deshabilita el modo autocommit
            
            foreach($departamentosnuevos as $nDepartamento){ // recorro el array de departamentosnuevos 
                $consulta->bind_param('ssd', $nDepartamento['CodDepartamento'],$nDepartamento['DescDepartamento'],$nDepartamento['VolumenNegocio']); // da valor a los parametro de la consulta

                $consulta->execute(); // ejecuta la consulta 
            }
            
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