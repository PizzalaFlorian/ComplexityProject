<?php

class TSPant{
	private $trajet;
	private $source;
	private $score;
	private $nombreVilleVisite;

	public function __construct($source){
		$this->trajet = array();
		$this->trajet[$source] = true;
		$this->source = $source;
		$this->score = 0;
		$this->nombreVilleVisite = 1;//On as visité la source
	}

	public function isFinVoyage($maxVille){
		if($maxVille >= $nombreVilleVisite){
			return true;
		}
		return false;
	}

	public function visite($nomVille,$cout){
		$this->score += $cout;
		$this->trajet[$nomVille] = true;
		$this->nombreVilleVisite++;
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

	//retourne l'index de la ville de destination en fonction du tableau de toutes les villes
	public function chooseDest($listVille){
		$possibilite = $this->filterVille($listVille);
		$resIndex = $this>choose($possibilite)
		return $resIndex;
	}

	public function filterVille($list){
		$res = array();
		foreach ($list as $v) {
			if( ! $this->aVisitee($v) ){
				$res[] = $v;
			}
		}
		return $v;
	}

	public function aVisitee($ville){
		foreach ($this->trajet as $villeVisitee) {
			if($villeVisitee == $ville->getName()){
				return true;
			}
		}
		return false;
	}

	//Choix probabiliste pondéré entre les villes
	public function choose($listVille){
		$max = 0;
		$tableRand = array();
		//préparation max et table des sommes.
		foreach ($listVille as $ville) {
			$max += $ville->getPheromone();
			$tableRand[] = $max;
		}
		//tirage entre 1 et SumMax et comparaison sur les sommes.
		$r = rand(1,$max);
		foreach ($tableRand as $key => $value) {
			if($r < $value){
				return $listVille[$key]->number;
			}
		}
		return $listVille[count($listVille)-1]->number;
	}

	public function nameCurrentCity($lv){
		return $this->trajet[$this->nombreVilleVisite - 1]);
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
		return $this->nombreVilleVisite;
	}
}

?>