<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.4
 */

namespace monaid\AsciiArt\ShapeGenerators;

/**
*	"normal" stars are symmetric 
*	so this is only a normalized version from some funny kind of idea of a star
*	
*/

class ChristmasStar extends CalcShapeGenerator {
  

/**
*	@protected integer  $offestTop 
*/ 
    protected $offestTop = 1; 

/**
*	@protected integer  $offestBottom
*/
     protected $offestBottom = 1;
    
/**
* 	@param  integer $X the given width
*	@return integer $y the corresponding height
*/   
   protected function getHeight($x){
	return (2 + (($x -1)/2));
    }
    
/**
*	@param  integer $y the given height
*	@return integer $x the corresponding width
*/
    protected function getWidth($y){
	 return ((4 * ($y/2 - 1)) + 1);
    }
    
/**
*	@param  integer  number of the Y cord of the matrix
*	@param  monaid\AsciiArt\Matrix\Matrix $matrix
*	@param  string 	character using to paint the shape  
*	@return self
*/
    protected function generateLine($n, &$matrix, $char="*"){
    	   $length = $this->geo["x"];
	   $patternWidth = $this->calculateLength($n + 1);
	   $offset = ($length - $patternWidth)/ 2;
	   for ($i = $offset; $i <  ($length - $offset); $i++){
	        $matrix[$n][$i] = $char;
	   }
	   return $this;
    }
    
/**
*	@param  \monaid\AsciiArt\Matrix\Matrix
*/
    protected function correctFields(&$matrix){
	  $matrix[0][round($this->geo["x"] / 2) -1] = "+";
          $matrix[$this->geo["y"] -1][round($this->geo["x"] / 2) -1] = "+";
          $matrix[$this->geo["y"]/2 ][0] = $matrix[$this->geo["y"]/2 ][$this->geo["x"] -1]  = "+" ;
    }
    
    
/**
*	@param  integer the line number 
*	@return integer width of the tree in the current line
*/
    protected function calculateLength($n){ 
	if ($n <= round($this->geo["y"]/2) ) return ((4 * ($n -2)) + 1);
   	else return ($this->geo["x"] - 2) - (($n -  round ($this->geo["y"]/2)) * 4); 
    }
}
