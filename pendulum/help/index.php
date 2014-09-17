<?php
require_once '../../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', 'Help - Pendulum Simulator');
$контрол->задайОтФайл('head', '../simulator-head.html');
$контрол->задайОтФайл('body', 'help-body.html');
echo $контрол->постройСтраница();