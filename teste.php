<?php

    session_start();

    if($_SESSION["Login"] != "YES") {
        header("Location: index.php");
    }
    else
    {
        require('fpdf/WriteHTML.php');
     
        
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
        $textoPrincipal = $_POST['texto'];
        str_replace( array( "{evento}", "{departamento}", ), 
                     array( $_POST['evento'], $_POST['departamento'] ),
                     $textoPrincipal );
        
        $pdf = new PDF_HTML('L','mm');
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
            $pdf->SetXY(110,70); //Posicao inicial do texto do certificado -- posicao x = 110mm / posicao y = 70mm
            //$txt = file_get_contents('fpdf/license.txt');
            /*$texto = "EVENTO: ".$_POST['evento']."\nDepartamento :".$_POST['departamento']."\nPeriodo :".$_POST['periodo'].
                    "\nParticipante :".$value;*/
            
            $texto = utf8_decode("                         "."Certifi<B>ca</B>mos que ".$participante." participou do evento ".$_POST['evento']." realizado pelo ".
                    $_POST['departamento']." no periodo ".$_POST['periodo']." com carga horaria de ".$_POST['carga']." horas.");
            
            $pdf->MultiCell(167,9,$texto,0,'J',false); //Adiciona o texto no corpo principal do certificado
            //$pdf->WriteHTML($texto);
            $pdf->SetXY(110,$pdf->GetY()+10);
            $pdf->Cell(167, 5, "Cuiabá-MT, ".$_POST['dataimpressa'].".",0,1,'R',false); //Adiciona a data da impressão no corpo do certificado
            $pdf->AddPage();
            $pdf->SetXY(15,25);
            $pdf->MultiCell(128,5,$_POST['contprogramatico'],0,'C',false);
            $pdf->SetXY(154,25);
            $pdf->MultiCell(128,5,$_POST['equipe'],0,'C',false);
        }
        $pdf->Output("PaginaPDF", "I");
    }   
?>
