<?php
/**
 * 	@package AsciiArt 
 * 	@author monaid
 * 	@version 0.1
 */
namespace monaid\AsciiArt;

class RawOutput  implements OutputInterface {
  
  const SPACE = NULL;
  const NEWLINE = NULL;
  
  /**
  * @param \SPlFixedArray $matrix the matrix defining the transparent picture
  * @return string $output the renderd picture
  * @throws \RuntimeException when Constants not defined in extended class
  */
  public function render(\SplFixedArray $matrix){
    $output = "";
    $class = get_called_class();
    if (! $class::SPACE || ! $class::NEWLINE ) throw new \RuntimeException('Constants Space and Newline Must definded for raw output');
    foreach($matrix->toArray() as $line){
	  $output .= $this->fillSpaces($line) . $class::NEWLINE;
    } 
    return $output;
  }
  /**
  * @param \SPlFixedArray $line one line if the transparent picture
  * @return string $output one renderd line 
  */ 
  private function fillSpaces(\SplFixedArray $line){
   $class = get_called_class();
   $output = "";
   foreach($line->toArray() as $char) {
      $output .= ($char) ? $char : $class::SPACE;
   }
   return $output;
  }
  

  


}