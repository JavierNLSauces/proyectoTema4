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
            
            $miDB->beginTransaction(); //Deshabilita el modo autocommit
            
            foreach($departamentosnuevos as $nDepartamento){ // recorro el array de departamentosnuevos 
                $parametros = [ ":CodDepartamento" => $nDepartamento['CodDepartamento'], // guardo en el elemento el valor del codigo de departamento del array $departamento dependiendo ed la posicion
                                ":DescDepartamento" => $nDepartamento['DescDepartamento'], // guardo en el elemento el valor de la descripcion del departamento del array $departamento dependiendo ed la posicion
                                ":VolumenNegocio" => $nDepartamento['VolumenNegocio'] ]; // guardo en el elemento el valor del volumen de negocio del departamento del array $departamento dependiendo de la posicion
                
                $consulta->execute($parametros); // ejecuto la consulta con los datos del departamento que esta en la posicion $nDepartamento
            }
            
            $miDB->commit(); // Confirma los cambios y los consolida
            
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
                $miDB->rollBack(); // Revierte o deshace los cambios
                die(); // Finalizo el script
            }finally{ // codigo que se ejecuta haya o no errores
                unset($miDB);// destruyo la variable 
            }
        
        ?>
            
    </body>
</html>