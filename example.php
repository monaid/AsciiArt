<?php

require_once ('vendor/autoload.php');

use \monaid\AsciiArt as Ascii;



$outputToConsole = new Ascii\OutputConsole();
$outPutAsRawHTML = new Ascii\OutputRawHTML();


$christmasTree = new Ascii\ChristmasTree();
$christmasStar = new Ascii\ResponsiveChristmasStar();



print $christmasStar->setOutput($outputToConsole)->render();


print $christmasTree->setOutput($outPutAsRawHTML)->setSize('small')->render();
