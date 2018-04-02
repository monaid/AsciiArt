<?php
/**
*	actual folder is
*	vendor/monaid/AsciiArt
*	with this setup you can run expample.php from here
*
*	for normal use: 
*	require_once ('./vendor/autoload.php');
*/

require_once ('../../../vendor/autoload.php');

use \monaid\AsciiArt as Ascii;

/**
*	Create the AsciiArt Object 
*/

$c = new Ascii\AsciiArt();


/**
*	register generators
*/

$c->registerGenerator('ct', new Ascii\ShapeGenerators\ChristmasTree());  
$c->registerGenerator('rs', new Ascii\ShapeGenerators\ResponsiveChristmasStar()); 
$c->registerGenerator('cs', new Ascii\ShapeGenerators\ChristmasStar());


/**
*	define output format
*/

$out = new Ascii\Output\OutputLikeDebug();
$html = new Ascii\Output\OutputRawHTML();
$raw = new Ascii\Output\OutputConsole();

/**
*	filling raw  
*/

$c->gen["ct"](19, null);


/**
*	means
*/

print $out->render($c->gen["rs"](null, 5));
print $out->render($c->gen["cs"](null, 11));
print $out->render($c->gen["rs"](null, 11));
print $out->render($c->gen["ct"](null, 11));

/**
*	using translator for human readeble sizes with random fallback  	
*/
list ($x, $y ) = $c->translateSizes();
print $out->render($c->gen["ct"]($x, $y));