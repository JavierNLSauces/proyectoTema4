<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 08 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   08. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se encuentra en el directorio .../tmp/ del servidor.
             
        */ 
        require_once '../config/confDBPDO.php';
        
        
        
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
            
            $sql="SELECT * FROM Departamento";
            $consulta=$miDB->prepare($sql);
            $consulta->execute();
            
            $puntero = fopen('../tmp/exportacion.csv','w+');
            
            $oDepartamento = $consulta->fetchObject(); // Obtengo el primer registro de la consulta como un objeto
            
            $nDep=0;
            while($oDepartamento) { // recorro los registros que devuelve la consulta de la consulta 
                $aDepartamento[$nDep]['CodDepartamento']=$oDepartamento->CodDepartamento; // obtengo el valor del codigo del departamento del registro actual 
                $aDepartamento[$nDep]['DescDepartamento']=$oDepartamento->DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual 
                $aDepartamento[$nDep]['FechaBaja']=$oDepartamento->FechaBaja; // obtengo el valor de la fecha de baja del departamento del registro actual 
                $aDepartamento[$nDep]['VolumenNegocio']=$oDepartamento->VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual 
                
                fputcsv($puntero, $aDepartamento[$nDep]);
                
                $nDep++;
                
                $oDepartamento = $consulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
            }
            
            fclose($puntero); // cierra el puntero
            
            echo "<p style='color:green;'>EXPORTACION REALIZADA CORRECTAMENTE</p>";
        
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