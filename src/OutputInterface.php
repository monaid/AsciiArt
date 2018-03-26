<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;

Interface OutputInterface {

  public function render(\SplFixedArray $matrix);
 
}