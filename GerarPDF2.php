<?php

    session_start();

    require('fpdf/WriteTag.php');

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
    function paginaFrente($pdf,$participante, $textoPrincipal, $tamanhoTexto) {
            //Pagina da Frente
            $pdf->AddPage();
            $pdf->SetLeftMargin(110);   //Margem esquerda do texto principal - á 110mm da borda esquerda
            $pdf->SetRightMargin(20);   //Margem direita do texto principal - á 20mm da borda direita
            $pdf->SetFont('Arial','',$tamanhoTexto);         
            $pdf->SetXY(110,70); //Posicao inicial do texto do certificado -- posicao x = 110mm / posicao y = 70mm/   
            
            $textoPrincipal = utf8_decode("<p>".$textoPrincipal)."</p>";//Decodifica todo o texto para utf-8 para resolver alguns erros de 
                                                      //caracteres, e adiciona tags de paragrafo no inicio e fim do texto        
            $pdf->WriteTag(167, 9, $textoPrincipal);//Escreve o texto principal no pdf
    }
            

    function paginaTras($pdf,$conteudo,$equipe,$tamanhoEquipe,$tamanhoConteudo/*,$num,$fls,$sobnum*/) {
            //Pagina de Tras
            
            $pdf->AddPage();//Adiciona pagina de trás do certificado
            $pdf->SetXY(15,30);//Posiciona para escrever no conteudo programatico
            
            //Escreve o conteudos programaticos
            $pdf->SetFont('arial','',$tamanhoConteudo);//Seleciona fonte normal arial para o conteudo programatico
            $pdf->MultiCell(110,5,utf8_decode($conteudo),0,'L');//Escreve o conteudo programatico
            
            $pdf->SetXY(154,30);//Posiciona para escrever a Equipe Executora
            
            //Escreve os integrantes da Equipe Executora
            $pdf->SetFont('arial','',$tamanhoEquipe);
            $pdf->MultiCell(110,6,utf8_decode($equipe),0,'L');//Escreve o nome do integrante da equipe executora, em negrito - texto centralizado
            
            //Escreve o bloco de assinatura [DESATIVADO]
            
//            $pdf->SetXY(182, 140);//Posição para bloco de assinatura
//            $pdf->SetFont('arial','B','13'); //Seta fonte para o bloco - arial em negrito tamanho 13
//            $textoBlocoAssinatura = utf8_decode("UFMT - PROCEV - CODEX"."\n"."Certificado Registrado no livro"."\n\n"."nº.".$numAr[$n-1]."     fls.".$flsAr[$n-1].
//                    "\n\n\n"."sob nº. ".$sobnumAr[$n-1]."\n\n____________________\nResponsável p/ Registro\n");
//            $pdf->MultiCell(70, 5, $textoBlocoAssinatura, 1, 'C');//Imprime bloco de assinatura
    }    
    
    

    function GeradorPDF($pdf,$participante, $textoPrincipal, $conteudo, $equipe, $tamanhoTexto, $tamanhoConteudo, $tamanhoEquipe
        ,$ordemImpressao, $i/*,$num,$fls,$sobnum  */
     )
    {  

        //Verifica se os tamanhos das fontes passados por parâmetro são numéricos, caso contrário se dá o valor padrão 14
        if(!is_numeric($tamanhoConteudo)) {
           $tamanhoConteudo = '14'; 
        }
        
        if(!is_numeric($tamanhoEquipe)) {
            $tamanhoEquipe = '14';
        }
        
        if(!is_numeric($tamanhoTexto)) {
            $tamanhoTexto = '14';
        }
                
        /*
        $pdf = new PDF_WriteTag('L','mm'); //Inicializa o PDF
        $pdf->SetAutoPageBreak(0);
      
        //Cria os styles normal, negrito e negrito-italico
        $pdf->SetStyle("p","arial","N",13,"0,0,0",60);
        $pdf->SetStyle("b","arial","B",13,"0,0,0");
        $pdf->SetStyle("bi","arial","BI",13,"0,0,0");
        
        */

        if($ordemImpressao == '1') {
            paginaFrente($pdf,$participante, $textoPrincipal, $tamanhoTexto);
            paginaTras($pdf,$conteudo,$equipe,$tamanhoEquipe,$tamanhoConteudo/*,$num,$fls,$sobnum*/);
        }
        else
        {
            paginaTras($pdf,$conteudo,$equipe,$tamanhoEquipe,$tamanhoConteudo/*,$num,$fls,$sobnum*/);
            paginaFrente($pdf,$participante, $textoPrincipal, $tamanhoTexto);                
        }

        $pdf->Output("Certificado".$i.".pdf", "F");//Gera a pagina PDF
    }   

    $zipname = './CertificadosPDF.zip';
    $zip = new ZipArchive();
    $zip->open($zipname, ZipArchive::CREATE);

    $participantesArray = refinaArray($_POST['participantes']);
    $i = 1;

    foreach($participantesArray as $p)
        {
        $pdf = new PDF_WriteTag('L','mm'); //Inicializa o PDF
        $pdf->SetAutoPageBreak(0);
      
        //Cria os styles normal, negrito e negrito-italico
        $pdf->SetStyle("p","arial","N",13,"0,0,0",60);
        $pdf->SetStyle("b","arial","B",13,"0,0,0");
        $pdf->SetStyle("bi","arial","BI",13,"0,0,0"); 
        GeradorPDF($pdf,$p,trim($_POST['texto'.$i]),trim($_POST['conteudo'.$i]),trim($_POST['equipe']),'14','14','14','1',$i);
        $zip->addFile("Certificado".$i.".pdf");
        $i++;
    }

    $zip->close();

    //GERAR DOWNLOAD
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename="certificados.zip"');
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);

?>
