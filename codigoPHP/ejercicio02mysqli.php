<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 02 - Javier Nieto Lorenzo</title>
        <style>
            table th, table td{
                padding-left: 15px;
            }
        </style>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 14/11/2020
         *   02.- Mostrar el contenido de la tabla Departamento y el número de registros.

        */ 
            require_once '../config/confDBmysqli.php'; // incluiyo las constantes con los datos para la conexion con la base de datos
        
            $controlador = new mysqli_driver(); // creo un objeto de la clase mysqli_driver
            $controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT; // Establece reporte de errore mysqli y que salte excepcion

            try { //Bloque de código que puede tener excepciones en el objeto mysqli
                $miDB = new mysqli(); //Instanciamos un objeto mysqli
                $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos
                
                $sql = 'SELECT * FROM Departamento';
                $resultadoConsulta = $miDB->query($sql); // Realiza una consulta a la base de datos y devuelve un objeto de tipo mysqli_result (en caso de que la consulta sea SELECT,SHOW,DESCRIBE o EXPLAIN) para otras consultas ejecutadas con exito devuelve true
                echo "<h2>Contenido tabla Departamento</h2>";
        ?>
        
        <table>
            <tr>
                <th>CodDepartamento</th>
                <th>DescDepartamento</th>
                <th>FechaBaja</th>
                <th>VolumenNegocio</th>
            </tr>
            <?php 
                $oDepartamento = $resultadoConsulta->fetch_object(); // Obtiene el primer registro de la consulta como un objeto
                while($oDepartamento) { // recorro los registros que devuelve la consulta de la consulta ?>
            <tr>
                <td><?php echo $oDepartamento->CodDepartamento; // obtengo el valor del codigo del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->FechaBaja; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
            </tr>
            <?php 
                $oDepartamento = $resultadoConsulta->fetch_object(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta 
            }
            ?>
        </table>
        <?php

               echo "<p>El numero de registros es: ".$miDB->affected_rows."</p>"; // Obtiene el numero de filas que han sido afectadas por la ultima operacion MySQL
               $resultadoConsulta->free(); // Libera el espacio ocupado tras la consulta
               echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";
            }catch (mysqli_sql_exception $miExceptionMysqli) { // Codigo que se ejecuta si hay alguna excepcion
                 echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                echo "<p style='color:red;'>Código de error: ".$miExceptionMysqli->getCode()."</p>"; // Muestra el codigo del error
                exit("<p style='color:red;'>Error: ".$miExceptionMysqli->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
            }finally{ // codigo que se ejecuta haya o no errores
                $miDB->close(); // Cierra la conexion con la base de datos
            }
            
            
            
            echo "<h2>Contenido tabla Departamento con consulta preparada</h2>";
            try { //Bloque de código que puede tener excepciones en el objeto mysqli
                $miDB = new mysqli(); //Instanciamos un objeto mysqli
                $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos
                
                $consulta = $miDB->stmt_init(); // Inicializa una sentencia y devuelve un objeto para usarlo con mysqli_stmt::prepare()
                $sql = 'SELECT * FROM Departamento';
                $consulta->prepare($sql); // Realiza una consulta a la base de datos y devuelve un objeto de tipo mysqli_result (en caso de que la consulta sea SELECT,SHOW,DESCRIBE o EXPLAIN) para otras consultas ejecutadas con exito devuelve true
                $consulta->execute(); // Ejecuta la consulta
                $consulta->store_result(); // almacena el resultado de la consulta
                $consulta->bind_result($codDepartamento,$descDepartamento,$fechaBaja,$volumenNegocio); // Vincula columnas del conjunto de resultados a variables.
                if($consulta->num_rows>0){ // si devuelve 1 o mas resultados la consulta
                
        ?> 
         <table>
            <tr>
                <th>CodDepartamento</th>
                <th>DescDepartamento</th>
                <th>FechaBaja</th>
                <th>VolumenNegocio</th>
            </tr>
            <?php 
                    while($consulta->fetch()) { // Obtiene los resultados de una sentencia preparadas en las variables vinculadas?>
            <tr>
                <td><?php echo $codDepartamento; // obtengo el valor del codigo del departamento?></td>
                <td><?php echo $descDepartamento; // obtengo el valor de la descripcion del departamento?></td>
                <td><?php echo $fechaBaja; // obtengo el valor de la fecha de baja del departamento?></td>
                <td><?php echo $volumenNegocio; // obtengo el valor de la fecha de baja del departamento?></td>
            </tr>
            <?php 
                    }
                }
            ?>
        </table>
        <?php
               echo "<p>El numero de registros es: ".$consulta->num_rows."</p>"; // Obtiene el numero de filas que han sido afectadas por la consulta
               $consulta->close(); // Cierra la consulta preparada
               echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";
            }catch (mysqli_sql_exception $miExceptionMysqli) { // Codigo que se ejecuta si hay alguna excepcion
                echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                echo "<p style='color:red;'>Código de error: ".$miExceptionMysqli->getCode()."</p>"; // Muestra el codigo del error
                exit("<p style='color:red;'>Error: ".$miExceptionMysqli->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
            }finally{ // codigo que se ejecuta haya o no errores
                $miDB->close(); // Cierra la conexion con la base de datos
            }
        ?>
    </body>
</html>