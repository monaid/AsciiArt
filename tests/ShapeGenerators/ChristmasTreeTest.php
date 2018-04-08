<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;
use \monaid\AsciiArt\Matrix;
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
*	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::correctFields
*	@dataProvider 	christmasTreeCorrectFieldsProvider
*/
      public function testCorrrectFields($x, $y, $c){
      	  $matrix = new Matrix\Matrix($x, $y);
      	  $method = self::$reflection->getMethod('correctFields');
	  $method->setAccessible(true);
       	  $geo = self::$reflection->getProperty('geo');
 	  $geo->setAccessible(true);
    	  $geo->setValue(self::$christmasTree,["x" =>$x, "y" => $y]);
       	  $this->assertEquals($method->invoke(self::$christmasTree, $matrix)[0][$c], "+");

      }
/**
*	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasTree::generateLine
*	@dataProvider christmasTreeGenerateLineProvider
*	
*/   
    public function testGenerateLine($gx, $y, $l) {
    
	  $coloumn = new Matrix\MatrixColoumn($gx);
	  $geo = self::$reflection->getProperty('geo');
	  $geo->setAccessible(true);
	  $geo->setValue(self::$christmasTree,["x" => $gx, "y" => NULL]);
	  $method = self::$reflection->getMethod('generateLine');
	  $method->setAccessible(true);
	  
	  $this->assertEquals(
	      count(array_filter(
		  $method->invoke(self::$christmasTree, $y, $coloumn)->dump()->toArray(),
		    function($c){if ($c === "*") return $c;})), 
	      $l);
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
*	Correct Fileds dataProvider
*/
      public function christmasTreeCorrectFieldsProvider(){
      	    return [
		[7, 5, 3],
		[11, 7, 5],
		[19, 11, 9]
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
/**
*	data for generateLine
*/
        public function christmasTreeGenerateLineProvider() {
        
	  return [
	   [7, 1, 1],
	   [7, 2, 3],
	   [7, 3, 5],
	   [7, 4, 7],
	   [11, 1, 1],
	   [11, 2, 3],
	   [11, 3, 5],
	   [11, 4, 7],
	   [11, 5, 9],
	   [11, 6, 11],
	   [19, 1, 1],
	   [19, 2, 3],
	   [19, 3, 5],
	   [19, 4, 7],
	   [19, 5, 9],
	   [19, 6, 11],
	   [19, 7, 13],
	   [19, 8, 15],
	   [19, 9, 17],
	   [19, 10, 19],
	  ];
        
        
        
        }
}      