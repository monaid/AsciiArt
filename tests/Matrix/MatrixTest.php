<?php

use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\Matrix;

class MatrixTest extends PHPUnit_Framework_TestCase {


    protected static $matrix;
    protected static $reflection;
/**
*	@backupStaticAttributes enabled
*/
 
      public static function setUpBeforeClass(){
          self::$matrix = new  Matrix\Matrix(3,4);
          self::$reflection  = new ReflectionClass('\monaid\AsciiArt\Matrix\Matrix');
      }

/**
* @covers \monaid\AsciiArt\Matrix\Matrix::__construct
*/       
       
      public function testConstructor(){
	   $this->assertInstanceOf('\monaid\AsciiArt\Matrix\Matrix', self::$matrix);
      } 
        
/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::__construct
*  @depends testConstructor	
*/      
      
      public function testConstructorSetsValidDataPropertyType(){
	    $property = self::$reflection->getProperty('data');
	    $property->setAccessible(true);
	    $this->assertInstanceOf('\SplFixedArray', $property->getValue(self::$matrix));
	}    
	    
/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::__construct
*  @depends testConstructorSetsValidDataPropertyType	
*/      
     public function testConstructorSetsValidDataPropertyLength() { 
     	    $property = self::$reflection->getProperty('data');
	    $property->setAccessible(true);
	    $data = $property->getValue(self::$matrix);
	    $this->assertEquals($data->count(), 4);
     }
/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::__construct
*  @depends testConstructorSetsValidDataPropertyLength	
*/      
     public function testConstructorSetsValidDataPropertyKey(){
            $property = self::$reflection->getProperty('data');
	    $property->setAccessible(true);
	    $data = $property->getValue(self::$matrix);
	    $this->assertInstanceOf('\monaid\AsciiArt\Matrix\MatrixColoumn', $data[2]);
	    
     }
/**
* @covers \monaid\AsciiArt\Matrix\Matrix::validateValue
*  @depends testConstructor 
*/
      public function testValidateValueToValid( ){
	  $reflectedClass = new \ReflectionClass('\monaid\AsciiArt\Matrix\Matrix');
	  $method = $reflectedClass->getMethod('validateValue');
	  $method->setAccessible(true);
	  $c = new \monaid\AsciiArt\Matrix\MatrixColoumn(1);
	  $this->assertTrue($method->invoke(self::$matrix, $c));
      }

/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::validateValue
*  @depends testConstructor
*/      
      
      public function testValidateValueToFalse() {
       	  $reflectedClass = new \ReflectionClass('\monaid\AsciiArt\Matrix\Matrix');
	  $method = $reflectedClass->getMethod('validateValue');
	  $method->setAccessible(true);
	  $this->assertFalse($method->invoke(self::$matrix, "+"));
       }

     
/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::offsetSet
*  @depends testConstructorSetsValidDataPropertyKey
*/   
      
      public function testForDirectArrayAccessToTrue(){
	      $this->assertEquals("*",  self::$matrix[0][1] = "*");
      }
     
/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::offsetSet
*  @depends testConstructorSetsValidDataPropertyKey	
*/   
      
      public function testForDirectArrayAccessToMatrixValueException(){
	   try{
		self::$matrix[0][1] =  "s,d";
	   }catch(\monaid\AsciiArt\Exceptions\MatrixValueException $e){	
	      $this->assertInstanceOf('\monaid\AsciiArt\Exceptions\MatrixValueException', $e);
 	   }
     }   

/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::offsetSet
*  @depends testConstructorSetsValidDataPropertyKey	
*/	   

      public function testForDirectArrayAccessToMatrixKeyNotValidException(){
	try { 
		self::$matrix[0]["sddcas"] = "*";
	   }catch(\monaid\AsciiArt\Exceptions\MatrixKeyNotValideException $e){
	        $this->assertInstanceOf('\monaid\AsciiArt\Exceptions\MatrixKeyNotValideException', $e);
	   }
 	   
      }




}