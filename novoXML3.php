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
            <h1><p>GERAR XML - Final</p></h1>
            <br><br>

        <form id="form1" method="post">
            <br>
            <p><h1>Selecione a opção desejada:</h1></p>

                <?php
                    for($i=1;$i<=$numParticipantes;$i++)
                    {
                        echo "<input type=\"hidden\" name=\"texto".$i."\" value=\"".$_POST['texto'.$i]."\">";
                        echo "<input type=\"hidden\" name=\"conteudo".$i."\" value=\"".$_POST['conteudo'.$i]."\">";
                    }
                ?>
            <input type="hidden" name="numParticipantes" value="<?php echo $numParticipantes; ?>" />
            <input type="hidden" name="participantes" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="equipe" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataEvento" value="<?php echo $_POST['dataEvento']; ?>" />
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="promovente" value="<?php echo $_POST['promovente']; ?>" />      
            <p><input type="button" onclick="submitForm('GerarXML.php')" value="Gerar pacote XML" />
                <input type="button" onclick="submitForm('GerarPDF2.php')" value="Gerar PDF para impressão" />
                </form>
            <form method="post" action="novoXML1.php">
                <input type="submit" value="Gerar novos Certificados" />
            </form>
            </p><br>     
        
        </table>
    </body>
</html>
