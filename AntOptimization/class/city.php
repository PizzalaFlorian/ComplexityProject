<?php
	
class City{
	private $name;
	private $pheromone;
	private $tauxEvaporation;
	public $antList;//liste des fourmis éligible au départ
	public $stockage;//liste de stockage

	public function __construct($name,$tauxEvaporation){
		$this->name = $name;
		$this->pheromone = 0;
		$this->tauxEvaporation = $tauxEvaporation;
		$this->antList = array();
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

	public function evaporate(){

	}
}

?>