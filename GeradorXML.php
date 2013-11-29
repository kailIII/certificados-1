<?php

	date_default_timezone_set('America/Cuiaba');

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

    function GeradorXML($participanteXML, $eventoXML, $promoventeXML, $dataEventoXML, $textoXML, $conteudoXML, $equipeXML, $dataGeradaXML)
    {

	    $participantesArray = refinaArray($participantes);

	    //$tempoAtual = time(); //// $dataGeradaXML = time(); <-antes da chamada da função
	    $pasta = date('d-m-Y',$dataGeradaXML)." ".date('H',$dataGeradaXML)."h".date('i',$dataGeradaXML)."m".date('s',$dataGeradaXML)."s";
	    mkdir("XML/".$pasta,0700);

		$xml = new DOMDocument("1.0","utf-8");

		$root = $xml->createElement("certificado");
		$xml->appendChild($root);

		$evento   = $xml->createElement("evento");
		$eventoText = $xml->createTextNode(trim($eventoXML));
		$evento->appendChild($eventoText);

		$promovente   = $xml->createElement("promovente");
		$promoventeText = $xml->createTextNode(trim($promoventeXML));
		$promovente->appendChild($promoventeText);

		$dataEvento   = $xml->createElement("dataEvento");
		$dataEventoText = $xml->createTextNode(trim($dataEventoXML));
		$dataEvento->appendChild($dataEventoText);		

		$participante   = $xml->createElement("participante");
		$participanteText = $xml->createTextNode(trim($participanteXML));
		$participante->appendChild($participanteText);

		$texto = $xml->createElement("texto");
		$textoText = $xml->createTextNode(trim($textoXML));
		$texto->appendChild($textoText);

		$conteudo = $xml->createElement("conteudo");
		$conteudoText = $xml->createTextNode(trim($conteudoXML));
		$conteudo->appendChild($conteudoText);

		$equipe = $xml->createElement("equipe");
		$equipeText = $xml->createTextNode(trim($equipeXML));
		$equipe->appendChild($equipeText);

		$root->appendChild($evento);
		$root->appendChild($promovente);
		$root->appendChild($dataEvento);		
		$root->appendChild($participante);
		$root->appendChild($texto);
		$root->appendChild($conteudo);
		$root->appendChild($equipe);

		$xml->formatOutput = true;
		
		$xml->save("XML/".$pasta."/certificado".$i.".xml") or die("Error");

		//GERAR ARQUIVO ZIP - DEPOIS DA CHAMADA DA FUNÇÃO
		/*
		for($f=1;$f<=$i;$f++)
		{
			$files[$f-1] = "XML/".$pasta."/certificado".$f.".xml";
		}
		//GERAR ARQUIVO .ZIP
		$zipname = 'XML/'.$pasta.'/Certificados '.$pasta.'.zip';
		$zipfilename = 'Certificados '.$pasta.'.zip';
		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
		  $zip->addFile($file);
		}
		$zip->close();
		*/
	}

	//GERAR DOWNLOAD
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipfilename);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
?>