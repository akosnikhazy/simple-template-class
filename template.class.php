<?php
//created by Ákos Nikházy
/*
  USAGE:
  in PHP:
  $template = new tenokate('templateFileName.html'); //you make the object for the template file
  
  //every line is one tag you want to replace. Given tag could have any copy in the file
  $template->collect('something'	,'to something');
  $template->collect('somethingElese','to something else');
  
  //templating happens
  echo $template->finishTemplate();
  
  in templateFileName.html template file:
  this is the text I will replace ::something:: and also ::somethingElse::. I still replace ::something::
*/

class template
{
	function __construct($_templateFile) 
	{
		$this->templateFile = $_templateFile;
	}
	
	private $replace		=	array();
	private $templateFile	=	'';
	
	//prefix and suffix of the tags. Whatever you want.
	private $prefixSuffix	= array('::','::');
	
	public function collect($name, $tData)
	{//this will collect the stuff you want to replace and their replacement in an array for strtr()
		$this->	replace[
					$this->prefixSuffix[0] . $name . $this->prefixSuffix[1]
				] = $tData;
	}
	
	public function finishTemplate()
	{//this is where templating happens with strtr fuction
		return trim(strtr(file_get_contents($this->templateFile),$this->replace));
	}
}
?>
