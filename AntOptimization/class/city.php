<?php
	
class City{
	private $name;
	public $number;
	//private $pheromone;
	//private $tauxEvaporation;
	public $x;
	public $y;
	
	public function __construct($name,$number,$maxDim){
		$this->name = $name;
		//$this->pheromone = 0;
		$this->number = $number;
		//$this->tauxEvaporation = $tauxEvaporation;
		$this->x = rand(10,$maxDim-10);
		$this->y = rand(10,$maxDim-10);
	}

	public function getName(){
		return $this->name;
	}

	public function setEvap($val){
		$this->tauxEvaporation = $val;
	}

	public function resetSimu(){
		$this->pheromone = 0;
	}

}

?>