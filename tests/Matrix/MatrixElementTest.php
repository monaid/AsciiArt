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

	
      
      

}