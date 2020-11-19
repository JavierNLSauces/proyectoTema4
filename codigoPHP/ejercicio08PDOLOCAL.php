<?php

/**
 *   @author: Javier Nieto Lorenzo
 *   @since: 04/11/2020
 *   08. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se encuentra en el directorio .../tmp/ del servidor.

 */
require_once '../config/confDBPDO.php';
try { // Bloque de código que puede tener excepciones en el objeto PDO
    $miDB = new PDO(DNS, USER, PASSWORD); // creo un objeto PDO con la conexion a la base de datos
    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion
    $sql = "SELECT * FROM Departamento";
    $resultadoconsulta = $miDB->prepare($sql); // prepara la consulta
    $resultadoconsulta->execute(); // ejecuta la consulta
    $documentoXML = new DOMDocument("1.0", "utf-8"); // creo el objeto de tipo DOMDocument que recibe 2 parametros: ela version y la codificacion del XML que queremos crear
    $documentoXML->formatOutput = true; // establece la salida formateada
    $root = $documentoXML->appendChild($documentoXML->createElement('Departamentos')); // creo el nodo raiz
    $oDepartamento = $resultadoconsulta->fetchObject(); // Obtengo el primer registro de la consulta como un objeto
    while ($oDepartamento) { // recorro los registros que devuelve la consulta y por cada uno de ellos ejecuto el codigo siguiente
        $departamento = $root->appendChild($documentoXML->createElement('Departamento')); // creo el nodo para el departamento
        $departamento->appendChild($documentoXML->createElement('CodDepartamento', $oDepartamento->CodDepartamento)); // añado como hijo el codigo de departamento con su valor
        $departamento->appendChild($documentoXML->createElement('DescDepartamento', $oDepartamento->DescDepartamento)); // añado como hijo la descripcion del departamento con su valor
        $departamento->appendChild($documentoXML->createElement('FechaBaja', $oDepartamento->FechaBaja)); // añado como hijo la fecha de baja del departamento con su valor
        $departamento->appendChild($documentoXML->createElement('VolumenNegocio', $oDepartamento->VolumenNegocio)); // añado como hijo el volumen de negocio del departamento con su valor
        $oDepartamento = $resultadoconsulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
    }
    $fechaActual = date('Ymd');
    $documentoXML->save("../tmp/" . $fechaActual . "exportacionXMLLocal.xml"); // guarda el arbol XML en la ruta especificada con la fecha del dia que se ejecuta
    header('Content-Type:text/xml');
    header("Content-Disposition: attachment;filename=" . date('Ymd') . "exportacionXMLLocal.xml");
    readfile("../tmp/" . date('Ymd') . "exportacionXMLLocal.xml"); // mostrar desde el fichero del servidor en el navegador el documento xml si este no se descarga
} catch (PDOException $miExceptionPDO) { // Codigo que se ejecuta si hay alguna excepcion
    echo "<p style='color:red;'>Código de error: " . $miExceptionPDO->getCode() . "</p>"; // Muestra el codigo del error
    echo "<p style='color:red;'>Error: " . $miExceptionPDO->getMessage() . "</p>"; // Muestra el mensaje de error
    die(); // Finalizo el script
} finally { // codigo que se ejecuta haya o no errores
    unset($miDB); // destruyo la variable
}
?>
