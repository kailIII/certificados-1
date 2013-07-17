<html>
    <head>   
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Confirmar Dados - 2</title>
    </head>
    <body>
        <table border="1" align="center" border-color="black">
        <?php 
        $participanteAr = explode("\n", $_POST['participantes']);
        $i = 0;
        foreach($participanteAr as $p) {
            if(strlen($p) <= 1)
            {
                unset($participanteAr[$i]);
            }
        }
        array_values($participanteAr);
        
        $conteudoAr = explode("\n", $_POST['contprogramatico']);
        $i = 0;
        foreach($conteudoAr as $c) {
            if(strlen($c) <= 1)
            {
                unset($conteudoAr[$i]);//Remove do array cada participante sem nome
            }
            $i++;
        }
        $conteudoAr = array_values($conteudoAr);//Reorganiza a array
        
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
        $equipeAr = explode("\n", $_POST['equipe']);
        $i = 0;
        foreach($participanteAr as $p) {
            if(strlen($p) <= 1 )
            {
                unset($participanteAr[$i]);
            }
            $i++;
        }
        array_values($participanteAr);

        
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
                    <span class=\"item\">Departamento:</span>
                </td>
                <td>
                    <span class=\"dado\">".$_POST['departamento']."</span>
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
        echo "</tr></span></tr>
              <tr>
                <td rowspan=\"".count($conteudoAr)."\"><span class=\"item\">Conteúdo Programático:</span>
                </td>
                <span class=\"dado\">";
        foreach ($conteudoAr as $conteudo) {
            echo "<td>".$conteudo."</td></tr><tr>";
        }
        echo "</tr></span></tr>
              <tr>
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
                    <b>Data</b>
                </td>
                <td>
                    <b>Evento</b>
                </td>
            </tr>
            <form method=\"post\" action=\"GerarPDF.php\" >";
        
        $participanteAr = explode("\n", $_POST['participantes']);//Cria uma array com cada participante
        $i = 0;
        foreach($participanteAr as $p) {
            if(strlen($p) <= 1)
            {
                unset($participanteAr[$i]);//Remove do array cada participante sem nome
            }
            $i++;
        }
        $participanteAr = array_values($participanteAr);//Reorganiza a array
        
        $part = 1;
        foreach($participanteAr as $participante) {
           echo "<tr>
                    <td rowspan=\"".count($conteudoAr)."
                        <span class=\"item\">".$participante."</span>
                    </td>";
           $icont = 0;
           foreach($conteudoAr as $conteudoData) {
           echo "    <td>
                           <input type=checkbox name=\"dataCont".$part."[]\" value=\"".$conteudoData."\"/>".$conteudoData."
                     </td>
                     <td>
                           <textarea name=\"conteudo".$part."[]\" rows=\"6\" cold=\"50\" wrap=\"off\">".$eventoAr[$icont]."</textarea>"."
                     </td>
                 </tr>
                 <tr>";
           $icont++;
           }
        echo "</tr>";
        $part++;
        }
        ?>
        </table><br /><br />
            <?php
                foreach($_POST['num'] as $num) {
                    echo "<input type=\"hidden\" name=\"num[]\" value=\"".$num."\" />";
                }
                foreach($_POST['fls'] as $fls) {
                    echo "<input type=\"hidden\" name=\"fls[]\" value=\"".$fls."\" />";
                }
                foreach($_POST['periodo'] as $periodo) {
                    echo "<input type=\"hidden\" name=\"periodo[]\"  value=\"".$periodo."\" />";
                }
                foreach($_POST['carga'] as $carga) {
                    echo "<input type=\"hidden\" name=\"carga[]\"  value=\"".$carga."\" />";
                }
                foreach($_POST['funcao'] as $funcao) {
                    echo "<input type=\"hidden\" name=\"funcao[]\"  value=\"".$funcao."\" />";
                }
            ?>
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="departamento" value="<?php echo $_POST['departamento']; ?>" />
            <input type="hidden" name="participantes" rows="20" cols="80" wrap="off" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="contprogramatico" rows="20" cols="80" wrap="off" value="<?php echo $_POST['contprogramatico']; ?>" />
            <input type="hidden" name="equipe" rows="20" cols="80" wrap="off" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataimpressa" value="<?php echo $_POST['dataimpressa']; ?>"/>
            <input type="hidden" name="texto" value="<?php echo $_POST['texto']; ?>" />
            <input type="submit" value="Gerar PDF" />       
        </form>
        
        
    </body>
</html>