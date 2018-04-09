<?php

use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\Matrix;

class MatrixElementTest extends PHPUnit_Framework_TestCase {


    
    protected static $reflection;
    protected static $mock;

/**
*	@backupStaticAttributes enabled
*/
 
      public static function setUpBeforeClass(){
          
          self::$reflection  = new ReflectionClass('\monaid\AsciiArt\Matrix\MatrixElement');
               
          }
      protected function setUp(){
	  self::$mock =  $this->getMockBuilder('\monaid\AsciiArt\Matrix\MatrixElement')
	    ->disableOriginalConstructor()
	    ->getMockForAbstractClass('\monaid\AsciiArt\Matrix\MatrixElement');
      }

          
          
/**
*	@covers \monaid\AsciiArt\Matrix\MatrixElement
*/
      public function testConstructor() {
	
	  $method = self::$reflection->getMethod('__construct'); 
	  $method->setAccessible(true);
	  $method->invoke(self::$mock, 3);
	  $data = self::$reflection->getProperty('data');
	  $data->setAccessible(true);
	  $this->assertInstanceOf('\SplFixedArray', $data->getValue(self::$mock));
	  $this->assertEquals( $data->getValue(self::$mock)->count(), 3);   
      }

/**
*	@covers \monaid\AsciiArt\Matrix\MatrixElement::offsetSet
*/
      
      public function testOffsetSetWithNoKeyToException() {
	  $method = self::$reflection->getMethod('offsetSet');
	  try{
	    $method->invoke(self::$mock, NULL, "*");
	  }catch (\Exception $e) {
	       $this->assertInstanceOf('\monaid\AsciiArt\Exceptions\MatrixKeyNotValideException', $e);
	  }
       }
 /**
*	@covers \monaid\AsciiArt\Matrix\MatrixElement::offsetSet
*/
      public function testOffsetSetWithNotValidKeyToException() {
	  $method = self::$reflection->getMethod('offsetSet');
	  self::$mock->method('validateValue')->willReturn(true);
	  $data = self::$reflection->getProperty('data');
	  $data->setAccessible(true);
	   $data->setValue(self::$mock, new \SplFixedArray(2));
	   try{
	   $method->invoke(self::$mock, 111, "*");
	  }catch (\Exception $e) {
		    $this->assertInstanceOf('\monaid\AsciiArt\Exceptions\MatrixKeyNotValideException', $e);
	  }
       }

/**
*	@covers \monaid\AsciiArt\Matrix\MatrixElement::offsetSet
*/     
    
      public function testOffsetSetWithNoValidValueToException() {
      	  $method = self::$reflection->getMethod('offsetSet');
      	  self::$mock->method('validateValue')->willReturn(false);
	  try{
	     $method->invoke(self::$mock, 1, "****");
	  }catch (\Exception $e) {
	       $this->assertInstanceOf('\monaid\AsciiArt\Exceptions\MatrixValueException', $e);
	  }
        }
/**
*	@covers \monaid\AsciiArt\Matrix\MatrixElement::offsetSet
*/       

       public function testOffsetSetWithNoIntegerKeyToException() {

	  $method = self::$reflection->getMethod('offsetSet');
      	  self::$mock->method('validateValue')->willReturn(true);
	  try{
	     $method->invoke(self::$mock, "test", "*");
	  }catch (\Exception $e) {
	       $this->assertInstanceOf('\monaid\AsciiArt\Exceptions\MatrixKeyNotValideException', $e);
	  }
      }	  
       
/**
*	@covers \monaid\AsciiArt\Matrix\MatrixElement::offsetExists
*/         
      public function testOffsetExistsToFalse() {
         $method = self::$reflection->getMethod('offsetExists');
         $data = self::$reflection->getProperty("data");
         $data->setAccessible(true);
         $data->setValue(self::$mock, new \SplFixedArray(2));
	 $this->assertFalse($method->invoke(self::$mock, "test"));	
        
      }

      
      
      
      
}