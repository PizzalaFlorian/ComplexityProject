<?php
	
class City{
	private $name;
	public $number;
	private $pheromone;
	private $tauxEvaporation;
	public $x;
	public $y;
	public $antList;//liste des fourmis éligible au départ
	public $stockage;//liste de stockage

	public function __construct($name,$number,$tauxEvaporation,$maxDim){
		$this->name = $name;
		$this->pheromone = 0;
		$this->number = $number;
		$this->tauxEvaporation = $tauxEvaporation;
		$this->x = rand(10,$maxDim-10);
		$this->y = rand(10,$maxDim-10);
		$this->antList = array();
		$this->stockage = array();
	}

	public function getName(){
		return $this->name;
	}

	public function incrPheromone($val){
		$this->pheromone += $val;
	}

	public function getPheromone(){
		return $this->pheromone;
	}

	public function ajouterFourmis($fourmis){
		$this->antList[] = $fourmis;
	}

	public function setEvap($val){
		$this->tauxEvaporation = $val;
	}

	public function resetSimu(){
		$this->pheromone = 0;
		$this->antList = array();
		$this->stockage = array();
	}

	public function evaporate(){

	}
}

?>