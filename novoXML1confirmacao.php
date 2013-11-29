<?php

    session_start();

    mb_internal_encoding('UTF-8');

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
                <h1><p>GERAR XML - Passo 1 - Confirmação</p></h1>
        <form id="form1" method="post">
            <p align="center">Confirme os dados inseridos para prosseguir<br>[não poderão ser alterados caso prossiga]</p>
            <table border="1px">
                <tr>
                    <td><b>Evento:</b></td>
                    <td><?php echo $_POST['evento']; ?></td>
                </tr>
                <tr>
                    <td><b>Promovente:</b></td>
                    <td><?php echo $_POST['promovente']; ?></td>
                </tr>
                <tr>
                    <td><b>Data do Evento:</b></td>
                    <td><?php echo $_POST['dataEvento']; ?></td>
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
            <input type="hidden" name="participantes" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="equipe" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataEvento" value="<?php echo $_POST['dataEvento']; ?>" />
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="promovente" value="<?php echo $_POST['promovente']; ?>" />   
            <p> <input type="button" onclick="submitForm('novoXML1.php')" value="Retornar" />
                <input type="button" onclick="submitForm('novoXML2.php')" value="Prosseguir" /></p><br>     
        </form></td>
        </table>
    </body>
</html>
