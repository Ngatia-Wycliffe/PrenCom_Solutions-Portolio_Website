<?php 
//Template Class
//Creates a template/view Object
class Template{
	//Path to Template
	protected $template;
	//Variables passed in 
	protected $vars = array();

	public function __construct($template){
		$this->template = $template;
	}

	//Get Template variables
	public function __get($key){
		return $this->var[$key];
	}

	//Set Template variables
	public function __set($key, $value){
		$this->vars[$key] = $value;
	}

	//Convert Object to String
	public function __toString(){
		extract($this->vars);
		chdir(dirname($this->template));
		ob_start();

		include basename($this->template);

		return ob_get_clean();
	}
}

 ?>