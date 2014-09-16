<?php
require_once '../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', 'Crossfire Volunteer');
$контрол->задайОтФайл('head', 'head.html');
$контрол->задайОтФайл('body', 'body.html');
echo $контрол->постройСтраница();