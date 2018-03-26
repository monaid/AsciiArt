<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;
/**
*	"normal" stars are symmetric 
*	so this is only a normalized version from some funny kind of idea of a star
*/

class ChristmasStar extends AsciiArtObject {
  
   
   /**
   *	@protected integer $middle  the middle of the star as array index
   */
   protected $middle; 
    /**
    *   @return \SplFixedArray[\SplFixedArray[string]]	return a matrix as a list of SplFixedArrays   
    */
    protected function generateMatrix() {
      $size = $this->actualsize;
      $matrix = new \SplFixedArray($size);
      $this->middle = round($size / 2) -1; /* as array index */
      $width = $this->dimensions[$size] = $this->calculateLength($this->middle) + 2 ; 
      for ($n = 0; $n < $size  ; $n++) {
	  $matrix[$n] = $this->getLine($n);
      } 
      $matrix[0][round($width/2) -1 ] = "+"; 
      $matrix[$size -1][round($width/2) -1 ]= "+"; 
      $matrix[$this->middle][0] = "+";  
      $matrix[$this->middle][$this->dimensions[$this->actualsize] -1] = "+";
      return $matrix;	  
    }
   
   /**
    *	@param  integer  number of the Y cord of the matrix
    *	@param  string 	character using to paint the shape  
    *	@return \SplFixedArray[string] 
    */
    private function getLine($n, $char="*" ){
	$line  = new \SplFixedArray($this->dimensions[$this->actualsize] );
	$width = $this->calculateLength($n);
	$offset = (($this->dimensions[$this->actualsize] - $width)/ 2);
	for ($i = $offset; $i <  ($line->count() - $offset); $i++){
	       $line[$i] = $char;
	 }
	 return $line;
     }
    
    
    /**
    *	@param  integer the line number 
    *	@return integer width of the tree in the current line
    */
    private function calculateLength($n){ 
	if ($n <= $this->middle) return ((4 * ($n - 1)) + 1);
    	return  ($this->dimensions[$this->actualsize] -2 )-  (($n -  $this->middle) *4  ) ; 
 	
    }
}