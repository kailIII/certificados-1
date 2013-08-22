<!DOCTYPE html>
<?php

    session_start();
    
    if($_SESSION["Login"] != "YES") {
        header("Location: index.php");
    }
    
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
?>
<html>
    <head>   
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Confirmar Dados - 2</title>
    </head>
    <body>
        <table border="1" align="center" border-color="black">
        <?php 
//        $participanteAr = explode("\n", $_POST['participantes']);
//        $i = 0;
//        foreach($participanteAr as $p) {
//            if(strlen($p) <= 1)
//            {
//                unset($participanteAr[$i]);
//            }
//        }
//        $participanteAr = array_values($participanteAr);
        $participanteAr = refinaArray($_POST['participantes']);
        
        $conteudo = $_POST['contprogramatico'];
        
        $eventoAr = $_POST['conteudo'];
        
//        $i = 0;
//        foreach($conteudoAr as $c) {
//            if(strlen($c) <= 1)
//            {
//                unset($conteudoAr[$i]);//Remove do array cada participante sem nome
//            }
//            $i++;
//        }
//        $conteudoAr = array_values($conteudoAr);//Reorganiza a array
//        
        $equipeAr = refinaArray($_POST['equipe']);

        
        echo "<h1>Confirme os dados já preenchidos</h1><br /><br />
              <tr>
                <td>
                    <span class=\"item\">Evento:</span>
                </td>
                <td>
                    <span class=\"dado\">".$_POST['evento']."</span>
                </td>
              </tr>
              <tr>
                <td>
                    <span class=\"item\">Promovente:</span>
                </td>
                <td>
                    <span class=\"dado\">".$_POST['promovente']."</span>
                </td>
              </tr>"/*
              <tr>
                <td>
                    <span class=\"item\">Período Realizado:</span>
                </td>
                <td>
                    <span class=\"dado\">".$_POST['periodo']."</span>
                </td>
              </tr>*/
              ."<tr>
                <td rowspan=\"".count($participanteAr)."\"><span class=\"item\">Participantes:</span></td>
                <span classe=\"dado\">";
        foreach ($participanteAr as $participante) {
            echo "<td>".$participante."</td></tr><tr>";            
        }
        echo "</tr></span></tr>";
        
//        echo "      <tr>
//                <td rowspan=\"".count($conteudoAr)."\"><span class=\"item\">Conteúdo Programático:</span>
//                </td>
//                <span class=\"dado\">";
//        foreach ($conteudoAr as $conteudo) {
//            echo "<td>".$conteudo."</td></tr><tr>";
//        }
//        echo "</tr></span></tr>";
        
        echo "  <tr>
                <td rowspan=\"".count($equipeAr)."\"><span class=\"item\">Equipe Executora:</span>
                </td>
                <span class=\"dado\">";
        foreach ($equipeAr as $equipe) {
            echo "<td>".$equipe."</td></tr><tr>";            
        }
        echo "</tr></span></tr>"/*.
              <tr>
                <td>
                    <span class=\"item\">Carga Horaria:
                </td></span>
                <td>
                    <span class=\"dado\">".$_POST['carga']." horas</span>
                </td>
              </tr>
         * 
         */."<tr>
                <td>
                    <span class=\"item\">Data Impressa:
                </td></span>
                <td>
                    <span class=\"dado\">".$_POST['dataimpressa']."</span>
                </td>
              </tr>
              <tr>
                <td>
                    <span class=\"item\">Texto Principal:
                </td></span>
                <td>
                    <span class=\"dado\">".$_POST['texto']."</span>
                </td>
              </tr>";
        
        echo "</table><h1>Selecione os eventos que cada participante compareceu</h1><br /><br />
            <table border=\"1\" align=\"center\" border-color=\"black\">
            <tr>
                <td>
                    <b>Participante</b>
                </td>
                <td>
                    <b>Evento</b>
                </td>
            </tr>
            <form method=\"post\" action=\"GerarPDF.php\" >";
        
        
        $part = 1;
        foreach($participanteAr as $participante) {
           echo "<tr>
                    <td rowspan=\"".count($conteudo)."
                        <span class=\"item\">".$participante."</span>
                    </td>";
           $icont = 0;
//           foreach($conteudo as $conteudoData) {
               
//           echo "    <td>
//                           <input type=checkbox name=\"dataCont".$part."[]\" value=\"".$icont."\" >".$conteudoData."
//                     </td>";
           
           echo "
                     <td>
                           <textarea name=\"conteudo".$part."[]\" rows=\"15\" cols=\"70\" wrap=\"on\">".$eventoAr[$icont]."</textarea>"."
                     </td>
                 </tr>";
           $icont++;
           $part++;
           }
        echo "</tr>";

//        }
        ?>
        </table><br /><br />
            <?php
            
        echo "<br>
                <p>Tamanho da Fonte para Conteudo Programatico: <input type=\"text\" name=\"sizeconteudo\" />(tamanho padrão = 14)</p>
                <p>Tamanho da Fonte para Equipe Executora: <input type=\"text\" name=\"sizeequipe\" />(tamanho padrão = 14)</p>
                <br>
                <p>Selecione ordem de impressão:</p>
                <p><input type=\"radio\" name=\"ordem\" value=\"1\" checked > Normal(Frente e Verso)</p>
                <p><input type=\"radio\" name=\"ordem\" value=\"2\"> Invertida(Verso e Frente)</p>
        ";
            
//                foreach($_POST['num'] as $num) {
//                    echo "<input type=\"hidden\" name=\"num[]\" value=\"".$num."\" />";
//                }
//                foreach($_POST['fls'] as $fls) {
//                    echo "<input type=\"hidden\" name=\"fls[]\" value=\"".$fls."\" />";
//                }                
                foreach($_POST['funcao'] as $funcao) {
                    echo "<input type=\"hidden\" name=\"funcao[]\" value=\"".$funcao."\" />";
                }
//                foreach($_POST['sobnum'] as $sobnum) {
//                    echo "<input type=\"hidden\" name=\"sobnum[]\" value=\"".$sobnum."\" />";
//                }
                foreach($_POST['periodo'] as $periodo) {
                    echo "<input type=\"hidden\" name=\"periodo[]\"  value=\"".$periodo."\" />";
                }
                foreach($_POST['carga'] as $carga) {
                    echo "<input type=\"hidden\" name=\"carga[]\"  value=\"".$carga."\" />";
                }
            ?>
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="promovente" value="<?php echo $_POST['promovente']; ?>" />
            <input type="hidden" name="participantes" rows="20" cols="80" wrap="off" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="contprogramatico" rows="20" cols="80" wrap="off" value="<?php echo $_POST['contprogramatico']; ?>" />
            <input type="hidden" name="equipe" rows="20" cols="80" wrap="off" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataimpressa" value="<?php echo $_POST['dataimpressa']; ?>"/>
            <input type="hidden" name="texto" value="<?php echo $_POST['texto']; ?>" />
            <input type="submit" value="Gerar PDF" />       
        </form>
        
        
    </body>
</html>