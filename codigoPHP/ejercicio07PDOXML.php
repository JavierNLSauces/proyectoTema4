<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 07 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   07. Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el directorio .../tmp/ del servidor
        */ 
        require_once '../config/confDBPDO.php';
        
        
        
        try { // Bloque de código que puede tener excepciones en el objeto PDO
            $miDB = new PDO(DNS,USER,PASSWORD); // crea un objeto PDO con la conexion a la base de datos

            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establece el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
            
            
            $documentoXML = new DOMDocument("1.0", "utf-8"); // crea un objeto de tipo DOMDocument que recibe 2 parametros: la version y la codificacion del XML que queremos crear
            $documentoXML->load("../tmp/". date('Ymd') ."exportacionXML.xml");
            
            $sql = 'INSERT INTO Departamento VALUES (:CodDepartamento, :DescDepartamento,:FechaBaja,:VolumenNegocio)';
            
            $resultadoConsulta = $miDB->prepare($sql); // prepara la consulta
            
            $nDepartamentos = $documentoXML->getElementsByTagName('Departamento')->length; // saca el numero de elementos Departamento que hay en el documento
            
        for ($nDepartamento=0;$nDepartamento<$nDepartamentos;$nDepartamento++){ // recorro los elementos Departamento
            
            $departamento = $documentoXML->getElementsByTagName('Departamento')->item($nDepartamento)->childNodes; // recorro los hijos del elemento Departamento
            
            // guarda los valores impares hasta 7, debido a que en las posiciones pares se almacena un espacio en blanco y en los impares el valor
            $parametros = [ ":CodDepartamento"=>$departamento->item(1)->nodeValue, 
                            ":DescDepartamento"=>$departamento->item(3)->nodeValue,
                            ":FechaBaja"=>$departamento->item(5)->nodeValue,
                            ":VolumenNegocio"=>$departamento->item(7)->nodeValue
                          ];
            
            if(empty($parametros[':FechaBaja'])){ // si la fecha de baja esta vacia
                $parametros[':FechaBaja']=null; // establece el parametro fecha de baja a null
            }
            
            $resultadoConsulta->execute($parametros); // ejecuta la consulta
            
        }    
            echo "<p style='color:green;'>IMPORTACION REALIZADA CORRECTAMENTE</p>";

        }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
            echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
            echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
            die(); // Finaliza el script
        }finally{ // codigo que se ejecuta haya o no errores
            unset($miDB);// Destruye la variable 
        }
        
        ?>
            
    </body>
</html>