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

        $entradaOK = true; // declaro la variable que determina si esta bien la entrada de los campos introducidos por el usuario 
        if (isset($_REQUEST['Enviar'])) { // comprueba si se ha pulsado el boton de enviar
            if ($_FILES['archivo'] != null) { // si la entrada esta bien recojo los valores introducidos y hago su tratamiento
                if ($_FILES['archivo']['type'] == 'text/xml') { // si el rchivo es de tipo XML
                    try { // Bloque de código que puede tener excepciones en el objeto PDO
                        $miDB = new PDO(DNS, USER, PASSWORD); // creo un objeto PDO con la conexion a la base de datos
                        $file_name = $_FILES['archivo']['tmp_name'];
                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                        if (move_uploaded_file($file_name, "../tmp/" . date('Ymd') . "importacionLocalXML.xml")) {
                            $documentoXML = new DOMDocument("1.0", "utf-8"); // creo el objeto de tipo DOMDocument que recibe 2 parametros: la version y la codificacion del XML que queremos crear
                            $documentoXML->load("../tmp/" . date('Ymd') . "importacionLocalXML.xml"); // carga el xml del archivo 

                            $sql = 'INSERT INTO Departamento VALUES (:CodDepartamento, :DescDepartamento,:FechaBaja,:VolumenNegocio)';

                            $resultadoConsulta = $miDB->prepare($sql); // prepara la consulta

                            $nDepartamentos = $documentoXML->getElementsByTagName('Departamento')->length; // saco cuantos departamentos hay

                            for ($nDepartamento = 0; $nDepartamento < $nDepartamentos; $nDepartamento++) { //recorro los departamentos

                                $departamento = $documentoXML->getElementsByTagName('Departamento')->item($nDepartamento)->childNodes;

                                // guarda los valores impares hasta 7, debido a que en los valores pares se almacena un espacio en blanco y en los impares el valor del nodo
                                $parametros = [":CodDepartamento" => $departamento->item(1)->nodeValue,
                                    ":DescDepartamento" => $departamento->item(3)->nodeValue,
                                    ":FechaBaja" => $departamento->item(5)->nodeValue,
                                    ":VolumenNegocio" => $departamento->item(7)->nodeValue
                                ];

                                if (empty($parametros[':FechaBaja'])) { // si la fecha de baja esta vacia
                                    $parametros[':FechaBaja'] = null; // establece el parametro fecha de baja a null
                                }

                                $resultadoConsulta->execute($parametros); // ejecuta la consulta
                            }

                            echo "<p style='color:green;'>IMPORTACION REALIZADA CORRECTAMENTE</p>";
                        }
                    } catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                        echo "<p style='color:red;'>Código de error: " . $miExceptionPDO->getCode() . "</p>"; // Muestra el codigo del error
                        echo "<p style='color:red;'>Error: " . $miExceptionPDO->getMessage() . "</p>"; // Muestra el mensaje de error
                        die(); // Finalizo el script
                    } finally { // codigo que se ejecuta haya o no errores
                        unset($miDB); // destruyo la variable 
                    }
                }
            }
        } else { // si hay algun campo de la entrada que este mal muestro el formulario hasta que introduzca bien los campos
            ?> 

            <form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <label for="archivo">Seleccione el archivo XML que desea importar</label>
                <input id="archivo" name="archivo" type="file">
                <input type="submit" value="Enviar" name="Enviar">
            </form>

            <?php
        }
        ?>

    </body>
</html>