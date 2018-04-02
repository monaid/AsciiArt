<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.4
 */
namespace monaid\AsciiArt\ShapeGenerators;



class ChristmasTree extends CalcShapeGenerator  {

    
/**
*	@param  integer $y the given height
*	@return integer $x the corresponding width
*/
    protected function getWidth($y){
	return $this->calculateLength($y);
    }	
    
/**
* 	@param  integer $X the given width
*	@return integer $y the corresponding height
*/
    protected function getHeight($x){
	 return round ($x /2 ) + 1; 
     }

/**
*	@param  integer the line number
*	@return integer width of the tree in the current line
*/
    protected function calculateLength($n){
        return (2 * ($n - 2)) + 1;
    }

/**
*	@param  integer  number of the Y cord of the matrix
*	@param  monaid\AsciiArt\Matrix\Matrix $matrix
*	@param  string 	character using to paint the shape  
*	@return self
*/
    protected function generateLine($n, &$matrix ,$char = "*"){
	   $length = $this->geo["x"];
	   $patternWidth = $this->calculateLength($n + 1);
	   $offset = ($length - $patternWidth)/ 2;
	   for ($i = $offset; $i <  ($length - $offset); $i++){
	        $matrix[$n][$i] = $char;
	   }
	   return $this;
    }
/**
*	@param \monaid\AsciiArt\Matrix\Matrix &$matrix 	
*/
    protected function correctFields(&$matrix) {
	  $matrix[0][$this->geo["x"]/2] = "+";
     }
} 