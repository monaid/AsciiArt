<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;

class ChristmasTree extends AsciiArtObject {

    
    /**
    *   @return \SplFixedArray[\SplFixedArray[string]]	return a matrix as a list of SplFixedArrays   
    */
    protected function generateMatrix() {
      $size = $this->actualsize;
      $matrix = new \SplFixedArray($size);
      $width =  $this->calculateLength($size);
      $this->dimensions[$size] = $width;
      
      for ($n = 0; $n < $size; $n++) {	
      	  $matrix[$n] = $this->getLine($n); 
      } 
      $matrix[0][round($width/2) -1 ]= "+"; 
      return $matrix;
    }

    /**
    *	@param  integer the line number
    *	@return integer width of the tree in the current line
    */
    private function calculateLength($n){
        return (2 * ($n - 2)) + 1;
    }
    /**
    *	@param  integer  number of the Y cord of the matrix
    *	@param  string 	character using to paint the shape  
    *	@return \SplFixedArray[string] 
    */
    private function getLine($n, $char = "*"){
	   $line  = new \SplFixedArray($this->dimensions[$this->actualsize]);
	   $width = $this->calculateLength($n + 1);
	   $offset = (($this->dimensions[$this->actualsize] - $width)/ 2);
	   for ($i = $offset; $i <  ($line->count() - $offset); $i++){
	        $line[$i] = $char;
	   }
	   return $line;
    }
} 