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
        require_once '../config/confDBmysqli.php';
        
        $controlador = new mysqli_driver(); // creo un objeto de la clase mysqli_driver
        $controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT; // Establece reporte de errore mysqli y que salte excepcion
    
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
                    
                    try { //Bloque de código que puede tener excepciones en el objeto mysqli
                        $miDB = new mysqli(); //Instanciamos un objeto mysqli
                        $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos

                        $consulta = $miDB->stmt_init(); // Inicializa una sentencia y devuelve un objeto para usarlo con mysqli_stmt::prepare()
                        $sql = "SELECT CodDepartamento FROM Departamento WHERE CodDepartamento = ?";
                        $consulta->prepare($sql); // prepara la consulta
                        $consulta->bind_param('s', $_REQUEST['CodDepartamento']); // da valor al parametro de la consulta
                        $consulta->execute(); // ejecuta la consulta 
                        $consulta->store_result(); // almacena el resultado de la consulta
                        if($consulta->num_rows>0){
                            $aErrores['CodDepartamento']= "El código de Departamento introducido ya existe"; // meto un mensaje de error en el array de errores del codigo del departamento
                        }
                        $consulta->close(); // Cierra la consulta preparada
                        
                    }catch (mysqli_sql_exception $miExceptionMysqli) { // Codigo que se ejecuta si hay alguna excepcion
                       echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                       echo "<p style='color:red;'>Código de error: ".$miExceptionMysqli->getCode()."</p>"; // Muestra el codigo del error
                       exit("<p style='color:red;'>Error: ".$miExceptionMysqli->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
                    }finally{ // codigo que se ejecuta haya o no errores
                        $miDB->close(); // Cierra la conexion con la base de datos
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
                $aRespuestas['CodDepartamento'] = $_REQUEST['CodDepartamento']; // strtoupper() transforma los caracteres de un string a mayuscula
                $aRespuestas['DescDepartamento'] = $_REQUEST['DescDepartamento']; 
                $aRespuestas['VolumenNegocio'] = $_REQUEST['VolumenNegocio'];
                
                
                
                // TRATAMIENTO
                echo "<h2>Datos introducidos</h2>";
                echo "<p>CodDepartamento: ".$aRespuestas['CodDepartamento']."</p>";
                echo "<p>DescDepartamento: ".$aRespuestas['DescDepartamento']."</p>";
                echo "<p>Volumen de Negocio: ".$aRespuestas['VolumenNegocio']."</p>";
                
                
                // Inserccion del departamento
                
                try { // Bloque de código que puede tener excepciones en el objeto PDO
                    
                    
                    
                    
                    $miDB = new mysqli(); //Instanciamos un objeto mysqli
                    $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos

                    $consulta = $miDB->stmt_init(); // Inicializa una sentencia y devuelve un objeto para usarlo con mysqli_stmt::prepare()
                    $sql2 = "INSERT INTO Departamento (CodDepartamento,DescDepartamento,VolumenNegocio) VALUES (?,?,?)";
                    $consulta->prepare($sql2); // prepara la consulta
                    $consulta->bind_param('ssd', $_REQUEST['CodDepartamento'],$_REQUEST['DescDepartamento'],$_REQUEST['VolumenNegocio']); //Agrega variables a una sentencia preparada como parámetros
                    $consulta->execute(); // ejecuta la consulta 
               
                    
                    echo "<p style='color:green;'>DEPARTAMENTO INSERTADO CORRECTAMENTE</p>";
                    $consulta->close(); // Cierra la consulta preparada
                }catch (mysqli_sql_exception $miExceptionMysqli) { // Codigo que se ejecuta si hay alguna excepcion
                    echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                    echo "<p style='color:red;'>Código de error: ".$miExceptionMysqli->getCode()."</p>"; // Muestra el codigo del error
                    exit("<p style='color:red;'>Error: ".$miExceptionMysqli->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
                }finally{ // codigo que se ejecuta haya o no errores
                    $miDB->close(); // Cierra la conexion con la base de datos
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



