<?php
require_once '../../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', 'Help - Pendulum Simulator');
$контрол->задайОтФайл('head', '../simulator-head.szbl');
$контрол->задайОтФайл('body', 'help-body.szbl');
echo $контрол->постройСтраница();