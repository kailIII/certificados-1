<?php

    /*VARIAVEIS
        $_POST['num'] - Array do campo num de participante - ordenado de acordo com o participante - de 0 a n
        $_POST['fls'] - Array do campo fls de participante - ordenado de acordo com o participante - de 0 a n 
        $_POST['periodo'] - Array do campo periodo de participante - ordenado de acordo com o participante - de 0 a n
        $_POST['carga'] - Array do campo carga de participante - ordenado de acordo com o participante - de 0 a n
        $_POST['funcao'] - Array do campo função de Integrante da equipe executora - ordenado de acordo com o integrante - de 0 a n
        $_POST['evento'] - Variavel contendo o nome do evento
        $_POST['departamento'] - Variavel contendo o nome do departamento
        $_POST['participantes'] - Variavel contendo os nomes dos participantes , um por linha
        $_POST['contprogramatico'] - Variavel contendo as datas do Conteudo Programatico, um por linha
        $_POST['equipe'] - Variavel contendo os nomes dos integrantes da equipe executora, um por linha
        $_POST['dataimpressa'] - Variavel contendo a data de impressão do certificado
        $_POST['texto'] - Variavel contendo o Texto Principal
     * 
     *  $_POST['dataCont(?)'] - Array contendo valores de checkboxes - ? é o participante - de 1 a n - contendo as datas do conteudo
     *  $_POST['conteudo(?)'] - Array textarea contendo os conteudos programaticos do participante
    */
    session_start();

    function convertem($term, $tp) { //Função para converter strings com acentos para MAIUSCULA - $tp = 1 para maiuscula / $tp = 0 para minuscula
        if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
        elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 
    return $palavra; 
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
    
//    function organizaConteudoProgramatico($n) { //Função que organiza conteudos programaticos escolhidos, em forma de array - $n é numero do participante - de 1 a n
//        $cont = 0;
//        $posicaoArray = 0;
//        foreach($_POST['dataCont'.$n] as $dataConteudo) {
//            if
//            $cont++;
//        }
//    }
    
    if($_SESSION["Login"] != "YES") {
        header("Location: index.php");
    }
    else
    {
        require('fpdf/WriteTag.php');
     
        $numAr = $_POST['num'];
        $flsAr = $_POST['fls'];
        $periodoAr = $_POST['periodo'];
        $cargaAr = $_POST['carga'];
        $funcaoAr = $_POST['funcao'];
  
        $participanteAr = refinaArray($_POST['participantes']);
//        $participanteAr = explode("\n", $_POST['participantes']);//Cria uma array com cada participante
//        $i = 0;
//        foreach($participanteAr as $p) {
//            if(strlen($p) <= 1)
//            {
//                unset($participanteAr[$i]);//Remove do array cada participante sem nome
//            }
//            $i++;
//        }
//        array_values($participanteAr);//Reorganiza a array
        
        $ContProgAr = refinaArray($_POST['contprogramatico']);
//        $ContProgAr = explode("\n", $_POST['contprogramatico']);//Cria uma array com cada participante
//        $i = 0;
//        foreach($ContProgAr as $p) {
//            if(strlen($p) <= 1)
//            {
//                unset($ContProgAr[$i]);//Remove do array cada participante sem nome
//            }
//            $i++;
//        }
//        array_values($ContProgAr);//Reorganiza a array
//        
  
        $equipeAr = refinaArray($_POST['equipe']);
//        $equipeAr = explode("\n", $_POST['equipe']);//Cria uma array com cada participante
//        $i = 0;
//        foreach($equipeAr as $e) {
//            if(strlen($e) <= 1)
//            {
//                unset($equipeAr[$i]);//Remove do array cada participante sem nome
//            }
//            $i++;
//        }
//        array_values($equipeAr);//Reorganiza a array
        
        $textoPrincipal = $_POST['texto'];
        $textoPrincipal = str_replace( array( "{evento}", "{departamento}", ), 
                     array( "<b>".$_POST['evento']."</b>", $_POST['departamento'] ),
                     $textoPrincipal );
                
        $pdf = new PDF_WriteTag('L','mm');

        $pdf->SetStyle("p","arial","N",13,"0,0,0",60);
        $pdf->SetStyle("b","arial","B",13,"0,0,0");
        $pdf->SetStyle("bi","arial","BI",13,"0,0,0");
        $n = 1;
        
        foreach ($participanteAr as $participante) {
            $pdf->AddPage();
            $pdf->SetLeftMargin(110);
            $pdf->SetRightMargin(20);
            $pdf->SetFont('Arial','',14);
            $pdf->SetXY(0,0);
            $pdf->SetFillColor(200,220,255);
            $pdf->Rect(0,0,90,210,'F'); //Borda esquerda com simbolos da PROCEV - REMOVER DEPOIS
            $pdf->SetFillColor(195,195,195);
            $pdf->Rect(90,0,207,50,'F'); //Texto superior - REMOVER DEPOIS
            $pdf->SetFillColor(195,195,195);
            $pdf->Rect(90,160,207,50,'F'); //Texto inferior - REMOVER DEPOIS
            $pdf->SetXY(110,70); //Posicao inicial do texto do certificado -- posicao x = 110mm / posicao y = 70mm/   
            //         
//          $texto = utf8_decode("<p>Certificamos que <bi>".$participante."</bi> participou do evento <bi>".$_POST['evento']."</bi> realizado pelo ".
//                    $_POST['departamento']." no periodo ".$_POST['periodo']." com carga horaria total de ".$_POST['carga']." horas.</p>");
            $texto = str_replace( array( "{nome}", "{periodo}", "{carga}" ), 
                         array( "<b>".$participante."</b>", $periodoAr[$n-1], $cargaAr[$n-1] ),
                $textoPrincipal );
            $texto = utf8_decode("<p>".$texto)."</p>";        
            $pdf->WriteTag(167, 9, $texto);
            //$pdf->MultiCell(167,9,$texto,0,'J',false); //Adiciona o texto no corpo principal do certificado
            //$pdf->WriteHTML($texto);
            $pdf->SetXY(110,$pdf->GetY()+10);
            $data = utf8_decode("Cuiabá-MT, ".$_POST['dataimpressa'].".");
            $pdf->Cell(167, 5, $data ,0,1,'R',false); //Adiciona a data da impressão no corpo do certificado
            $pdf->AddPage();
            $pdf->SetXY(15,30);
            //if(isset($_POST['dataCont'.$n])) { //Se tiver algum conteudo programatico marcado
                foreach($_POST['dataCont'.$n] as $key => $valor) {
                    $pdf->SetFont('arial','BIU','14');
                    $pdf->MultiCell(110,8,utf8_decode($ContProgAr[$valor]),0,'L');
                    $pdf->SetX(20);
                    $pdf->SetFont('arial','','14');
                    $pdf->MultiCell(110,8,utf8_decode($_POST['conteudo'.$n][$valor]),5,'L');
                    $pdf->SetXY(15,$pdf->GetY()+10);
                }
            //}
            
//            $dataContAr = count($_POST['dataCont'.$n]);
//            $dataContAr--;
//            for($c = 0 ; $c <= $dataContAr ; ++$c) {
//                if(isset($_POST['dataCont'.$n][$c])) {
//                    $pdf->SetFont('arial','BI','14');
//                    $pdf->MultiCell(110,6,utf8_decode($_POST['dataCont'.$n][$c]),0,'L');
//                    $pdf->SetX(15);
//                    $pdf->SetFont('arial','','14');
//                    $pdf->MultiCell(110,6,utf8_decode($_POST['conteudo'.$n][$c]),5,'L');
//                    $pdf->SetXY(15,$pdf->GetY()+10);
//                }
//                $c++;
//            }
            
            //$pdf->MultiCell(110,5,$_POST['contprogramatico'],0,'C',false);
            $pdf->SetXY(154,30);
            $numIntegrante = 0;
            foreach($equipeAr as $integrante) {
                $pdf->SetFont('arial','B','15');
                $pdf->MultiCell(110,6,utf8_decode($integrante),0,'C');
                $pdf->SetX(154);
                $pdf->SetFont('arial','','14');
                $pdf->MultiCell(110,6,utf8_decode($funcaoAr[$numIntegrante]),0,'C');
                $pdf->SetXY(154,$pdf->GetY()+10);
                $numIntegrante++;
            }
                
            //$pdf->MultiCell(128,5,$_POST['equipe'],0,'C',false);
        $n++;
        }
        $pdf->Output("PaginaPDF", "I");
    }   
?>
