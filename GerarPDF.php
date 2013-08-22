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
    function paginaFrente($pdf,$participante, $periodoAr, $cargaAr, $textoPrincipal,$funcaoAr, $n) {
            //Pagina da Frente
            $pdf->AddPage();
            $pdf->SetLeftMargin(110);   //Margem esquerda do texto principal - á 110mm da borda esquerda
            $pdf->SetRightMargin(20);   //Margem direita do texto principal - á 20mm da borda direita
            $pdf->SetFont('Arial','',14);         
            $pdf->SetXY(110,70); //Posicao inicial do texto do certificado -- posicao x = 110mm / posicao y = 70mm/   
            
            //Substitui as tags {nome} pelo nome do participante / {periodo} pelo periodo que a pessoa esteve participando / {carga} a carga horaria total que a pessoa participou
            $texto = str_replace( array( "{nome}", "{periodo}", "{carga}", "{período}" ), 
                         array( "<b>".$participante."</b>", $periodoAr[$n-1], $cargaAr[$n-1] , $periodoAr[$n-1]),
                $textoPrincipal );
            
            $texto = str_replace( array( "{funcao}", "{funçao}", "{função}" ), 
                         $funcaoAr[$n-1],
                $texto );
            
            $texto = utf8_decode("<p>".$texto)."</p>";//Decodifica todo o texto para utf-8 para resolver alguns erros de 
                                                      //caracteres, e adiciona tags de paragrafo no inicio e fim do texto        
            $pdf->WriteTag(167, 9, $texto);//Escreve o texto principal no pdf
            $pdf->SetXY(110,$pdf->GetY()+10);//Posiciona duas 1cm abaixo para escrever a data do certificado
            $data = utf8_decode("Cuiabá-MT, ".$_POST['dataimpressa'].".");//Data da impressão
            $pdf->Cell(167, 5, $data ,0,1,'R',false); //Adiciona a data da impressão no corpo do certificado
    }
            

    function paginaTras($pdf,$sizeconteudo,$equipeAr,$sizeequipe,$sobnumAr,$numAr,$flsAr,$n) {
            //Pagina de Tras
            
            $pdf->AddPage();//Adiciona pagina de trás do certificado
            $pdf->SetXY(15,30);//Posiciona para escrever no conteudo programatico
            
            //Escreve o conteudos programaticos
            $pdf->SetFont('arial','',$sizeconteudo);//Seleciona fonte normal arial para o conteudo programatico
            $pdf->MultiCell(110,5,utf8_decode($_POST['conteudo'.$n][0]),0,'L');//Escreve o conteudo programatico
            
            $pdf->SetXY(154,30);//Posiciona para escrever a Equipe Executora
            
            foreach($equipeAr as $integrante) {//Escreve os integrantes da Equipe Executora
                $pdf->SetFont('arial','',$sizeequipe);
                $pdf->MultiCell(110,6,utf8_decode($integrante),0,'L');//Escreve o nome do integrante da equipe executora, em negrito - texto centralizado
                $pdf->SetX(154);
            }
            
            //Escreve o bloco de assinatura [DESATIVADO]
            
//            $pdf->SetXY(182, 140);//Posição para bloco de assinatura
//            $pdf->SetFont('arial','B','13'); //Seta fonte para o bloco - arial em negrito tamanho 13
//            $textoBlocoAssinatura = utf8_decode("UFMT - PROCEV - CODEX"."\n"."Certificado Registrado no livro"."\n\n"."nº.".$numAr[$n-1]."     fls.".$flsAr[$n-1].
//                    "\n\n\n"."sob nº. ".$sobnumAr[$n-1]."\n\n____________________\nResponsável p/ Registro\n");
//            $pdf->MultiCell(70, 5, $textoBlocoAssinatura, 1, 'C');//Imprime bloco de assinatura
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
        
//        $numAr = $_POST['num'];
//        $flsAr = $_POST['fls'];
//        $sobnumAr = $_POST['sobnum'];
        $numAr = "";
        $flsAr = "";
        $sobnumAr = "";
        $periodoAr = $_POST['periodo'];
        $cargaAr = $_POST['carga'];
        $funcaoAr = $_POST['funcao'];
  
        $participanteAr = refinaArray($_POST['participantes']);
        $ContProgAr = refinaArray($_POST['contprogramatico']);
        $equipeAr = refinaArray($_POST['equipe']);
        
        $textoPrincipal = $_POST['texto'];
        
        //Substitui as tags {evento} e {promovente} do texto principal pelos valores previamente preenchidos, adicionando tags para style negrito
        //ao texto do evento
        $textoPrincipal = str_replace( array( "{evento}", "{promovente}", ), 
                     array( "<b>".$_POST['evento']."</b>", $_POST['promovente'] ),
                     $textoPrincipal );
                
        $pdf = new PDF_WriteTag('L','mm'); //Inicializa o PDF
        $pdf->SetAutoPageBreak(0);
        
        $ordem = $_POST['ordem'];//Variavel contendo a ordem de impressao - 1=normal / 2=inverso
        
        //Cria os styles normal, negrito e negrito-italico
        $pdf->SetStyle("p","arial","N",13,"0,0,0",60);
        $pdf->SetStyle("b","arial","B",13,"0,0,0");
        $pdf->SetStyle("bi","arial","BI",13,"0,0,0");
        
        $n = 1;//Variavel contendo o numero participante, de 1 a n
        foreach ($participanteAr as $participante) {

            if($ordem == '1') {
                paginaFrente($pdf,$participante, $periodoAr, $cargaAr, $textoPrincipal,$funcaoAr, $n);
                paginaTras($pdf,$sizeconteudo,$equipeAr,$sizeequipe,$sobnumAr,$numAr,$flsAr,$n);
            }
            else
            {
                paginaTras($pdf,$sizeconteudo,$equipeAr,$sizeequipe,$sobnumAr,$numAr,$flsAr,$n);
                paginaFrente($pdf,$participante, $periodoAr, $cargaAr, $textoPrincipal,$funcaoAr, $n);                
            }
            $n++;//incrementa variavel que representa o numero do participante
        }
        $pdf->Output("Certificado.pdf", "I");//Gera a pagina PDF
    }   
?>
