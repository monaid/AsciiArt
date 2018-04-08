<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;
use \monaid\AsciiArt\Matrix;
class ResponsiveChristmasStarTest extends PHPUnit_Framework_TestCase {




/**
*	@backupStaticAttributes enabled
*/ 
  
      protected static $ResponsiveChristmasStar;
      protected static $reflection;
      protected static $mock;
       
  
      public static function setUpBeforeClass(){
	  self::$ResponsiveChristmasStar = new ShapeGenerators\ResponsiveChristmasStar();
	  self::$reflection = new \ReflectionClass ('\monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar');
	 
      }
      
      
      protected function setUp(){
	  
	    self::$mock =$this->getMockBuilder('\monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar')
	    ->setMethods(['normalize', 'getWidth'])
	    ->getMockForAbstractClass('\monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar');
           
      }
   
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar
*/       
       
      public function testConstructor(){
	  $this->assertInstanceOf('\monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar', self::$ResponsiveChristmasStar);
      } 
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar::getHeight
*	@depends testConstructor
*	@dataProvider ResponsiveChristmasStarSizesProvider
*/ 
	public function testGetHeight($x, $y)  {
	  $method = self::$reflection->getMethod('getHeight');
	  $method->setAccessible(true);
	  $this->assertEquals($method->invoke(self::$ResponsiveChristmasStar, $x), $y);
	
	}
      
/**
* 	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar::calculateLength
*	@depends testConstructor
*	@dataProvider ResponsiveChristmasStarPatternLengthProvider
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
* 	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar::getWidth	
*	
*	@dataProvider ResponsiveChristmasStarSizesProvider
*/

      public function testGetWidth($x, $y){
	    $method = self::$reflection->getMethod('getWidth');
	    $method->setAccessible(true);	    
	    $this->assertEquals($method->invoke(self::$ResponsiveChristmasStar, $y), $x);
      }
/**
*	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar::correctFields
*	@dataProvider 	responsiveChristmasStarCorrectFieldsProvider
*/
      public function testCorrrectFields($x, $y, $ex, $ey){
      	  $matrix = new Matrix\Matrix($x, $y);
      	  $method = self::$reflection->getMethod('correctFields');
	  $method->setAccessible(true);
       	  $geo = self::$reflection->getProperty('geo');
 	  $geo->setAccessible(true);
    	  $geo->setValue(self::$ResponsiveChristmasStar, ["x" => $x, "y" => $y]);
       	  $this->assertEquals($method->invoke(self::$ResponsiveChristmasStar, $matrix)[$ey][$ex], "+");
      }
  
  
/**
*	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar::generateLine
*	@dataProvider responsiveChristmasStarGenerateLineProvider
*	
*/   
    public function testGenerateLine($gx, $gy, $y, $l) {
    
	  $coloumn = new Matrix\MatrixColoumn($gx);
	  $geo = self::$reflection->getProperty('geo');
	  $geo->setAccessible(true);
	  $geo->setValue(self::$ResponsiveChristmasStar, ["x" => $gx, "y" => $gy]);
	  $method = self::$reflection->getMethod('generateLine');
	  $method->setAccessible(true);
	  
	  $this->assertEquals(
	      count(array_filter(
		  $method->invoke(self::$ResponsiveChristmasStar, $y, $coloumn)->dump()->toArray(),
		    function($c){if ($c === "*") return $c;})), 
	      $l);
    } 
      
/**
*	Provides data for testGetHeight and testGetWidth	
*	
*/
      public function ResponsiveChristmasStarSizesProvider() {
	    return [
		[7, 5],
		[11, 7],
		[17, 11],
	    ];
      }

/**
*	Provides data for calculateLength 
*	may use same provider for the getHeight/getWidth tests 
*	
*/     
       public function ResponsiveChristmasStarPatternLengthProvider() {
       /*
       *	sucks a little  bit  (geox, geoy, x, y) 
       */
       
       
	    return [
	      		[7, 5, 5, 3],
	      		[7, 5, 1, 4],
			[11, 7,  9, 4],
			[11, 7, 5, 5],
			[11, 7, 1, 6],
			[17, 11, 11, 5],
			[17, 11, 15, 6],
			[17, 11, 11, 7],
			[17, 11, 7, 8],
			[17, 11, 3, 9],
			
 	      ];
      }

 /**
*	correctFields data Provider
*	
*/
      
    public function responsiveChristmasStarCorrectFieldsProvider() {
    	    return [
		[7, 5, 3, 0],
		[7, 5, 3, 4],
		[7, 5, 0, 2],
		[7, 5, 6, 2],
		
		[11, 7, 5, 0],
		[11, 7, 5, 6],
		[11, 7, 0, 3],
		[11, 7, 10, 3],
		
		[17, 11, 8, 0],
		[17, 11, 8, 10],
		[17, 11, 0, 5],
		[17, 11, 16, 5],
	    ];
    
    
    }
/**
*	data for generateLine
*/
        public function responsiveChristmasStarGenerateLineProvider() {
        
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
	   [17, 11, 1, 0],
	   [17, 11, 2, 3],
	   [17, 11, 3, 7],
	   [17, 11, 4, 11],
	   [17, 11, 5, 15],
	   [17, 11, 6, 11],
	   [17, 11, 7, 7],
	   [17, 11, 8, 3],
	   [17, 11, 9, 0]
	  
	  
	  ];
        
        
        
        }
}
