<?php

namespace monaid\AsciiArt\Matrix;

use  monaid\AsciiArt as Ascii;

/**
*	not pointing to an Element in the Matrix but it's the base class for building one
*  
**/


abstract class MatrixElement implements \ArrayAccess {

/**
*	@protected \SplFixedArray $data  hold the data   
*/
    protected $data;
   
/**
*	@param integer $length  coloumn length
*
*/
    public function __construct($length){
	$this->data = new \SplFixedArray($length);  
    }
/**
*	@param string $key 
*	@return bool 
*/
    abstract protected function validateValue($value) ; 
    
/**
*	may setting on readonly by checking for NULL value ?  
*/
   
/**
*	@param	integer	$id 	array id
*	@param 	$string $char	the character to set 
*	@throws Ascii\Exceptions\MatrixValueException when key is unset or unvalid
*/
    public function offsetSet($offset, $value) {
	if (is_null($offset)) {
	    throw new Ascii\Exceptions\MatrixValueException("can't set a Matrix value, when Key ist unset"); 
        }else { 
	   try { 
	      if ($this->validateValue($value))  $this->data[$offset] = $value;
	   }catch (\RuntimeException $e){
	     throw new  Ascii\Exceptions\MatrixValueException("can't set unvalid Matrix key", Null, $e);
	   }
	}
	  
             
    }

 
/**
*	@param	integer $offset test if array key exists
*	@return	bool
*/
    public function offsetExists($offset)  {
	return $this->data->offsetExists($offset);
    }
/**
*	@param	integer $offset removes value at given key
*	@throws  Ascii\Exceptions\MatrixValueException if $offset is invalid
*/
    public function offsetUnset($offset) {	
	try{
	    $this->data[$offset] = NULL;
	}catch (\RuntimeException $e) {
	    throw new  Ascii\Exceptions\MatrixValueException("can't unset an invalid value", Null, $e);  
	}
    }
/**
*	@param $offset the offset requested
*	@return void|null   the key requested or null  
*/
    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

/**
*	@return \SplFixedArray[integer => void|null	 
*/

    public function dump() {
	  return $this->data;
    }
    
    
}