<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;
use \monaid\AsciiArt\Matrix;
class ChristmasStarTest extends PHPUnit_Framework_TestCase {




/**
*	@backupStaticAttributes enabled
*/ 
  
      protected static $christmasStar;
      protected static $reflection;
      protected static $mock;
       
  
      public static function setUpBeforeClass(){
	  self::$christmasStar = new ShapeGenerators\ChristmasStar();
	  self::$reflection = new \ReflectionClass ('\monaid\AsciiArt\ShapeGenerators\ChristmasStar');
	 
      }
      
      
      protected function setUp(){
	  
	    self::$mock =$this->getMockBuilder('\monaid\AsciiArt\ShapeGenerators\ChristmasStar')
	    ->setMethods(['normalize', 'getWidth'])
	    ->getMockForAbstractClass('\monaid\AsciiArt\ShapeGenerators\ChristmasStar');
           
      }
   
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasStar
*/       
       
      public function testConstructor(){
	  $this->assertInstanceOf('\monaid\AsciiArt\ShapeGenerators\ChristmasStar', self::$christmasStar);
      } 
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasStar::getHeight
*	@depends testConstructor
*	@dataProvider christmasStarSizesProvider
*/ 
	public function testGetHeight($x, $y)  {
	  $method = self::$reflection->getMethod('getHeight');
	  $method->setAccessible(true);
	  $this->assertEquals($method->invoke(self::$christmasStar, $x), $y);
	
	}
      
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasStar::calculateLength
*	@depends testConstructor
*	@dataProvider ChristmasStarPatternLengthProvider
*/  
      
       public function testCalculateLength($gx, $gy, $x, $y) {
 	  $method = self::$reflection->getMethod('calculateLength');
 	  $method->setAccessible(true);
 	  $geo = self::$reflection->getProperty('geo');
 	  $geo->setAccessible(true);
    	  $geo->setValue(self::$mock,["x" =>$gx, "y" => $gy]);
    	  $this->assertEquals($method->invoke(self::$mock, $y), $x);
        }
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasStar::getWidth	
*	
*	@dataProvider christmasStarSizesProvider
*/

      public function testGetWidth($x, $y){
	    $method = self::$reflection->getMethod('getWidth');
	    $method->setAccessible(true);	    
	    $this->assertEquals($method->invoke(self::$christmasStar, $y), $x);
      }
/**
*	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasStar::correctFields
*	@dataProvider 	christmasStarCorrectFieldsProvider
*/
      public function testCorrrectFields($x, $y, $ex, $ey){
      	  $matrix = new Matrix\Matrix($x, $y);
      	  $method = self::$reflection->getMethod('correctFields');
	  $method->setAccessible(true);
       	  $geo = self::$reflection->getProperty('geo');
 	  $geo->setAccessible(true);
    	  $geo->setValue(self::$christmasStar,["x" =>$x, "y" => $y]);
       	  $this->assertEquals($method->invoke(self::$christmasStar, $matrix)[$ey][$ex], "+");
      }
      
/**
*	@covers \monaid\AsciiArt\ShapeGenerators\ChristmasStar::generateLine
*	@dataProvider christmasStarGenerateLineProvider
*	
*/   
    public function testGenerateLine($gx, $gy, $y, $l) {
    
	  $coloumn = new Matrix\MatrixColoumn($gx);
	  $geo = self::$reflection->getProperty('geo');
	  $geo->setAccessible(true);
	  $geo->setValue(self::$christmasStar, ["x" => $gx, "y" => $gy]);
	  $method = self::$reflection->getMethod('generateLine');
	  $method->setAccessible(true);
	  
	  $this->assertEquals(
	      count(array_filter(
		  $method->invoke(self::$christmasStar, $y, $coloumn)->dump()->toArray(),
		    function($c){if ($c === "*") return $c;})), 
	      $l);
    }
           
/**
*	Provides data for testGetHeight and testGetWidth	
*	
*/
      public function christmasStarSizesProvider() {
	    return [
		[7, 5],
		[11, 7],
		[19, 11],
	    ];
      }

/**
*	Provides data for calculateLength 
*	may use same provider for the getHeight/getWidth tests 
*	
*/     
       public function christmasStarPatternLengthProvider() {
       /*
       *	sucks a little  bit  (geox, geoy, x, y) 
       */
       
       
	    return [
	      		[7, 5, 5, 3],
	      		[7, 5, 1, 4],
			[11, 7,  9, 4],
			[11, 7, 5, 5],
			[11, 7, 1, 6],
			[19, 11, 13, 5],
			[19, 11, 17, 6],
			[19, 11, 13, 7],
			[19, 11, 9, 8],
			[19, 11, 5, 9],
			[19, 11, 1, 10]
 	      ];
      }
/**
*	correctFields data Provider
*	
*/
      
    public function christmasStarCorrectFieldsProvider() {
    	    return [
		[7, 5, 3, 0],
		[7, 5, 3, 4],
		[7, 5, 0, 2],
		[7, 5, 6, 2],
		
		[11, 7, 5, 0],
		[11, 7, 5, 6],
		[11, 7, 0, 3],
		[11, 7, 10, 3],
		
		[19, 11, 9, 0],
		[19, 11, 9, 10],
		[19, 11, 0, 5],
		[19, 11, 18, 5],
	    ];
    
    
    }
/**
*	data for generateLine
*/
        public function christmasStarGenerateLineProvider() {
        
	  return [
	   [7, 5, 1, 1],
	   [7, 5, 2, 5],
	   [7, 5, 3, 1],
	   [7, 5, 4, 0],
	   [11, 7, 1, 1],
	   [11, 7, 2, 5],
	   [11, 7, 3, 9],
	   [11, 7, 4, 5],
	   [11, 7, 9, 0],
	   [19, 11, 1, 1],
	   [19, 11, 2, 5],
	   [19, 11, 3, 9],
	   [19, 11, 4, 13],
	   [19, 11, 5, 17],
	   [19, 11, 6, 13],
	   [19, 11, 7, 9],
	   [19, 11, 8, 5],
	   [19, 11, 9, 1],
	   [19, 11, 11,0 ]
	  
	  ];
        
        
        
        }
}
