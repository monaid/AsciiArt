<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.2
 */
namespace monaid\AsciiArt\ShapeGenerators;


abstract class BaseShapeGenerator {

    abstract public    function compile($x, $y);
    

/** 
*   	@protected  Array[string => \monaid\AsciiArt\Matrix\Matrix] $cache
*      caching compiled matrix 
*/
    protected $cache;
/**
*   	@protected Array[string => integer] $geo
*/
    protected $geo;
    
/**
 *   	@param integer $x height
 *   	@param integer $y width
 *  	@return Array[integer, integer] $x, $y
 *	
 * 	after normalize $x and $y are given 
 *	validation checks must be done also in future
 */
    protected function normalize($x, $y){
    	if ($x ===  null && $y === null) throw new \monaid\AsciiArt\Exceptions\ShapeGeneratorException("can't compile zero sized martix");
	if ($x === null) $x = $this->getWidth($y);
	if ($y === null) $y = $this->getHeight($x);
	$this->geo = ["x" => $x, "y" => $y];
	return [$x, $y];
      }
    
    
}

