<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;

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



}
