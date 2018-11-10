<?php
require_once '../htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('lang', 'en');
$контрол->задай('title', 'График на личните лекари');
$контрол->задайОтФайл('head', 'head.szbl');
$контрол->задайОтФайл('body', 'body.szbl');
echo $контрол->постройСтраница();