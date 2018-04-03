<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\Matrix;

class MatrixColoumnTest extends PHPUnit_Framework_TestCase {
 
      protected static $coloumn;
      protected static $reflection;
/**
*	@backupStaticAttributes enabled
*/
 
      public static function setUpBeforeClass(){
          self::$coloumn = new  Matrix\MatrixColoumn(3);
          self::$reflection  = new ReflectionClass('\monaid\AsciiArt\Matrix\MatrixColoumn');
          }

/**
* @covers \monaid\AsciiArt\Matrix\MatrixColoumn::__construct
*/       
       
      public function testConstructor(){
	   $this->assertInstanceOf('\monaid\AsciiArt\Matrix\MatrixColoumn', self::$coloumn);
      }         

/**
 * @covers \monaid\AsciiArt\Matrix\MatrixColoumn::__construct
*  @depends testConstructor	
*/      
      
      public function testConstructorSetsValidDataPropertyType(){
	    $property = self::$reflection->getProperty('data');
	    $property->setAccessible(true);
	    $this->assertInstanceOf('\SplFixedArray', $property->getValue(self::$coloumn));
	}    
	    
/**
 * @covers \monaid\AsciiArt\Matrix\MatrixColoumn::__construct
*  @depends testConstructorSetsValidDataPropertyType	
*/      
     public function testConstructorSetsValidDataPropertyLength() { 
     	    $property = self::$reflection->getProperty('data');
	    $property->setAccessible(true);
	    $data = $property->getValue(self::$coloumn);
	    $this->assertEquals($data->count(), 3);
     }
/**
 * @covers \monaid\AsciiArt\Matrix\Matrix::__construct
*  @depends testConstructorSetsValidDataPropertyLength	
*/      
     public function testConstructorSetsValidDataPropertyKey(){
            $property = self::$reflection->getProperty('data');
	    $property->setAccessible(true);
	    $data = $property->getValue(self::$coloumn);
	    $this->assertEquals(NULL, $data[2]);
	    
     }      

/**
 * @covers  \monaid\AsciiArt\Matrix\MatrixColoumn::validateValue
*/
      public function testValidateValueToValid( ){
	  $reflectedClass = new \ReflectionClass('\monaid\AsciiArt\Matrix\MatrixColoumn');
	  $method = self::$reflection->getMethod('validateValue');
	  $method->setAccessible(true);
	  $this->assertTrue($method->invoke(self::$coloumn, "*"));
      } 

/**
 * @covers  \monaid\AsciiArt\Matrix\MatrixColoumn::validateValue
*/      
      public function testValidateValueToFalse() {
       	  $reflectedClass = new \ReflectionClass('\monaid\AsciiArt\Matrix\MatrixColoumn');
	  $method = self::$reflection->getMethod('validateValue');
	  $method->setAccessible(true);
	  $this->assertFalse($method->invoke(self::$coloumn, "---+"));
       }



}