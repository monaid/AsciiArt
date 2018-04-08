<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.3
 */
namespace monaid\AsciiArt\ShapeGenerators;

class ResponsiveChristmasStar extends ChristmasStar {

/**
*	there seems to be no elegant way generating 
*	this spezial kind of responsive star.
*	so here is the next try
*/

/** 	@param  integer $X the given width
*	@return integer $y the corresponding height
*/   
    protected function getHeight($x){
	  if ($x < 15) return (2 + (($x -1)/2));
 	  return  (3 + (($x -1)/2));
	  
    }
/**
*	@param  integer $y the given height
*	@return integer $x the corresponding width
*/
     protected function getWidth($y){
 	$width = parent::getWidth($y);
 	return ($y === 11) ? $width -2 : $width;
     }
     
/**
*	@param  integer the line number 
*	@return integer width of the tree in the current line
*/
    protected function calculateLength($n){ 
	$length = parent::calculateLength($n);
	return ($this->geo["y"] === 11 && $n <= 6) ? $length -2 : $length;
    }

/**
*	@param  \monaid\AsciiArt\Matrix\Matrix
*/
    protected function correctFields($matrix){
	 if ($this->geo["y"] === 11) {
 	       $matrix[1][8] = $matrix[9][8] = "*";
	  }
	  $matrix[0][round($this->geo["x"] / 2) -1] = "+";
          $matrix[$this->geo["y"] -1][round($this->geo["x"] / 2) -1] = "+";
          $matrix[$this->geo["y"]/2 ][0] = $matrix[$this->geo["y"]/2 ][$this->geo["x"] -1]  = "+" ;
          return $matrix;
    }
    
  


}
