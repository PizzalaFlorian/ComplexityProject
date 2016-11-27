<?php

class TSPant{
	private $trajet;
	private $source;
	private $nombreVilleVisité;
	private $tour;

	public function __construct($source){
		$this->trajet = array();
		$this->trajet[$souce] = true;
		$this->source = $source;
		$this->nombreVilleVisité = 1;//On as visité la source
		$this->tour = 0;
	}

	public function visite($nomVille){
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

	public function getNombreVilleVisite(){
		return $this->nombreVilleVisité;
	}
}

?>