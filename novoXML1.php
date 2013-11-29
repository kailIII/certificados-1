<?php

    session_start();

    mb_internal_encoding('UTF-8');
/*

 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($_POST['evento']))
    {
        $evento = "value=\"".$_POST['evento']."\"";
    }
    else
    {
        $evento = "";
    }

    if(isset($_POST['promovente']))
    {
        $promovente = "value=\"".$_POST['promovente']."\"";
    }
    else
    {
        $promovente = "";
    }

    if(isset($_POST['dataEvento']))
    {
        $dataEvento = "value=\"".$_POST['dataEvento']."\"";
    }
    else
    {
        $dataEvento = "";
    }

    if(isset($_POST['participantes']))
    {
        $participantes = $_POST['participantes'];
    }
    else
    {
        $participantes = "";
    }

    if(isset($_POST['equipe']))
    {
        $equipe = $_POST['equipe'];
    }
    else
    {
        $equipe = "";
    }



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
        <form method="post" action="NovoXML1confirmacao.php">
            <p>Digite os dados para gerar o XML:</p>
            <p>Evento:<input type="text" name="evento" <?php echo $evento; ?>/></p>
            <p>Promovente:<input type="text" name="promovente" <?php echo $promovente; ?>/></p>
            <p>Data do Evento:<input type="text" name="dataEvento" <?php echo $dataEvento; ?>/></p>
            <p>Participantes:<textarea name="participantes" rows="20" cols="80"><?php echo $participantes; ?></textarea></p> 
            <p>Equipe Executora:<textarea name="equipe" rows="20" cols="80"><?php echo $equipe; ?></textarea></p>
            <p><input type="submit" value="Próximo" /></p><br>     
        </form></td>
        </table>
    </body>
</html>
