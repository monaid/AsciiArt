<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;

abstract class AsciiArtObject {

  /**
  *	@var array[string]integer available heights
  */
  protected $sizes = ['s' => 5, 'm' => 7, 'l'=> 11, 'large' => 11, 'medium' => 7, 'small' => 5];  
  
  /**
  *	@protected integer $linenumber actual y martix value 
  */
  protected $linenumber = 0; 
  
  /**
  *	
  */
  protected $actualsize = 0;
  
  /**
  *	@protected array[integer]integer each pattern got the own height ->   width association
  */
  protected $dimensions = [];
  
  /**
  *	@var array[integer]array already generated patterns per height 
  */
  private $cached = [];
  
  /**
  *	@return \SplFixedArray[\SplFixedArray[string]]	return a matrix as a list of fixed arrays
  */
  protected abstract function generateMatrix();
  
  /**
  *	@param string $size  the size you want to set
  *	@return self 
  *     @throws \InvalidArgumentException when size not valid
  */
  public function setSize($size){
  	$size = strtolower($size); // not to be case sensitive
	if (!isset($this->sizes[$size])) throw new \InvalidArgumentException('given size "' . $size .'" is not valid !');
	$this->actualsize =  $this->sizes[$size];
	if (! isset($this->cached[$this->actualsize])) $this->cached[$this->actualsize] = $this->generateMatrix();
	return $this;
  }
  /**
  *	@param integer $size  matrix with size requested
  *	@return   \SplFixedArray[\SplFixedArray[string]] | false 
  */
  public function getCachedMatrix($size){
	if ($this->cached[$size]) return $this->cached[$size];
	return false;
 }
 /**
  *	@param OutputInterface $output 
  *	@return self
  */
  public function setOutput(OutputInterface $output){
	$this->output  = $output;
	return $this;
  }
  /**
  *	@return string 
  *	@throws \RuntimeException when no Output is selected 
  *	
  */
  public function render(){
    if (!$this->actualsize)  $this->setSize([array_rand($this->sizes, 1)][0]);
    if (!$this->output) throw new \RuntimeException('you must choose an OutputInterface bevor render !');
    return $this->output->render($this->cached[$this->actualsize]);
   }
  


}