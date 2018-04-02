<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt\Output;

Interface OutputInterface {

  public function render(\monaid\AsciiArt\Matrix\Matrix $matrix);
 
}