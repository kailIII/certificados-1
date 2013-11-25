<?php



$xml = new DOMDocument("1.0","UTF-8");

$root = $xml->createElement("certificado");
$xml->appendChild($root);

$evento   = $xml->createElement("evento");
$eventoText = $xml->createTextNode($_POST['evento']);
$evento->appendChild($eventoText);

$participante   = $xml->createElement("participante");
$participanteText = $xml->createTextNode($_POST['participante']);
$participante->appendChild($participanteText);

$texto1 = $xml->createElement("texto1");
$texto1Text = $xml->createTextNode($_POST['texto']);
$texto1->appendChild($texto1Text);

$conteudo = $xml->createElement("conteudo");
$conteudoText = $xml->createTextNode($_POST['conteudo']);
$conteudo->appendChild($conteudoText);

$equipe = $xml->createElement("equipe");
$equipeText = $xml->createTextNode($_POST['equipe']);
$equipe->appendChild($equipeText);

$dados = $xml->createElement("dados");
$dados->appendChild($evento);
$dados->appendChild($participante);
$dados->appendChild($texto1);
$dados->appendChild($conteudo);
$dados->appendChild($equipe);

$root->appendChild($dados);

$xml->formatOutput = true;
echo "<xmp>". $xml->saveXML() ."</xmp>";
$xml->save("certificado.xml") or die("Error");

?>