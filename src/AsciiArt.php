<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.3
 */
namespace monaid\AsciiArt;

class AsciiArt {
/**
*	a list of shortcuts using to define $x/$y relations 
*	which could be used to whiltlistening allowed sizes 
*	I prefer null to zero while this are coords 
*
*	@protected Array[string => [integer, integer]  $availableSizes  
*/
   protected $availableSizes = [
	's' => [null,5], 'm' =>[null, 7], 'l'=> [null, 11], 
	'large' => [null, 11], 'medium' =>[null, 7], 'small' => [null,5]
      ]; 
      
/**
*   	@protected Array[strings]	$gen 	
*	holoding the generators
*/
   
    public $gen = [];
    
    
/**
*	@param string $size 
*	@return bool  
*/
     public function isSizeValid($name) {
	if (isset  ($this->availableSizes[strtolower($name)])) return true;
	return false;
      }
      
/**
*	@param string|null  $name 
*	  the string translated to a valid  size fetched from  $availableSizes  
*	  at null generat a random size	
*	@return Array[null, integer] hence therte is only a y correlated definition wanted
*		and bool false if size not defined	
*/
/**	
*	may only return y values to keep the api more elegant 
*/
      public function translateSizes($name=null) {
	if (! $name) $name = array_rand( $this->availableSizes);
	if ($this->isSizeValid($name)) return $this->availableSizes[$name];
	return false;
      }

/**
*	@param Array[string => [integer, integer]
*/
    public function setSizes($assoc){
       // testing the format !!! validate  assoc
      // may replace
      $this->availableSizes = array_merge($this->availableSizes, $assoc);
   }

/**
*	@param string shurcut property (use arryInterface --- not ?)
*	@param ShapeGenerators\BaseShapeGenerator $generator
*	the genrator calculating the dimensions and populating the matrix  
*	
*/
     public function registerGenerator($string,  ShapeGenerators\BaseShapeGenerator $generator){
/**
*	@param integer $x
*	@param integer $y
*/
	     $this->gen[$string] = function ($x, $y) use ($generator) { 
					return $generator->compile($x, $y);
				    }; 
     }
   
}
  
  
  