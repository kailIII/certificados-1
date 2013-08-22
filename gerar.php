<!DOCTYPE html>
<?php

    session_start();
    
    if($_SESSION["Login"] != "YES") {
        header("Location: index.php");
    }

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            Geração de Certificados
        </title>
        <style type="text/css" >
            h1 {font-size : 30px ; font-family: arial;}
        </style>
    </head>
    <body>

        <h1>Gerar Certificados</h1>
        <hr />
        <form method="post" action="confirma.php" >
            <table padding="20px" border-color="white,white,white,white">
                <tr>
            <p>
                <td align="right"><label for="evento" >Evento:</label></td>
                <td align="left"><input type="text" name="evento" size="50" /></td>
            </p>
                </tr>
                <tr>
            <p> 
                <td align="right"><label  for="promovente">Promovente:</label></td>
                <td><input type="text" name="promovente" size="50" /></td>
            </p>
            </tr>
                <tr>
            <p>
                <td align="right"><label for="textoPrincipal">Texto Principal: </label>
                    <br><br><b>TAGS:</b>  <br>{evento}<br>{nome}<br>{período}<br>{carga}<br>{função}<br>{promovente}
                </td>
                <td><textarea name="texto" rows="20" cols="80"></textarea></td>
            </p>
                </tr>
                <tr>
            <p>
                <td align="right"><label for="nomes">Participantes: </label></td>
                <td><textarea name="participantes" rows="20" cols="80" wrap="off"></textarea></td>
            </p>
            </tr>
                <input type="hidden" name="contprogramatico" value="Conteudo" />
                <tr>
            <p>
                <td align="right"><label for="nomesequipe">Equipe Executora[Nomes]: </label></td>
                <td><textarea name="equipe" rows="20" cols="80" wrap="off"></textarea></td>
            </p>
            </tr>
            <tr>
            <p>
                <td align="right"><label for="lbldata">Data: Cuiabá-MT,</label></td>
                <td><input type="text" name="dataimpressa">.</td>
            </p>
                </table>        
                    <br><br>
                    <p align="center"><input type="submit" value="Próximo"/></p>

        </form>
    </body>
</html>

