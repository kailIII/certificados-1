<html>
    <head>   
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Confirmar Dados - 1</title>
    </head>
    <body>
        <table border="1" align="center" border-color="black">
        <?php 
        $participanteAr = explode("\n", $_POST['participantes']);
        $conteudoAr = explode("\n", $_POST['contprogramatico']);
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
        
        echo "</table><h1>Preencha dados de período e carga horária de participantes</h1><br /><br />
            <table border=\"1\" align=\"center\" border-color=\"black\">
            <tr>
                <td>
                    <b>Participante</b>
                </td>
                <td>
                    <b>Periodo</b>
                </td>
                <td>
                    <b>Carga Horaria</b>
                </td>
                <td>
                    <b>N°</b>
                </td>
                <td>
                    <b>fls.</b>
                </td>
            </tr>
            <form method=\"post\" action=\"confirma2.php\" >";
        
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
        
        foreach($participanteAr as $participante) {
            ?>
            <tr>
                <td>
                    <span class="item"><?php echo $participante ?></span>
                </td>
                <td>
                    <input type="text" name="periodo[]" />
                </td>
                <td>
                    <input type="text" name="carga[]" />
                </td>
                <td>
                    <input type="text" name="num[]" />
                </td>
                <td>
                    <input type="text" name="fls[]" />
                </td>
            </tr>
            <?php
        }
        echo "</table><h1>Preencha dados da Equipe Executora</h1><br /><br />
            <table border=\"1\" align=\"center\" border-color=\"black\">
            <tr>
                <td>
                    <b>Integrante</b>
                </td>
                <td>
                    <b>Função</b>
                </td>
            </tr>";
        $integranteAr = explode("\n", $_POST['equipe']);//Cria uma array com cada participante
        $i = 0;
        foreach($integranteAr as $in) {
            if(strlen($in) <= 1)
            {
                unset($integranteAr[$i]);//Remove do array cada participante sem nome
            }
            $i++;
        }
        $integranteAr = array_values($integranteAr);//Reorganiza a array
        
        foreach($integranteAr as $integrante) {
            ?>
            <tr>
                <td>
                    <span class="item"><?php echo $integrante ?></span>
                </td>
                <td>
                    <input type="text" name="funcao[]" />
                </td>
            </tr>
            <?php
        }
        
        echo "</table><h1>Preencha dados do Conteudo Programatico</h1><br /><br />
            <table border=\"1\" align=\"center\" border-color=\"black\">
            <tr>
                <td>
                    <b>Data</b>
                </td>
                <td>
                    <b>Evento</b>
                </td>
            </tr>";
        $conteudoAr = explode("\n", $_POST['contprogramatico']);//Cria uma array com cada participante
        $i = 0;
        foreach($conteudoAr as $c) {
            if(strlen($c) <= 1)
            {
                unset($conteudoAr[$i]);//Remove do array cada participante sem nome
            }
            $i++;
        }
        $conteudoAr = array_values($conteudoAr);//Reorganiza a array
        
        foreach($conteudoAr as $dataConteudo) {
            ?>
            <tr>
                <td>
                    <span class="item"><?php echo $dataConteudo ?></span>
                </td>
                <td>
                    <textarea name="conteudo[]" rows="6" cols="50" wrap="off"></textarea>
                </td>
            </tr>
            <?php
        }
        ?>
        </table><br /><br />
        
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="departamento" value="<?php echo $_POST['departamento']; ?>" />
            <input type="hidden" name="participantes" rows="20" cols="80" wrap="off" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="contprogramatico" rows="20" cols="80" wrap="off" value="<?php echo $_POST['contprogramatico']; ?>" />
            <input type="hidden" name="equipe" rows="20" cols="80" wrap="off" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataimpressa" value="<?php echo $_POST['dataimpressa']; ?>"/>
            <input type="hidden" name="texto" value="<?php echo $_POST['texto']; ?>" />
            <input type="submit" value="Próximo" />       
        </form>
        
        
    </body>
</html>