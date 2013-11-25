<?php

    /*VARIAVEIS
        $_POST['num'] - Array do campo num de participante - ordenado de acordo com o participante - de 0 a n {Numero do Livro}
        $_POST['fls'] - Array do campo fls de participante - ordenado de acordo com o participante - de 0 a n {Numero da folha}
        $_POST['sobnum'] - Array do campo sobnum de participante - ordenado de acordo com o participante - de 0 a n {Numero do Registro}
        $_POST['periodo'] - Array do campo periodo de participante - ordenado de acordo com o participante - de 0 a n
        $_POST['carga'] - Array do campo carga de participante - ordenado de acordo com o participante - de 0 a n
        $_POST['funcao'] - Array do campo funcao de participante - ordenado de acordo com o participante - de 0 a n
        $_POST['evento'] - Variavel contendo o nome do evento
        $_POST['promovente'] - Variavel contendo o nome do promovente
        $_POST['participantes'] - Variavel contendo os nomes dos participantes , um por linha
        $_POST['contprogramatico'] - Variavel contendo as datas do Conteudo Programatico, um por linha
        $_POST['equipe'] - Variavel contendo os nomes dos integrantes da equipe executora, um por linha
        $_POST['dataimpressa'] - Variavel contendo a data de impressão do certificad
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
    function paginaFrente($pdf,$participante, $textoPrincipal, $dataEvento) {
            //Pagina da Frente
            $pdf->AddPage();
            $pdf->SetLeftMargin(110);   //Margem esquerda do texto principal - á 110mm da borda esquerda
            $pdf->SetRightMargin(20);   //Margem direita do texto principal - á 20mm da borda direita
            $pdf->SetFont('Arial','',14);         
            $pdf->SetXY(110,70); //Posicao inicial do texto do certificado -- posicao x = 110mm / posicao y = 70mm/   
            
            $texto = utf8_decode("<p>".$textoPrincipal)."</p>";//Decodifica todo o texto para utf-8 para resolver alguns erros de 
                                                      //caracteres, e adiciona tags de paragrafo no inicio e fim do texto        
            $pdf->WriteTag(167, 9, $texto);//Escreve o texto principal no pdf
            $pdf->SetXY(110,$pdf->GetY()+10);//Posiciona duas 1cm abaixo para escrever a data do certificado
            $data = utf8_decode("Cuiabá-MT, ".$dataEvento.".");//Data da impressão
            $pdf->Cell(167, 5, $data ,0,1,'R',false); //Adiciona a data da impressão no corpo do certificado
    }
            

    function paginaTras($pdf,$sizeconteudo,$conteudo,$equipe,$sizeequipe,$sobnumAr,$numAr,$flsAr) {
            //Pagina de Tras
            
            $pdf->AddPage();//Adiciona pagina de trás do certificado
            $pdf->SetXY(15,30);//Posiciona para escrever no conteudo programatico
            
            //Escreve o conteudos programaticos
            $pdf->SetFont('arial','',$sizeconteudo);//Seleciona fonte normal arial para o conteudo programatico
            $pdf->MultiCell(110,5,utf8_decode($conteudo),0,'L');//Escreve o conteudo programatico
            
            $pdf->SetXY(154,30);//Posiciona para escrever a Equipe Executora
            
            //Escreve os integrantes da Equipe Executora
            $pdf->SetFont('arial','',$sizeequipe);
            $pdf->MultiCell(110,6,utf8_decode($equipe),0,'L');//Escreve o nome do integrante da equipe executora, em negrito - texto centralizado
            $pdf->SetX(154);

            
            //Escreve o bloco de assinatura [DESATIVADO]
            
//            $pdf->SetXY(182, 140);//Posição para bloco de assinatura
//            $pdf->SetFont('arial','B','13'); //Seta fonte para o bloco - arial em negrito tamanho 13
//            $textoBlocoAssinatura = utf8_decode("UFMT - PROCEV - CODEX"."\n"."Certificado Registrado no livro"."\n\n"."nº.".$numAr[$n-1]."     fls.".$flsAr[$n-1].
//                    "\n\n\n"."sob nº. ".$sobnumAr[$n-1]."\n\n____________________\nResponsável p/ Registro\n");
//            $pdf->MultiCell(70, 5, $textoBlocoAssinatura, 1, 'C');//Imprime bloco de assinatura
    }    
    
//    }
      if(false)
      {

      }

//    if($_SESSION["Login"] != "YES") {
//        header("Location: index.php");
//    }
    else
    {
        require('fpdf/WriteTag.php');
     
        $xml = new DOMDocument();
        $xml->load('XML/certificado2.xml');

        /*

        if(is_numeric($_POST['sizeconteudo'])) {
           $sizeconteudo = $_POST['sizeconteudo']; 
        }else{
            $sizeconteudo = '14';
        }
        
        if(is_numeric($_POST['sizeequipe'])) {
            $sizeequipe = $_POST['sizeequipe'];
        }else{
            $sizeequipe = '14';
        }

        */
        $sizeconteudo = '14';
        $sizeequipe = '14';

        
//        $numAr = $_POST['num'];
//        $flsAr = $_POST['fls'];
//        $sobnumAr = $_POST['sobnum'];
        $numAr = "";
        $flsAr = "";
        $sobnumAr = "";

        //$certif = $xml->getElementsByTagName('certificado')->item(0);

        $participante = $xml->getElementsByTagName('participante')->item(0)->nodeValue;
        $conteudo = $xml->getElementsByTagName('conteudo')->item(0)->nodeValue;
        $equipe = $xml->getElementsByTagName('equipe')->item(0)->nodeValue;
        $textoPrincipal = $xml->getElementsByTagName('texto')->item(0)->nodeValue;
        $dataEvento = $xml->getElementsByTagName('dataEvento')->item(0)->nodeValue;

        $pdf = new PDF_WriteTag('L','mm'); //Inicializa o PDF
        $pdf->SetAutoPageBreak(0);
        
        //$ordem = $_POST['ordem'];//Variavel contendo a ordem de impressao - 1=normal / 2=inverso
        $ordem = 1;

        //Cria os styles normal, negrito e negrito-italico
        $pdf->SetStyle("p","arial","N",13,"0,0,0",60);
        $pdf->SetStyle("b","arial","B",13,"0,0,0");
        $pdf->SetStyle("bi","arial","BI",13,"0,0,0");
        

        if($ordem == '1') {
            paginaFrente($pdf,$participante, $textoPrincipal, $dataEvento);
            paginaTras($pdf,$sizeconteudo,$conteudo,$equipe,$sizeequipe,$sobnumAr,$numAr,$flsAr);
        }
        else
        {
            paginaTras($pdf,$sizeconteudo,$conteudo,$equipe,$sizeequipe,$sobnumAr,$numAr,$flsAr);
            paginaFrente($pdf,$participante, $textoPrincipal, $dataEvento);                
        }

        
        $pdf->Output("Certificado.pdf", "I");//Gera a pagina PDF
    }   
?>
