<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;

ResponsiveChristmasStar extends ChristmasStar {

/**
   *	@protected integer $middle  the middle of the star as array index
   */
   protected $middle; 
    /**
    *   @return \SplFixedArray[\SplFixedArray[string]]	return a matrix as a list of SplFixedArrays   
    */
    protected function generateMatrix() {
     print "called";
      $size = $this->actualsize;
      if ($size != 11){
        print "hallo";
	return parrent::generateMatrix();
      }
      else {
	print "test"; 
        $matrix = new \SplFixedArray($size);
      }
      return $matrix;	  
    }




}