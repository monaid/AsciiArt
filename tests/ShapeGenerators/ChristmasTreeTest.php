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
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree
*/       
       
      public function testConstructor(){
	   $this->assertInstanceOf('\monaid\AsciiArt\ShapeGenerators\ChristmasTree', self::$christmasTree);
      } 
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::getHeight
*	@depends testConstructor
*	@dataProvider christmasTreeSizesProvider
*/ 
	public function testGetHeight($x, $y)  {
	  $method = self::$reflection->getMethod('getHeight');
	  $method->setAccessible(true);
	  $this->assertEquals($method->invoke(self::$christmasTree, $x), $y);
	
	}
      
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::calculateLength
*	@depends testConstructor
*	@dataProvider ChristmasTreePatternLengthProvider
*/  
      
      public function testCalculateLength($x, $y) {
	  $method = self::$reflection->getMethod('calculateLength');
	  $method->setAccessible(true);
	  $this->assertEquals($method->invoke(self::$christmasTree, $y), $x);
	 
       }
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::getWidth	
*	@depends testCalculateLength
*	@dataProvider christmasTreeSizesProvider
*/

      public function testGetWidth($x, $y){
	    $method = self::$reflection->getMethod('getWidth');
	    $method->setAccessible(true);
	    $this->assertEquals($method->invoke(self::$christmasTree, $y), $x);
      }

/**
*	Dataproviders
*/
      
/**
*	Provides data for testGetHeight and testGetWidth	
*	
*/
      public function christmasTreeSizesProvider() {
	    return [
		[7, 5],
		[11, 7],
		[19, 11]
 	      ];
      }
      
/**
*	Provides data for calculateLength 
*	may use same provider for the getHeight/getWidth tests 
*	
*/     
       public function christmasTreePatternLengthProvider() {
	    return [
		[1, 2],
		[3, 3],
		[7, 5],
		[9, 6],
		[11, 7],
		[17, 10],
		[19, 11]
 	      ];
      }
      
}      