<?php

namespace monaid\AsciiArt\Matrix;

use  monaid\AsciiArt as Ascii;

class MatrixColoumn extends MatrixElement{

/**
*	@param string $key 
*	@return bool 
*/
    protected function validateValue($value) {
      if (strlen($value) === 1)  return true;
      return false;
     }
    
}