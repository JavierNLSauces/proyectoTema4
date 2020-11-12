<?php
    header('Content-Type:text/xml');
    header("Content-Disposition: attachment;filename=".date('Ymd')."exportacionXMLLocal.xml");
    readfile("../tmp/".date('Ymd')."exportacionXMLLocal.xml"); // mostrar desde el fichero del servidor en el navegador el documento xml si este no se descarga
?>

