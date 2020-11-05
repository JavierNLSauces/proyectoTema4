<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 00 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   01.- (ProyectoTema4) Conexión a la base de datos con la cuenta usuario y tratamiento de errores.

        */  require_once '../config/confDBPDO.php'; // incluiyo las constantes con los datos para la conexion con la base de datos
        
            echo "<h2>Conexion correcta PDO</h2>";
            try { // Bloque de código que puede tener excepciones en el objeto PDO
                $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

                $atributosPDO = ['AUTOCOMMIT', // Si este valor es FALSE, PDO intenta desactivar la autoconsigna para que la conexión comience una transacción.
                                'CASE', // Forzar a los nombres de las columnas a emplear las mayúsculas/minúsculas especificadas por las constantes PDO::CASE_*.
                                'CLIENT_VERSION', // Valor de la  información sobre la versión de las bibliotecas cliente que está usando el controlador PDO.
                                'CONNECTION_STATUS', // Valor de la IP, el pueto y la vía de conexion
                                'ERRMODE', // Valor del modo de ERROR: 0.- PDO::ERRMODE_SILENT, 1.- PDO::ERRMODE_WARNING, 2.- PDO::ERRMODE_EXCEPTION, 
                                'ORACLE_NULLS', //Convertir string vacíos a valores NULL de SQL en la obtención de datos.
                                'PERSISTENT', // Solicitar una conexión persistente, en vez de crear una nueva conexión.
                                'SERVER_INFO', // Valor de metainformación sobre el servidor de bases de datos al que está conectado PDO.
                                'SERVER_VERSION', // Valor de la información sobre la versión del servidor de bases de datos al que está conectado PDO.
                ];
                
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                
                
               foreach($atributosPDO as $atributo){ // bucle que recorre los distintos atributos de PDO del array de atributos
                   echo "<p><span style='font-weight:bold;'>PDO::ATTR_$atributo: </span>".$miDB->getAttribute(constant("PDO::ATTR_$atributo"))."</p>"; // muestro los atributos declarador en el array de atributos
               }
               
               echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";
            }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
                echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
                die(); // Finalizo el script
            }finally{ // codigo que se ejecuta haya o no errores
                unset($miDB);// destruyo la variable 
            }
            
            
            echo "<h2>Conexion contraseña erronea PDO</h2>";
            try { // Bloque de código que puede tener excepciones en el objeto PDO
                $miDB = new PDO(DNS,USER,'P@ssw0r'); // creo un objeto PDO con la conexion a la base de datos

                $atributosPDO = ['AUTOCOMMIT', // Si este valor es FALSE, PDO intenta desactivar la autoconsigna para que la conexión comience una transacción.
                                'CASE', // Forzar a los nombres de las columnas a emplear las mayúsculas/minúsculas especificadas por las constantes PDO::CASE_*.
                                'CLIENT_VERSION', // Valor de la  información sobre la versión de las bibliotecas cliente que está usando el controlador PDO.
                                'CONNECTION_STATUS', // Valor de la IP, el pueto y la vía de conexion
                                'ERRMODE', // Valor del modo de ERROR: 0.- PDO::ERRMODE_SILENT, 1.- PDO::ERRMODE_WARNING, 2.- PDO::ERRMODE_EXCEPTION, 
                                'ORACLE_NULLS', //Convertir string vacíos a valores NULL de SQL en la obtención de datos.
                                'PERSISTENT', // Solicitar una conexión persistente, en vez de crear una nueva conexión.
                                'SERVER_INFO', // Valor de metainformación sobre el servidor de bases de datos al que está conectado PDO.
                                'SERVER_VERSION', // Valor de la información sobre la versión del servidor de bases de datos al que está conectado PDO.
                ];
                
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pongo el modo de errres para que cuando haya un error se lance
                
                
               foreach($atributosPDO as $atributo){ // bucle que recorre los distintos atributos de PDO del array de atributos
                   echo "<p>PDO::ATTR_$atributo: ";
                   echo $miDB->getAttribute(constant("PDO::ATTR_$atributo"))."</p>";
               }
               
               echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";
            }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
                echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
                die(); // Finalizo el script
            }finally{ // codigo que se ejecuta haya o no errores
                unset($miDB);// destruyo la variable 
            }

        ?> 
    </body>
</html>



