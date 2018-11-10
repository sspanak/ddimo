<?php
require_once '../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('lang', 'en');
$контрол->задай('title', "Dimo Karaivanov's website");
$контрол->задайОтФайл('head', 'head.szbl');
$контрол->задайОтФайл('body', 'body.szbl');
echo $контрол->постройСтраница();