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
        <title>Confirmar Dados - 1</title>
    </head>
    <body>
        <table border="1" align="center" border-color="black">
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
        
//        $participanteAr = explode("\n", $_POST['participantes']);
//        $conteudoAr = explode("\n", $_POST['contprogramatico']);
//        $equipeAr = explode("\n", $_POST['equipe']);
        $participanteAr = refinaArray($_POST['participantes']);
        $dataConteudo = $_POST['contprogramatico'];
        $equipeAr = refinaArray($_POST['equipe']);
        
//        $i = 0;
//        foreach($participanteAr as $p) {
//            if(strlen($p) <= 1 )
//            {
//                unset($participanteAr[$i]);
//            }
//            $i++;
//        }
//        array_values($participanteAr);

        
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
        /* Titulo Conteudo Programatico Retirado
        echo "  <tr>
                <td rowspan=\"".count($conteudoAr)."\"><span class=\"item\">Conteúdo Programático:</span>
                </td>
                <span class=\"dado\">";
        foreach ($conteudoAr as $conteudo) {
            echo "<td>".$conteudo."</td></tr><tr>";
        }
        echo "</tr></span></tr>;
         * 
         */
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
                    <b>Função</b>
                </td>
                <td>
                    <b>N° do livro</b>
                </td>
                <td>
                    <b>N° da folha</b>
                </td>
                <td>
                    <b>N° do registro</b>
                </td>
            </tr>
            <form method=\"post\" >";
        
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
                    <input type="text" name="carga[]" size="4" />
                </td>                
                <td>
                    <input type="text" name="funcao[]" size="12" />
                </td>
                <td>
                    <input type="text" name="num[]" size="2" disabled value="" />
                </td>
                <td>
                    <input type="text" name="fls[]" size="2" disabled value="" />
                </td>
                <td>
                    <input type="text" name="sobnum[]" size="2"  disabled value="" />
                </td>
            </tr>
            <?php
        }
        
        echo "</table><h1>Preencha dados do Conteudo Programatico</h1><br /><br />
            <table border=\"1\" align=\"center\"";

//        $conteudoAr = explode("\n", $_POST['contprogramatico']);//Cria uma array com cada participante
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
//        foreach($conteudoAr as $dataConteudo) {
            ?>
            <tr>
<!--                <td align="center">
                    <span class="item"><?php echo $dataConteudo ?></span>
                </td>-->
                <td>
                    <textarea name="conteudo[]" rows="15" cols="100" wrap="on"></textarea>
                </td>
            </tr>
            <?php
//        }
        ?>
        </table><br /><br />
        
            <input type="hidden" name="evento" value="<?php echo $_POST['evento']; ?>" />
            <input type="hidden" name="promovente" value="<?php echo $_POST['promovente']; ?>" />
            <input type="hidden" name="participantes" value="<?php echo $_POST['participantes']; ?>" />
            <input type="hidden" name="contprogramatico"value="<?php echo $_POST['contprogramatico']; ?>" />
            <input type="hidden" name="equipe" value="<?php echo $_POST['equipe']; ?>" />
            <input type="hidden" name="dataimpressa" value="<?php echo $_POST['dataimpressa']; ?>"/>
            <input type="hidden" name="texto" value="<?php echo $_POST['texto']; ?>" />
            <input type="submit" value="Próximo" action="confirma2.php"  />       
        </form>
        
        
    </body>
</html>