<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 04 - Javier Nieto Lorenzo</title>
    </head>
    <body>
        <h1>Javier Nieto Lorenzo</h1>
        
        
        
        
        <?php
        /**
         *   @author: Javier Nieto Lorenzo
         *   @since: 15/11/2020
         *   04.- Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).

        */ 
        
        require_once '../core/201020libreriaValidacion.php'; // incluyo la libreria de validacion para validar los campos de formulario
        require_once '../config/confDBmysqli.php';
        
        $controlador = new mysqli_driver(); // creo un objeto de la clase mysqli_driver
        $controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT; // Establece reporte de errore mysqli y que salte excepcion
        
        define("OPCIONAL",0);// defino e inicializo la constante a 0 para los campos que son opcionales

        $entradaOK=true; // declaro la variable que determina si esta bien la entrada de los campos introducidos por el usuario

        $errorDescDepartamento = null;

        $descDepartamento = null;
        ?>
        
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <fieldset>
                <legend>Buscar Departamento</legend>
                <div>
                    <label for="DescDepartamento">Descripcion del Departamento</label>
                    <input style="width:248px;" type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Introduzca Descripcion del Departamento" value="<?php 
                        echo (isset($_REQUEST['DescDepartamento'])) ? $_REQUEST['DescDepartamento'] : null; // si el campo esta correcto mantengo su valor en el formulario
                    ?>">
                    <?php
                        echo ($errorDescDepartamento!=null) ? "<span style='color:#FF0000'>".$errorDescDepartamento."</span>" : null;// si el campo es erroneo se muestra un mensaje de error
                    ?>
                </div>
            </fieldset>

            <input type="submit" value="Buscar Departamento" name="Buscar">
        </form>
        
        <?php
            
           
            if(isset($_REQUEST["Buscar"])){ // compruebo que el usuario le ha dado a al boton de enviar y valido la entrada de todos los campos
                $errorDescDepartamento= validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 0, OPCIONAL);
                
                if($errorDescDepartamento != null){ // compruebo si hay algun mensaje de error en algun campo
                    $entradaOK=false; // le doy el valor false a $entradaOK
                    $_REQUEST[$campo]=""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
                }

            }else{ // si el usuario no le ha dado al boton de enviar
                $entradaOK=false; // le doy el valor false a $entradaOK
            }
            
            if($entradaOK){ // si la entrada esta bien recojo los valores introducidos y hago su tratamiento
                $descDepartamento=$_REQUEST['DescDepartamento']; 
                
                
                
                // TRATAMIENTO
                echo "<h2>Datos introducidos</h2>";
                echo "<p>DescDepartamento: ".$descDepartamento."</p>";
                
                
                
                echo "<h2>Contenido tabla Departamentos</h2>";
                try { // Bloque de código que puede tener excepciones en el objeto PDO
                    $miDB = new mysqli(); //Instanciamos un objeto mysqli
                    $miDB->connect(HOST,USER,PASSWORD,DATABASE); // Abre una conexion con la base de datos

                    $consulta = $miDB->stmt_init(); // Inicializa una sentencia y devuelve un objeto para usarlo con mysqli_stmt::prepare()
                    $sql = "SELECT * FROM Departamento WHERE DescDepartamento LIKE CONCAT('%',?,'%')";
                    $consulta->prepare($sql); // prepara la consulta
                    $consulta->bind_param('s', $descDepartamento); // da valor al parametro de la consulta
                    $consulta->execute(); // ejecuta la consulta 
                    $consulta->store_result(); // almacena el resultado de la consulta
                    $consulta->bind_result($codigoDepartamento,$descripcionDepartamento,$fechaBaja,$volumenNegocio); // Vincula columnas del conjunto de resultados a variables.
                    
                    
                    if($consulta->num_rows>0){ // si la consulta devuelve algun registro
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
                <td><?php echo $codigoDepartamento; // obtengo el valor del codigo del departamento?></td>
                <td><?php echo $descripcionDepartamento; // obtengo el valor de la descripcion del departamento?></td>
                <td><?php echo $fechaBaja; // obtengo el valor de la fecha de baja del departamento?></td>
                <td><?php echo $volumenNegocio; // obtengo el valor de la fecha de baja del departamento?></td>
            </tr>
            <?php 
                    }
            ?>
        </table>   
        
        <?php
                }else{// si la consulta no devuelve ningun registro
                    echo "<p>No hay ningun Departamento con esa descripcion</p>";
                }
                
                echo "<p style='color:green;'>BUSQUEDA REALIZADA CON EXITO</p>";
                $consulta->close(); // Cierra la consulta preparada
                }catch (mysqli_sql_exception $miExceptionMysqli) { // Codigo que se ejecuta si hay alguna excepcion
                    echo "<p style='color:red;'>ERROR EN LA CONEXION</p>";
                    echo "<p style='color:red;'>Código de error: ".$miExceptionMysqli->getCode()."</p>"; // Muestra el codigo del error
                    exit("<p style='color:red;'>Error: ".$miExceptionMysqli->getMessage()."</p>"); //Imprime un mensaje con el error y termina el script actual
                }finally{ // codigo que se ejecuta haya o no errores
                    $miDB->close(); // Cierra la conexion con la base de datos
                }
            }
        ?>
    </body>
</html>



