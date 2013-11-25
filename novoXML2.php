<?php

    function refinaArray($arrayAntiga) { //Função para remover valores vazios de uma textarea POST separada por \n e gerar outra
        $novaArray = explode("\n", $arrayAntiga );
        $i = 0;
        foreach($novaArray as $p) {
            if(strlen($p) <= 1)
            {
                unset($novaArray[$i]);//Remove do array cada participante sem nome
            }
            $i++;
        }
        array_values($novaArray);//Reorganiza a array
        return $novaArray;
    }

    $participantesArray = refinaArray($_POST['participantes']);
    $numParticipantes = count($participantesArray);
    $equipeAr = refinaArray($_POST['equipe']);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gerar XML</title>
    </head>
    <body>
        
        <table align="center" border="1px" witdh="800px"><td>
            <h1><p>GERAR XML - Passo 2</p></h1>
            <table align="center" width="400px" border="1px">
                <tr>
                    <td colspan="2">Evento:  <?php echo $_POST['evento']; ?> </td>
                </tr>
                <tr>
                    <td colspan="2">Promovente:  <?php echo $_POST['promovente'] ?> </td>
                </tr>
                <tr>
                    <td colspan="2">Data do Evento:  <?php echo $_POST['dataEvento'] ?> </td>
                </tr>
                <tr>
                    <td rowspan="<?php echo count($equipeAr); ?>">Equipe Executora:</td>
                    <?php 
                        foreach($equipeAr as $e)
                        {
                            echo "<td>".$e."</td></tr><tr>";
                        }
                    ?>
                </tr>
            </table>
        <form method="post" action="GerarXML.php">
            <br>
            <p><h1>Digite os dados dos Participantes:</h1></p>

                <?php
                    $i = 1;
                    foreach($participantesArray as $p)
                    {
                        echo "<table align=\"center\" border=\"1px\">";
                        echo "<tr><td>PARTICIPANTE</td>         <td>".$p."</td></tr>";
                        echo "<tr><td>TEXTO PRINCIPAL</td>      <td><textarea name=\"texto".$i."\" rows=\"20\" cols=\"80\"></textarea></td></tr>";
                        echo "<tr><td>CONTEUDO PROGRAMATICO</td><td><textarea name=\"conteudo".$i."\" rows=\"20\" cols=\"80\"></textarea></td></tr>";
                        echo "</table><br><br>";
                        $i++;
                    }
                ?>


            <input type="hidden" name="numParticipantes" value="<?php echo $numParticipantes; ?>" />
            <input type="hidden" name="participantes" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="equipe" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataEvento" value="<?php echo $_POST['dataEvento']; ?>" />
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="promovente" value="<?php echo $_POST['promovente']; ?>" />      
            <p><input type="submit" value="Próximo" /></p><br>     
        </form></td>
        </table>
    </body>
</html>
