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
        
        <table align="center" border="1px" witdh="800px"><td>
                <h1><p>GERAR XML - Passo 1</p></h1>
        <form method="post" action="NovoXML2.php">
            <p>Digite os dados para gerar o XML:</p>
            <p>Evento:<input type="text" name="evento" /></p>
            <p>Promovente:<input type="text" name="promovente" /></p>
            <p>Data do Evento:<input type="text" name="dataEvento" /></p>
            <p>Participantes:<textarea name="participantes" rows="20" cols="80"></textarea></p> 
            <!--    <p>Texto:<textarea name="texto" rows="20" cols="80"></textarea></p>                     -->
            <!--    <p>Conteudo Programatico:<textarea name="conteudo" rows="20" cols="80"></textarea></p>  -->
            <p>Equipe Executora:<textarea name="equipe" rows="20" cols="80"></textarea></p>
            <p><input type="submit" value="Próximo" /></p><br>     
        </form></td>
        </table>
    </body>
</html>
