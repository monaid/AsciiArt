<?php

namespace monaid\AsciiArt\Matrix;

use  monaid\AsciiArt as Ascii;
/**
*	orientation screen/print
*/
class Matrix extends MatrixElement{ 


/**
*	@param  integer $x  height of the matrix   
*	@param  integer $y  width of the matrix
*/
    public function __construct($x, $y){
	parent::__construct($y);
	for ($n = 0; $n < $y ; $n++){
	    $this->data[$n] = new MatrixColoumn($x);
	 }
       }
       
/**
*	@param string $key 
*	@return bool 
*/
    protected function validateValue($value) {
      if ($value instanceof MatrixColoumn)  return true;
      return false;
     }

}