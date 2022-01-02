<?php
require_once '../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', 'Pendulum Simulator');
$контрол->задайОтФайл('head', 'simulator-head.szbl');
$контрол->задайОтФайл('body', 'simulator-body.szbl');
echo $контрол->постройСтраница();