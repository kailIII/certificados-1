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
        
        <!-- Direcionar pagina para determinado botão clicado-->
        <script>
            function submitForm(action)
            {
                document.getElementById('form1').action = action;
                document.getElementById('form1').submit();
            }
        </script>   

        <table align="center" border="1px" witdh="800px"><td>
            <h1><p>GERAR XML - Passo 2 - Confirmação</p></h1>
            <table align="center" width="400px" border="1px">
                <tr>
                    <td colspan="2"><b>Evento:</b>  <?php echo $_POST['evento']; ?> </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Promovente:</b>  <?php echo $_POST['promovente'] ?> </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Data do Evento:</b>  <?php echo $_POST['dataEvento'] ?> </td>
                </tr>
                <tr>
                    <td rowspan="<?php echo $numParticipantes; ?>"><b>Participantes:</b></td>
                    <?php 
                        foreach($participantesArray as $p)
                        {
                            echo "<td>".trim($p)."</td></tr><tr>";
                        }
                    ?>
                </tr>
                <tr>
                    <td><b>Equipe Executora:</b></td>
                    <td><?php echo str_replace("\n","<br>",$_POST['equipe']); ?></td>
                </tr>
            </table>
        <form id="form1" method="post">
            <br>
            <p><h1>Confirme os dados dos Participantes para gerar os Certificados:</h1></p>

                <?php
                    $i = 1;
                    foreach($participantesArray as $p)
                    {
                        echo "<table align=\"center\" border=\"1px\">";
                        echo "<tr><td>PARTICIPANTE</td><td>".$p."</td></tr>";
                        echo "<tr><td>TEXTO PRINCIPAL</td><td>".$_POST['texto'.$i]."</td></tr>";
                        echo "<tr><td>CONTEUDO PROGRAMATICO</td><td>".$_POST['conteudo'.$i]."</td></tr>";
                        echo "</table><br><br>";
                        echo "<input type=\"hidden\" name=\"texto".$i."\" value=\"".$_POST['texto'.$i]."\">";
                        echo "<input type=\"hidden\" name=\"conteudo".$i."\" value=\"".$_POST['conteudo'.$i]."\">";
                        $i++;
                    }
                ?>
            <input type="hidden" name="numParticipantes" value="<?php echo $numParticipantes; ?>" />
            <input type="hidden" name="participantes" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="equipe" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataEvento" value="<?php echo $_POST['dataEvento']; ?>" />
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="promovente" value="<?php echo $_POST['promovente']; ?>" />      
            <p> <input type="button" onclick="submitForm('novoXML2.php')" value="Retornar" />
                <input type="button" onclick="submitForm('NovoXML3.php')" value="Finalizar" /><br>     
        </form></td>
        </table>
    </body>
</html>
