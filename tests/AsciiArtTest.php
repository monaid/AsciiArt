<?php


use \PHPUnit\Framework\TestCase;
use \monaid\AsciiArt;

class AsciiArtTest extends PHPUnit_Framework_TestCase {

/**
*	@backupStaticAttributes enabled
*/ 
  
      protected static $ascii;
  
      public static function setUpBeforeClass(){
	  self::$ascii = new AsciiArt\AsciiArt();
      }
  
/**
* 	@covers \monaid\AsciiArt\AsciiArt::__construct
*/       
       
      public function testConstructor(){
	   $this->assertInstanceOf('\monaid\AsciiArt\AsciiArt', self::$ascii);
      } 
/**
*	
*       @covers \monaid\AsciiArt\AsciiArt::isSizeValid 
*	@depends testConstructor
*/
      public function testIsSizeValidToTrue() {
     
	    $this->assertTrue(self::$ascii->isSizeValid('Large'));
      }
/**
*	
*       @covers \monaid\AsciiArt\AsciiArt::isSizeValid 
*	@depends testIsSizeValidToTrue
*/
      public function testIsSizeValidToFalse() {
      
           $this->assertFalse(self::$ascii->isSizeValid('notKnown'));
      }
/**
*	@covers  \monaid\AsciiArt\AsciiArt::translateSizes
*	@depends testIsSizeValidToFalse
*/
      public function testTranslateSizesWithValidArg() {
      
	   $this->assertEquals(self::$ascii->translateSizes('Large'),[null, 11]);
     }   
/**
*	@covers  \monaid\AsciiArt\AsciiArt::translateSizes
*	@depends testTranslateSizesWithValidArg
*/
      public function testTranslateSizesWithNoValidArgToFalse() {

	    $this->assertFalse(self::$ascii->translateSizes('****!****'));	
      }
/**
*	@covers  \monaid\AsciiArt\AsciiArt::translateSizes
*	@depends testTranslateSizesWithNoValidArgToFalse
*/
      public function testTranslateSizesWithNoArg() {  
	  $reflection  = new ReflectionClass('\monaid\AsciiArt\AsciiArt');
	  $property =  $reflection->getProperty('availableSizes');
	  $property->setAccessible(true);
	  $availableSizes = $property->getValue(self::$ascii);
	  $this->assertContains(self::$ascii->translateSizes(), $availableSizes);
	    
      
      }

      
      
 }