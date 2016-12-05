<?php

class TSPant{
	private $trajet;
	private $source;
	private $score;
	private $nombreVilleVisite;

	public function __construct($source){
		$this->trajet = array();
		$this->trajet[0] = $source;
		$this->source = $source;
		$this->score = 0;
		$this->nombreVilleVisite = 1;//On as visité la source
	}

	public function isFinVoyage($maxVille){
		if(($this->nombreVilleVisite ) == $maxVille){
			//var_dump('maxVille');
			//var_dump($maxVille);
			return true;
		}
		return false;
	}

	public function visite($nomVille,$cout){
		//var_dump('je me déplace à '.$nomVille);
		$this->score += $cout;
		$this->trajet[] = $nomVille;
		$this->nombreVilleVisite++;
	}

	//retourne l'index de la ville de destination en fonction du tableau de toutes les villes
	public function chooseDest($listVille,$matrix,$trip){
		//var_dump('choose dest');
		$possibilite = $this->filterVille($listVille);
		//var_dump($possibilite);
		$current = $this->getIndexCurrentCity($listVille);
		$resIndex = $this->choose($current,$possibilite,$matrix,$trip);
		//var_dump($resIndex);
		return $resIndex;
	}

	public function filterVille($list){
		$res = array();
		foreach ($list as $v) {
			if( ! $this->aVisitee($v) ){
				$res[] = $v;
			}
		}
		return $res;
	}

	public function aVisitee($ville){
		foreach ($this->trajet as $villeVisitee) {
			if($villeVisitee == $ville->getName()){
				return true;
			}
		}
		return false;
	}

	public function getIndexCurrentCity($listVille){
		$name = $this->nameCurrentCity();
		if(!is_string($name)){
				return $name->number;
			}
			foreach ($listVille as $v) {
				if($v->getName() == $name){
					return $v->number;
				}
			}
	}

	//Choix probabiliste pondéré entre les villes
	public function choose($current,$listVille,$matrix,$trip){
		$max = 0;
		$tableRand = array();

		//préparation max et table des sommes.
		foreach ($listVille as $ville) {
			//var_dump($ville);
			$max += $matrix[$current][$ville->number];
			if($max == 0){
				$max = 1;
			}
			$tableRand[] = $max;
		}
		//tirage entre 1 et SumMax et comparaison sur les sommes.
		if($max > 0 && $trip > 0){
			//var_dump('choix pondéré');
			$r = rand(1,$max - 1);//max - 1 car on ajoute un float entre 0 et 1 ensuite et on veux éviter de faire une sortie de tableau
			$r += lcg_value();//permet de simuler un rand sur un float
			foreach ($tableRand as $key => $value) {
				if($r < $value){
					return $listVille[$key]->number;
				}
			}
			return $listVille[count($listVille)-1]->number;
		}
		if($trip == 0 || $max == 0){
			//var_dump('choix random');
			$r = rand(0,count($listVille)-1);
			//var_dump($r);
			//var_dump($listVille[$r]);
			//var_dump($listVille[$r]);
			return $listVille[$r]->number;
		}
		
	}

	public function nameCurrentCity(){
		if($this->nombreVilleVisite == 1){
			return $this->source;
		}
		// var_dump($this->trajet[0]);
		// var_dump($this->nombreVilleVisite);
		$res = $this->trajet[$this->nombreVilleVisite - 1];
		//var_dump($res);
		return $res;
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