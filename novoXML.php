<?php

    session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gerar XML</title>
    </head>
    <body>
        
        <table align="center" border="1px"><td>
                <h1><p>GERAR ARQUIVO</p></h1>
        <form method="post" action="GerarXML.php">
            <p>Digite os dados para gerar o XML:</p>
            <p>Evento:<input type="text" name="evento" /></p>
            <p>Participante:<input type="participante" name="participante" /></p> 
            <p>Texto:<textarea name="texto" rows="20" cols="80"></textarea></p>
            <p>Conteudo Programatico:<textarea name="conteudo" rows="20" cols="80"></textarea></p>
            <p>Equipe Executora:<textarea name="equipe" rows="20" cols="80"></textarea></p>
            <p><input type="submit" value="Gerar" /></p><br>     
        </form></td>
        </table>
    </body>
</html>
