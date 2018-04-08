<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt\ShapeGenerators;
use  \monaid\AsciiArt\Matrix;

class CalcShapeGeneratorTest extends PHPUnit_Framework_TestCase {

    /*
    protected static $offestTop;
    protected static $offestBottom;
    protected static $cache;
    */
    protected static $reflection;
    protected static $mock;
     
    
	
    public static function setUpBeforeClass(){
 	  self::$reflection = new \ReflectionClass ('\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator');
 	  
	  
      }
      protected function setUp(){
	  self::$mock =  $this->getMockBuilder('\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator')
 	    ->setMethods(['normalize', 'generateLine', 'correctFields'])
	    ->getMockForAbstractClass('\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator');
       }
/**
*   @dataProvider CompileDataProvider
*   @covers 	\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator::compile
*/
    public function CompileReturnsMatrix($x, $y){
	  $method = self::$reflection->getMethod('compile');
	  var_dump($method->invoke(self::$mock, $x, $y));
          $this->assertInstanceOf('\monaid\AsciiArt\Matrix\Matrix', $method->invoke(self::$mock, $x, $y));
    }
   
/**
*   @dataProvider CompileDataProvider
*   @covers 	\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator::compile
*/    
    public function  testCompileReturnsCorrectMatrixLength($x, $y){
    
 	  self::$mock->method('normalize')->will($this->returnValue([$x, $y]));
 	  self::$mock->method('generateLine')->will($this->returnValue(new Matrix\MatrixColoumn($x)));
 	  self::$mock->method('correctFields')->will($this->returnValue(new Matrix\Matrix($x, $y)));
 
 	  $method = self::$reflection->getMethod('compile');
  	  $this->assertEquals($method->invoke(self::$mock, NULL, $y)->dump()->count(), $y);

    }
    
/**
*   @dataProvider CompileDataProvider
*   @covers 	\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator::compile
*/    
        public function  testCompileReturnsCorrectElements($x, $y){
       	  self::$mock->method('normalize')->will($this->returnValue([$x, $y]));
       	  self::$mock->method('generateLine')->will($this->returnValue(new Matrix\MatrixColoumn($x)));
       	  self::$mock->method('correctFields')->will($this->returnValue(new Matrix\Matrix($x, $y)));
       	  
 	  $method = self::$reflection->getMethod('compile');
 	  $this->assertInstanceOf('\monaid\AsciiArt\Matrix\Matrix', $method->invoke(self::$mock, NULL, $y));
    }
    
/**
*   @dataProvider CompileDataProvider
*   @covers 	\monaid\AsciiArt\ShapeGenerators\CalcShapeGenerator::compile
*/    
        public function  testCompileReturnsCorrectElementsLength($x, $y){
     	  self::$mock->method('normalize')->will($this->returnValue([$x, $y]));
     	  self::$mock->method('generateLine')->will($this->returnValue(new Matrix\MatrixColoumn($x)));
       	  self::$mock->method('correctFields')->will($this->returnValue(new Matrix\Matrix($x, $y)));
 	  $method = self::$reflection->getMethod('compile');
          $this->assertEquals($method->invoke(self::$mock, NULL, $y)[0]->dump()->count(), $x);
    }   
    
/**
*	may useless ?
*/    
     public function CompileDataProvider(){
	  return [
	     [7, 5],
	     [11, 7],
	     [19, 11],
	     [17, 11]
	     
     
	  ];
     }	
    
}