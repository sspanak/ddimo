<?php
require_once '../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', 'Pendulum Simulator');
$контрол->задайОтФайл('head', 'simulator-head.html');
$контрол->задайОтФайл('body', 'simulator-body.html');
echo $контрол->постройСтраница();