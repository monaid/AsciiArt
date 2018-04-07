<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;

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
* 	@covers \monaid\AsciiArt\ShapeGenerators\ResponsiveChristmasStar::calculateLength
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



}
