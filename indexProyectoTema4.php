<!DOCTYPE html>
<!--
    Autor.- Javier Nieto 
    Fecha de modificacion.- 2020/10/27
-->
<html>
    <head>
        <title>Tema 4 DWES - Javier Nieto Lorenzo</title> 
        <meta charset="UTF-8">
        <meta name="viewport"   content="width=device-width, initial-scale=1.0">
        <meta name="author"     content="Javier Nieto Lorenzo">
        <meta name="robots"     content="index, follow">      
        <link rel="stylesheet"  href="webroot/css/estilos.css"       type="text/css" >
        <link rel="icon"        href="webroot/media/favicon.ico"    type="image/x-icon">
    </head>
    <body>
        <header>
            <h1>TEMA 4 DWES </h1>
        </header>
    <nav>
        <ul>
            <li>
                <a href="../index.html">HOME</a>
            </li>
            <li>
                <a href="#">DAW</a>
            </li>
            <li>
                <a href="#">DIW</a>
            </li>
            <li>
                <a href="#">DWEC</a>
            </li>
            <li class="active">
                <a href="../proyectoDWES/indexProyectoDWES.php">DWES</a>  
            </li>
        </ul>
    </nav>
    <main>
        <table class="content">
            <tr>
                <th>Scripts</th>
                <th></th>
                <th>Mostrar</th>
            </tr>
            <tr>
                <td>Scripts DAW217DBDepartamentos</td>
                <td></td>
                <td><a href="mostrarcodigo/muestraEjercicio00PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                
            </tr> 
            <tr>
                <td>Archivos de configuracion PDO y mysqli</td>
                <td></td>
                <td><a href="mostrarcodigo/muestraConfigPDOmysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <th>Enunciado</th>
                <th colspan="2">PDO</th>
                <th colspan="2">mysqli</th>
            </tr>
            <tr>
                <th></th>
                <th>Ejecutar</th>
                <th>Mostrar</th>
                <th>Ejecutar</th>
                <th>Mostrar</th>
            </tr>
            <tr>
                <td>01. (ProyectoTema4) Conexión a la base de datos con la cuenta usuario y tratamiento de errores.</td>
                <td><a href="codigoPHP/ejercicio01PDO.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio01PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio01mysqli.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio01mysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <td>02. Mostrar el contenido de la tabla Departamento y el número de registros.</td>
                <td><a href="codigoPHP/ejercicio02PDO.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio02PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio02mysqli.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio02mysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <td>03. Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.</td>
                <td><a href="codigoPHP/ejercicio03PDO.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio03PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio03mysqli.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio03mysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <td>04. Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).</td>
                <td><a href="codigoPHP/ejercicio04PDO.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio04PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio04mysqli.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio04mysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <td>05. Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.</td>
                <td><a href="codigoPHP/ejercicio05PDO.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio05PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio05mysqli.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio05mysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <td>06. Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada.  Probar consultas preparadas sin bind, pasando los parámetros en un array a execute.</td>
                <td><a href="codigoPHP/ejercicio06PDO.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio06PDO.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio06mysqli.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio06mysqli.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            
            <tr>
                <th></th>
                <th colspan="2">XML</th>
                <th colspan="2">JSON</th>
                <th colspan="2">CSV</th>
                <th colspan="2">LOCAL</th>
            </tr>
            <tr>
                <th></th>
                <th>Ejecutar</th>
                <th>Mostrar</th>
                <th>Ejecutar</th>
                <th>Mostrar</th>
                <th>Ejecutar</th>
                <th>Mostrar</th>
                <th>Ejecutar</th>
                <th>Mostrar</th>
            </tr>
            <tr>
                <td>07. Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el directorio .../tmp/ del servidor</td>
                <td><a href="codigoPHP/ejercicio07PDOXML.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio07PDOXML.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio07PDOJSON.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio07PDOJSON.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio07PDOCSV.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio07PDOCSV.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio07PDOLOCAL.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio07PDOLOCAL.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr> 
            <tr>
                <td>08. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se encuentra en el directorio .../tmp/ del servidor.</td>
                <td><a href="codigoPHP/ejercicio08PDOXML.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio08PDOXML.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio08PDOJSON.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio08PDOJSON.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio08PDOCSV.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio08PDOCSV.php"><img src="webroot/media/code_image.png"/></a></td>
                <td><a href="codigoPHP/ejercicio08PDOLOCAL.php"><img src="webroot/media/play_image.png"/></a></td>
                <td><a href="mostrarcodigo/muestraEjercicio08PDOLOCAL.php"><img src="webroot/media/code_image.png"/></a></td>
            </tr>
            
        </table>
        
        
    </main>
    <footer>
        <a href="http://daw217.ieslossauces.es/" target="_blank"> <img src="webroot/media/oneandone.png" alt="oneandone icon" width="40"></a>
        <address>  <a href="../../index.html">&copy; 2020-2021 Javier Nieto Lorenzo</a> </address>
        <a href="https://github.com/JavierNLSauces/" target="_blank"><img class="github" width="40" src="webroot/media/github.png" ></a>
    </footer>
</html>