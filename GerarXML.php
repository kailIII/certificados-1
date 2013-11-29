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


    $participantesArray = refinaArray($_POST['participantes']);
    $i = 1;

    date_default_timezone_set('America/Cuiaba');

    $tempoAtual = time();
    $pasta = date('d-m-Y',$tempoAtual)." ".date('H',$tempoAtual)."h".date('i',$tempoAtual)."m".date('s',$tempoAtual)."s";
    mkdir("XML/".$pasta,0700);

	$zipname = './XML/'.$pasta.'/Certificados.zip';
	$zip = new ZipArchive();
	$zip->open($zipname, ZipArchive::CREATE);

    foreach($participantesArray as $p)
    {
		$xml = new DOMDocument("1.0","utf-8");

		$root = $xml->createElement("certificado");
		$xml->appendChild($root);

		$evento   = $xml->createElement("evento");
		$eventoText = $xml->createTextNode(trim($_POST['evento']));
		$evento->appendChild($eventoText);

		$promovente   = $xml->createElement("promovente");
		$promoventeText = $xml->createTextNode(trim($_POST['promovente']));
		$promovente->appendChild($promoventeText);

		$dataEvento   = $xml->createElement("dataEvento");
		$dataEventoText = $xml->createTextNode(trim($_POST['dataEvento']));
		$dataEvento->appendChild($dataEventoText);		

		$participante   = $xml->createElement("participante");
		$participanteText = $xml->createTextNode(trim($p));
		$participante->appendChild($participanteText);

		$texto = $xml->createElement("texto");
		$textoText = $xml->createTextNode(trim($_POST['texto'.$i]));
		$texto->appendChild($textoText);

		$conteudo = $xml->createElement("conteudo");
		$conteudoText = $xml->createTextNode(trim($_POST['conteudo'.$i]));
		$conteudo->appendChild($conteudoText);

		$equipe = $xml->createElement("equipe");
		$equipeText = $xml->createTextNode(trim($_POST['equipe']));
		$equipe->appendChild($equipeText);

		$root->appendChild($evento);
		$root->appendChild($promovente);
		$root->appendChild($dataEvento);		
		$root->appendChild($participante);
		$root->appendChild($texto);
		$root->appendChild($conteudo);
		$root->appendChild($equipe);

		$xml->formatOutput = true;
		$path = "XML/".$pasta."/certificado".$i.".xml";
		$zip->addFile($path);

		$xml->save($path) or die("Error");

		$i++;
	}

	/*
	for($f=1;$f<=$i;$f++)
	{
		$files[$f-1] = "XML/".$pasta."/certificado".$f.".xml";
	}
	//GERAR ARQUIVO .ZIP
	$zipname = 'XML/'.$pasta.'/Certificados.zip';
	$zipfilename = 'Certificados.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::OVERWRITE);
	foreach ($files as $file) {
	  $zip->addFile($file);
	}
	$zip->close();
	*/

	$zip->close();

	//GERAR DOWNLOAD
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename="certificados.zip"');
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
?>