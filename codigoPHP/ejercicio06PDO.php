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
        require_once '../config/confDBPDO.php';
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
            
            
            
            $sql = 'INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES (:CodDepartamento, :DescDepartamento,:VolumenNegocio)';
            
            $consulta = $miDB->prepare($sql);
            
            $departamentosnuevos[0] = [":CodDepartamento" => "DEW", // declaro la primera posicion del array de departamentosnuevos con los datos del primer departamento
                                     ":DescDepartamento" => "Departamento 1",
                                     ":VolumenNegocio" => 35];
            
            $departamentosnuevos[1] = [":CodDepartamento" => "LOL", // declaro la segunda posicion del array de departamentosnuevos con los datos del segundo departamento
                                     ":DescDepartamento" => "Departamento 2",
                                     ":VolumenNegocio" => 6.25];
            
            $departamentosnuevos[2] = [":CodDepartamento" => "HJL", // declaro la tercera posicion del array de departamentosnuevos con los datos del tercer departamento
                                     ":DescDepartamento" => "Departamento 3",
                                     ":VolumenNegocio" => 50.2];
            
            for($nDepartamento=0;$nDepartamento<=2;$nDepartamento++){ // recorro el array de departamentosnuevos 
                $consulta->execute($departamentosnuevos[$nDepartamento]); // ejecuto la consulta con los datos del departamento que esta en la posicion $nDepartamento
            }
            
            echo "<p style='color:green;'>INSTRUCCIONES REALIZADAS CON EXITO</p>";
            
            $sql2="SELECT * FROM Departamento";
            $consulta2=$miDB->prepare($sql2); // preparo la consulta
            $consulta2->execute(); // ejecuto la consulta
            
        ?>
        <table>
            <tr>
                <th>CodDepartamento</th>
                <th>DescDepartamento</th>
                <th>FechaBaja</th>
                <th>VolumenNegocio</th>
            </tr>
            <?php 
                $oDepartamento = $consulta2->fetchObject(); // Obtengo el primer registro de la consulta como un objeto
                while($oDepartamento) { // recorro los registros que devuelve la consulta de la consulta ?>
            <tr>
                <td><?php echo $oDepartamento->CodDepartamento; // obtengo el valor del codigo del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->FechaBaja; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
                <td><?php echo $oDepartamento->VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual ?></td>
            </tr>
            <?php 
                $oDepartamento = $consulta2->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta 
            }
            ?>
        </table>      
        <?php
        
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