<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 03 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 04/11/2020
         *   03.- Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.

        */ 
        
        require_once '../core/201020libreriaValidacion.php'; // incluyo la libreria de validacion para validar los campos de formulario
        require_once '../config/confDBPDO.php';
            
            define("OBLIGATORIO",1);// defino e inicializo la constante a 1 para los campos que son obligatorios
            define('MYSQL_FLOAT_MAX',3.402823466E+38); // defino e inicializo la constante de el maximo float que acepta MySQL
            
            $entradaOK=true; // declaro la variable que determina si esta bien la entrada de los campos introducidos por el usuario
            
            $aErrores=[ //declaro e inicializo el array de errores
                'CodDepartamento' => null,
                'DescDepartamento' => null,
                'VolumenNegocio' => null
            ];
            
            $aRespuestas=[ // declaro e inicializo el array de las respuestas del usuario
                'CodDepartamento' => null,
                'DescDepartamento' => null,
                'VolumenNegocio' => null
            ];
            
            
           
            if(isset($_REQUEST["Enviar"])){ // compruebo que el usuario le ha dado a al boton de enviar y valido la entrada de todos los campos
                $aErrores['CodDepartamento']= validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepartamento'], 3, 3, OBLIGATORIO); // compruebo que la entrada del codigo de departamento es correcta
                if($aErrores['CodDepartamento']==null){
                    if(!ctype_upper($_REQUEST['CodDepartamento'])){ // si introduce el codigo del departamento en minuscula
                        $aErrores['CodDepartamento']= "El código de Departamento debe introducirse en mayusculas"; // genera un mensaje de error para que lo meta en mayusculas
                    }
                }
                if($aErrores['CodDepartamento']==null){ // si no ha habido ningun error de validacion del campo del codigo del departamento
                    try { // Bloque de código que puede tener excepciones en el objeto PDO
                        $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                        
                        $sql = "SELECT CodDepartamento FROM Departamento WHERE CodDepartamento=:codDepartamento";
                        $consulta = $miDB->prepare($sql); // prepara la consulta
                        $parametros = [':codDepartamento'=> $_REQUEST['CodDepartamento']];
                        $consulta->execute($parametros); // ejecuta la consulta 
                        if($consulta->rowCount()>0){
                            $aErrores['CodDepartamento']= "El código de Departamento introducido ya existe"; // meto un mensaje de error en el array de errores del codigo del departamento
                        }
                        
                    }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                        echo "<p style='color:red;'>ERROR</p>";
                        echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
                        echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
                        die();
                    }finally{
                        unset($miDB); // destruyo la variable de la conexion a la base de datos
                    }
                }
                    
                $aErrores['DescDepartamento']= validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO); // compruebo que la entrada de la descripcion del departamento es correcta
                $aErrores['VolumenNegocio']= validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], 3.402823466E+38, 0, OBLIGATORIO); // compruebo que la entrada del volumen de negocio del departamento es correcta
                if($aErrores['VolumenNegocio']==null){ // si no ha habido ningun error anterior
                    strpos($_REQUEST['VolumenNegocio'],",")? $aErrores['VolumenNegocio']="Debe introducir un numero decimal con '.'": null;// si introduce un decimal con "," se genera un mensaje de error
                }
                
                foreach ($aErrores as $campo => $error) { // recorro el array de errores
                    if($error != null){ // compruebo si hay algun mensaje de error en algun campo
                        $entradaOK=false; // le doy el valor false a $entradaOK
                        $_REQUEST[$campo]=""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
                    }
                }
            }else{ // si el usuario no le ha dado al boton de enviar
                $entradaOK=false; // le doy el valor false a $entradaOK
            }
            
            if($entradaOK){ // si la entrada esta bien recojo los valores introducidos y hago su tratamiento
                $aRespuestas['CodDepartamento'] = strtoupper($_REQUEST['CodDepartamento']); // strtoupper() transforma los caracteres de un string a mayuscula
                $aRespuestas['DescDepartamento'] = $_REQUEST['DescDepartamento']; 
                $aRespuestas['VolumenNegocio'] = $_REQUEST['VolumenNegocio'];
                
                
                
                // TRATAMIENTO
                echo "<h2>Datos introducidos</h2>";
                echo "<p>CodDepartamento: ".$aRespuestas['CodDepartamento']."</p>";
                echo "<p>DescDepartamento: ".$aRespuestas['DescDepartamento']."</p>";
                echo "<p>Volumen de Negocio: ".$aRespuestas['VolumenNegocio']."</p>";
                
                
                // Inserccion del departamento
                
                try { // Bloque de código que puede tener excepciones en el objeto PDO
                    $miDB = new PDO(DNS,USER,PASSWORD); // creo un objeto PDO con la conexion a la base de datos

                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
                    
                    /* Sin consulta preparada
                    $sqlInserccion="INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES ('{$aRespuestas['CodDepartamento']}', '{$aRespuestas['DescDepartamento']}',{$aRespuestas['VolumenNegocio']})";
                    
                    $numRegistros = $miDB->exec($sqlInserccion);
                    
                    $sql='SELECT * FROM Departamento';
                    $consulta2 = $miDB->query($sql);
                    */
                    
                    $sql2 = "INSERT INTO Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) VALUES (:CodDepartamento, :DescDepartamento,:VolumenNegocio)";
                    
                    $consulta2=$miDB->prepare($sql2); // preparo la consulta
                    
                    $parametros = [ ":CodDepartamento" => $aRespuestas['CodDepartamento'], // asigno los valores del formulario en el array de parametros
                                    ":DescDepartamento" => $aRespuestas['DescDepartamento'],
                                    ":VolumenNegocio" => $aRespuestas['VolumenNegocio'] ];
                    
                    $consulta2->execute($parametros); // ejecuto la consulta pasando los parametros del array de parametros
                    
                }catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
                    echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                    echo "<p style='color:red;'>Código de error: ".$miExceptionPDO->getCode()."</p>"; // Muestra el codigo del error
                    echo "<p style='color:red;'>Error: ".$miExceptionPDO->getMessage()."</p>"; // Muestra el mensaje de error
                    die(); // Finalizo el script
                }finally{ // codigo que se ejecuta haya o no errores
                    unset($miDB);// destruyo la variable 
                }
            }else{ // si hay algun campo de la entrada que este mal muestro el formulario hasta que introduzca bien los campos
        ?> 
        
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <fieldset>
                <legend>Añadir Departamento</legend>
                <div>
                    <label for="CodDepartamento">Codigo de Departamento</label>
                    <input style="background-color:#81BEF7;width:32px;" type="text" id="CodDepartamento" name="CodDepartamento" placeholder="AAA" value="<?php 
                        echo (isset($_REQUEST['CodDepartamento'])) ? $_REQUEST['CodDepartamento'] : null; // si el campo esta correcto mantengo su valor en el formulario
                    ?>">
                    <?php
                        echo ($aErrores['CodDepartamento']!=null) ? "<span style='color:#FF0000'>".$aErrores['CodDepartamento']."</span>" : "<span style='color:#81BEF7'>Nombre del departamento FORMATO: Tres letras mayusculas</span>";// si el campo es erroneo se muestra un mensaje de error
                    ?>
                </div>
                <div>
                    <label for="DescDepartamento">Descripcion del Departamento</label>
                    <input style="background-color:#81BEF7;width:248px;" type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Introduzca Descripcion" value="<?php 
                        echo (isset($_REQUEST['DescDepartamento'])) ? $_REQUEST['DescDepartamento'] : null; // si el campo esta correcto mantengo su valor en el formulario
                    ?>">
                    <?php
                        echo ($aErrores['DescDepartamento']!=null) ? "<span style='color:#FF0000'>".$aErrores['DescDepartamento']."</span>" : "<span style='color:#81BEF7'>Descripcion del departamento</span>";// si el campo es erroneo se muestra un mensaje de error
                    ?>
                </div>                
                <div>
                    <label for="VolumenNegocio">Volumen Negocio</label>
                    <input style="background-color:#81BEF7;width:50px;" type="text" id="VolumenNegocio" name="VolumenNegocio" placeholder="Decimal" value="<?php
                        echo (isset($_REQUEST['VolumenNegocio']))? $_REQUEST['VolumenNegocio'] : null; // si el campo esta correcto mantengo su valor en el formulario
                    ?>">
                    <?php
                        echo($aErrores['VolumenNegocio']!=null) ? "<span style='color:#FF0000'>".$aErrores['VolumenNegocio']."</span>" : "<span style='color:#81BEF7'>Volumen de Negocio del Departamento</span>"; // si el campo es erroneo se muestra un mensaje de error
                    ?>
                </div>
            </fieldset>

            <input type="submit" value="Enviar" name="Enviar">
        </form>
        
        <?php
            }
        ?>
    </body>
</html>



