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
         *   @since: 04/11/2020
         *   02.- Mostrar el contenido de la tabla Departamento y el número de registros.

        */ 
            require_once '../config/confDBPDO.php';
            echo "<h2>Contenido tabla Departamento sin consulta preparada</h2>";
            try { // Bloque de código que puede tener excepciones en el objeto PDO
                $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos
                
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                
                $sql = 'SELECT * FROM Departamento';
                $resultadoConsulta = $miDB->query($sql); // asigno a la variable el resultado de la consulta como un objeto de tipo PDOStatement
                
        ?>
        
        <table>
            <tr>
                <th>CodDepartamento</th>
                <th>DescDepartamento</th>
                <th>FechaBaja</th>
                <th>VolumenNegocio</th>
            </tr>
            <?php 
                $oDepartamento = $resultadoConsulta->fetchObject(); // Obtengo el primer registro de la consulta como un objeto
                while($oDepartamento) { // recorro los registros que devuelve la consulta de la consulta ?>
            <tr>
                <td><?php echo $oDepartamento->CodDepartamento; // obtengo el valor del codigo del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->FechaBaja; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
            </tr>
            <?php 
                $oDepartamento = $resultadoConsulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta 
            }
            ?>
        </table>
        <?php
                
                
               echo "<p>El numero de registros es: ".$resultadoConsulta->rowCount()."</p>"; // rowCount() cuenta el numero de filas que han sido afectadas por la consulta
               echo "<p style='color:green;'>CONEXIÓN ESTABLECIDA CORRECTAMENTE</p>";
            }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
                echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
                die(); // Finalizo el script
            }finally{ // codigo que se ejecuta haya o no errores
                unset($miDB);// destruyo la variable 
            }
            
            
            
            echo "<h2>Contenido tabla Departamento con consulta preparada</h2>";
            try { // Bloque de código que puede tener excepciones en el objeto PDO
                $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos
                
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                
                $sql2 = 'SELECT * FROM Departamento';
                $consulta = $miDB->prepare($sql2); // preparo la consulta
                $consulta->execute(); // ejecuto la consulta 
                
        ?> 
         <table>
            <tr>
                <th>CodDepartamento</th>
                <th>DescDepartamento</th>
                <th>FechaBaja</th>
                <th>VolumenNegocio</th>
            </tr>
            <?php 
                $oDepartamento2 = $consulta->fetchObject(); // Obtengo el primer registro de la consulta como un objeto
                while($oDepartamento2) { // recorro los registros que devuelve la consulta de la consulta ?>
            <tr>
                <td><?php echo $oDepartamento2->CodDepartamento; // obtengo el valor del codigo del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento2->DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento2->FechaBaja; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento2->VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
            </tr>
            <?php 
                $oDepartamento2 = $consulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
            }
            ?>
        </table>
        <?php
                
                
               echo "<p>El numero de registros es: ".$consulta->rowCount()."</p>"; // rowCount() cuenta el numero de filas que han sido afectadas por la consulta
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



