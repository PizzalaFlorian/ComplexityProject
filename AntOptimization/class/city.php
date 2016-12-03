<?php
	
class City{
	private $name;
	public $number;
	public $x;
	public $y;
	
	public function __construct($name,$number,$maxDim){
		$this->name = $name;
		$this->number = $number;
		$this->x = rand(10,$maxDim-10);
		$this->y = rand(10,$maxDim-10);
	}

	public function getName(){
		return $this->name;
	}
}

?>