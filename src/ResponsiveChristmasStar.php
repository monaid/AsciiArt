<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;

class ResponsiveChristmasStar extends ChristmasStar {

/**
   *	@protected integer $middle  the middle of the star as array index
   */
   // protected $middle; 
    /**
    *   @return \SplFixedArray[\SplFixedArray[string]]	return a matrix as a list of SplFixedArrays   
    */
    protected function generateMatrix() {
      $size = $this->actualsize;
      if ($size !== 11){
      /* ugly hack */
        $star = new  ChristmasStar();
        if ($this->output)  $star->setOutput($this->output);
        $flip = array_flip($this->sizes);
        $star->setSize($flip[$size]);
        return $star->getCachedMatrix($size);      
      }
      else {
        $matrix = new \SplFixedArray($size);
        $this->middle = 5;
        $width = $this->dimensions[$size] = $this->calculateLength($this->middle) + 2 ;
        for ( $n = 2; $n <  9; $n++){
	  $matrix[$n] = $this->getLine($n);
	}
	foreach ([0,  $size -1] as $number){
	   $matrix[$number] = new \SplFixedArray($width);
	   $matrix[$number] [round($width/2) -1 ] = "+";
	}
	foreach ([1,  $size -2] as $number){
	   $matrix[$number] = new \SplFixedArray($width);
	   $matrix[$number] [round($width/2) -1 ] = "*";
	}
	$matrix[$this->middle][0] = $matrix[$this->middle][$width -1] = "+";
      }
      
      return $matrix;	  
    }
     
        
    /**
    *	@param  integer the line number 
    *	@return integer width of the tree in the current line
    */
    protected function calculateLength($n) {
      if ( $n <= $this->middle ) return ((($this->middle - 1)  * ( $n - 2)) + 3);
      if ( $n > $this->middle ) return  ($this->dimensions[$this->actualsize] -2) - (($n - ($this->middle )) * 4);
    }


}
