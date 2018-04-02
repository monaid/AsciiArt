<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt\Output;

class RawOutput  implements OutputInterface {
  
  const SPACE = NULL;
  const NEWLINE = NULL;
  
  /**
  * @param  \monaid\AsciiArt\Matrix\Matrix $matrix the matrix defining the transparent picture
  * @return string $output the renderd picture
  * @throws \RuntimeException when Constants not defined in extended class
  */
  public function render(\monaid\AsciiArt\Matrix\Matrix $matrix){
    $output = "";
    $class = get_called_class();
    if (! $class::SPACE || ! $class::NEWLINE ) throw new \RuntimeException('Constants Space and Newline Must definded for raw output');
    foreach($matrix->dump()->toArray() as $line){
	  $output .= $this->fillSpaces($line) . $class::NEWLINE;
    } 
    return $output;
  }
  /**
  * @param \monaid\AsciiArt\Matrix\MatrixColoumn $line one line if the transparent picture
  * @return string $output one renderd line 
  */ 
  private function fillSpaces(\Monaid\AsciiArt\Matrix\MatrixColoumn $line){
      $class = get_called_class();
      $output = "";
      foreach($line->dump()->toArray() as $char) {
	  $output .= ($char) ? $char : $class::SPACE;
      }
      return $output;
  }
  

  


}