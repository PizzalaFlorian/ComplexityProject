<?php

class TSPant{
	private $trajet;
	private $source;
	private $score;
	private $nombreVilleVisité;

	public function __construct($source){
		$this->trajet = array();
		$this->trajet[$souce] = true;
		$this->source = $source;
		$this->score = 0;
		$this->nombreVilleVisité = 1;//On as visité la source
	}

	public function visite($nomVille,$cout){
		$this->score += $cout;
		$this->trajet[$nomVille] = true;
		$this->nombreVilleVisité++;
	}

	public function villeEligible($listVille){
		$listEligible = array();
		foreach ($listVille as $ville) {
			if(!isset($this->trajet[$ville])){
				$listEligible[] = $ville;
			}
		}
		return $listEligible;
	}

	public function chooseDest($source,$listVille){
		
	}

	public function addCout($val){
		$this->score += $val;
	}

	public function getScore(){
		return $this->score;
	}

	public function getTrajet(){
		return $this->trajet;
	}

	public function getNombreVilleVisite(){
		return $this->nombreVilleVisité;
	}
}

?>