<?php
namespace monaid\AsciiArt\ShapeGenerators;
use monaid\AsciiArt\Matrix;


abstract class CalcShapeGenerator extends  BaseShapeGenerator{

    abstract protected function getWidth($y);
    abstract protected function getHeight($x);
    abstract protected function generateLine($n, $coloumn);
    abstract protected function correctFields($matrix);

/**
*	@protected string  $char
*/    
      protected $char = "*";
/**
*	@protected integer  $offestTop 
*/ 
    protected $offestTop = 0; 

/**
*	@protected integer  $offestBottom
*/
     protected $offestBottom = 0;

/**
*	@param integer $x the width may 0  
*	@param integer $y the height may 0
*	@return \monaid\AsciiArt\Matrix\Matrix	the compiled Martix
*/
    public function compile($x, $y){
  
	list ($x, $y) =  $this->normalize($x, $y);
 	if (isset ($this->cache[$x . "/" . $y])) return $this->cache[$x . "/" . $y];
 	$matrix = new Matrix\Matrix($x, $y);     
	for ($n  = (0 + $this->offestTop); $n < ($y - $this->offestBottom); $n++) {
	
	// this is bad as bad can be ?
	// liked passbyreference more but it more stressig to test, even not possible ? 
	  $matrix[$n] = $this->generateLine($n, $matrix[$n]);
	}
	$matrix = $this->correctFields($matrix);
	return  $this->cache[$x . "/" . $y] = $matrix;
    }  
    
}    