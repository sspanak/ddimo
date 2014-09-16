<?php
require_once 'htmlcontrol.php';

$контрол = new HTMLControl;

$контрол->задай('title', "Dimo Karaivanov's website");
$контрол->задайОтФайл('body', 'glavna' .DIRECTORY_SEPARATOR. 'glavna.html');
echo $контрол->постройСтраница();