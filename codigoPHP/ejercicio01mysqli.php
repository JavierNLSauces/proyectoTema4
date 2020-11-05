<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 01 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 29/10/2020
         *   01.- (ProyectoTema4) Conexión a la base de datos con la cuenta usuario y tratamiento de errores.

        */ 
        require_once '../config/confDBmysqli.php'; // incluiyo las constantes con los datos para la conexion con la base de datos
        
        $controlador = new mysqli_driver(); // creo un objeto de la clase mysqli_driver
        $controlador->report_mode = MYSQLI_REPORT_STRICT; // Lanza una mysqli_exception para errors en lugar de para advertenciass 
        
        try { //Código susceptible de producir un error
            echo "<h2>Conexion correcta mysqli</h2>";
            $miDB = new mysqli(); //Instanciamos un objeto mysqli
            $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abro una conexion con la base de datos
            
            echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";
            
        }catch (mysqli_sql_exception $miException) { // Codigo que se ejecuta si hay alguna excepcion
            echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
            echo "<p style='color:red;'>Código de error: ".$miException->getCode()."</p>"; // Muestra el codigo del error
            exit("<p style='color:red;'>Error: ".$miException->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
        }finally{
            $miDB->close(); // Cierra la conexion con la base de datos
        }
        
        
        
        try{ //Código susceptible de producir un error
            echo "<h2>Conexion contraseña incorrecta mysqli</h2>";
            
            $miDB = new mysqli(); //Instanciamos un objeto mysqli
            $miDB->connect(HOST,USER,'P@sswor',DATABASE); // Abro una conexion con la base de datos
            
            echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";

        }catch (mysqli_sql_exception $miException){// Codigo que se ejecuta si hay alguna excepcion
            echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
            echo "<p style='color:red;'>Código de error: ".$miException->getCode()."</p>"; // Muestra el codigo del error
            exit("<p style='color:red;'>Error: ".$miException->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
        }finally{
           $miDB->close(); // Cierra la conexion con la base de datos 
        }
        
        
        ?> 
    </body>
</html>



