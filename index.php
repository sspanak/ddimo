<?php
require_once 'htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', "Dimo Karaivanov's website");
$контрол->задайОтФайл('head', 'glavna' .DIRECTORY_SEPARATOR. 'head.szbl');
$контрол->задайОтФайл('body', 'glavna' .DIRECTORY_SEPARATOR. 'body.szbl');

echo $контрол->постройСтраница();