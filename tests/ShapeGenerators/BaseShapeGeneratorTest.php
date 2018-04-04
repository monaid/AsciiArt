<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;

class BaseShapeGeneratorTest extends PHPUnit_Framework_TestCase {




/**
*	@backupStaticAttributes enabled
*/ 
  
      protected static $reflection;
      protected static $mock;
      protected static $generator;
      
     public static function setUpBeforeClass(){
	  self::$reflection = new \ReflectionClass ('\monaid\AsciiArt\ShapeGenerators\BaseShapeGenerator');
	  
      }
      protected function setUp(){
	  self::$mock =  $this->getMockBuilder('\monaid\AsciiArt\ShapeGenerators\BaseShapeGenerator')
	    ->setMethods(['normalize'])
	    ->getMockForAbstractClass('\monaid\AsciiArt\ShapeGenerators\BaseShapeGenerator');
      }

/**
*	@covers \monaid\AsciiArt\ShapeGenerators\BaseShapeGenerator::normalize
*/
      
      public function testNoramlizeWithYToResult() {
	     $method = self::$reflection->getMethod('normalize');
	     $method->setAccessible(true);
	     $this->assertEquals($method->invoke(self::$mock, 5, 7), [5,7]);
     
      }

}