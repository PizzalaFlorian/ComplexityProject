<?php

class TSPant{
	private $trajet;
	private $source;
	private $score;
	private $nombreVilleVisité;

	public function __construct($source){
		$this->trajet = array();
		$this->trajet[$source] = true;
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
		$r = rand(1,100);
		$stack = 0;
		$pMax = 0;
		$seuil = array();
		foreach ($listVille as $v) {
			$pMax += $v->getPheromone();
		}
		if($pMax == 0){
			$r = rand(0,count($listVille)-1);
			return $listVille[$r]->number;//indice dans le tableau général
		}
		foreach ($listVille as $v) {
			$stack += $v->getPheromone();
			$alpha = ($stack * 100)/$pMax;
			$seuil[] = $alpha;
		}
		for ($i=0; $i < count($listVille) ; $i++) { 
			if($r < $seuil[$i]){
				return $listVille[$i]->number;//indice dans le tableau général
			}
		}
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