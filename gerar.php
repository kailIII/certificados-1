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
            Geracao de Certificados
        </title>
        <style type="text/css" >
            h1 {font-size : 30px ; font-family: arial;}
        </style>
    </head>
    <body style="padding:30px;border:1px solid blue;">

        <h1>Gerar Certificados</h1>
        <hr />
        <form method="post" action="confirma.php" >
            <p>
                <label for="evento" >Evento:</label>
                <input type="text" name="evento" size="50" />
            </p>
            <p> 
                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" size="50" />
            </p>
            <p>
                <label for="textoPrincipal">Texto Principal: </label>
                <textarea name="texto" rows="20" cols="80">{nome} {evento} {departamento} {periodo} {carga}</textarea>
            </p>
            <p>
                <label for="nomes">Participantes: </label>
                <textarea name="participantes" rows="20" cols="80" wrap="off"></textarea>
            </p>
<!--            <p>
                <label for="conteudo">Conteúdo Programático[Datas]: </label>
                <textarea name="contprogramatico" rows="20" cols="80" wrap="off"></textarea>
            </p>-->
                <input type="hidden" name="contprogramatico" value="Conteudo" />
            <p>
                <label for="nomesequipe">Equipe Executora[Nomes]: </label>
                <textarea name="equipe" rows="20" cols="80" wrap="off"></textarea>
            </p>
            <p>
                <label for="lbldata">Data: Cuiabá-MT,</label>
                <input type="text" name="dataimpressa">/.
            </p>
            <input type="submit" value="Próximo" />       
        </form>
    </body>
</html>

