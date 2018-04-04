<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;

class ChristmasTreeTest extends PHPUnit_Framework_TestCase {




/**
*	@backupStaticAttributes enabled
*/ 
  
      protected static $christmasTree;
      protected static $reflection;
  
      public static function setUpBeforeClass(){
	  self::$christmasTree = new ShapeGenerators\ChristmasTree();
	  self::$reflection = new \ReflectionClass ('\monaid\AsciiArt\ShapeGenerators\ChristmasTree');
      }
  
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::__construct
*/       
       
      public function testConstructor(){
	   $this->assertInstanceOf('\monaid\AsciiArt\ShapeGenerators\ChristmasTree', self::$christmasTree);
      } 
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::calculateLength
*	@depends testConstructor
*/ 
	public function testGetHeight()  {
	  $method = self::$reflection->getMethod('getHeight');
	  $method->setAccessible(true);
	  $this->assertEquals($method->invoke(self::$christmasTree, 7), 5);
	
	}
      
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::calculateLength
*	@depends testConstructor
*/  
      
      public function testCalculateLength() {
	  $method = self::$reflection->getMethod('calculateLength');
	  $method->setAccessible(true);
	  $this->assertEquals($method->invoke(self::$christmasTree, 2), 1);
	 
       }
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::getWidth	
*	@depends testCalculateLength
*/

      public function testGetWidth(){
	    $method = self::$reflection->getMethod('getWidth');
	    $method->setAccessible(true);
	    $this->assertEquals($method->invoke(self::$christmasTree, 3), 3);
      }



}