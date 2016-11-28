<?php

	require("./TSPant.php");
	require("./city.php");

	class TSPsystem{
		private $matrixAdj;
		private $listVille;//source est la première ville

		private $NbVille;

		private $tauxEvaporation;
		private $tauxFourmirs;

		private $tour;

		private $bestTrajet;//liste des ville du meilleur trajet
		private $bestScore;//score du meilleur trajet

		public function __construct($tauxEvaporation,$tauxFourmirs){
			$this->matrixAdj = array();
			$this->listVille = array();
			$this->villeSource = "NA";
			$this->tauxFourmirs = $tauxFourmirs;
			$this->tauxEvaporation = $tauxEvaporation;
			$this->NbVille = 0;
			$this->tour = 0;
		}

		public function setListVille($stringVilles){
			$list = explode(";",$stringVilles);
			foreach ($list as $ville) {
				$city = new City($ville,$this->tauxEvaporation);
				$this->listVille[] = $city;
				$this->NbVille++;
			}
		}

		public function constuctMatrix(){
			for($i=0, $i < $this->NbVille; $i++){
				for ($j=0; $j < ; $j++) {
					$matrixAdj[$i][$j] = 0;
				}
			}
		}

		public function rechercheVoisin($source){

		}

		//déplace les fourmis dans la liste de stockage du nouveau noeud
		public function deplacerLesFourmis(){
			for($i=1; $i < count($this->listVille) ; $i++) {//utilise les indices pour acces rapide au tableau
				$listVoisins = $this->rechercheVoisin($i);
				foreach ($this->listVille[$i]->antList as $ant) {
					$listDest = $ant->villeEligible($listVoisins);//traiter les cas liste vide
					if(!isset($listDest) || empty($listDest)){
						if($ant->getNombreVilleVisite() == $NbVille){//cas elle as tout visité
							//retour à la case départ
							$ant->addCout($this->matrixAdj[$i][$villeDest]);
							$this->listVille[0]->stockage = clone $ant;
						}
						else{//cas elle est bloqué
							var_dump($ant);
							var_dump("error");
						}
					}
					else{//il y as des villes à visité
						$villeDest = $ant->chooseDest($listDest);
						$ant->visite($villeDest,$this->matrixAdj[$i][$villeDest]);
						$villeDest->stockage[] = clone $ant;
						$villeDest->incrPheromone(1);
					}
				}
			}
		}

		//chech la liste de stockage de la source pour voir les résultats.
		public function recupResultats(){
			foreach ($this->listVille[0]->stockage as $ant) {
				if($ant->getScore() < $this->bestScore){
					$this->bestTrajet = clone $ant->getTrajet();
					$this->bestScore = $ant->getScore;
				}
			}
			$this->listVille[0]->stockage = new array();
		}

		//vide la liste active swap la liste de stokage dans la liste active
		public function transmuterLesListes(){
			foreach ($this->listVille as $ville) {
				if(!empty($ville->antList)){
					$ville->antList = new array();
				}
				if( !empty($ville->stockage)){
					$ville->antList = array_merge($ville->antList,$ville->stockage);
					$ville->stockage = new array();
				}
			}
		}

		//ajoute des nouvelles fourmis au système
		public function reinject(){
			$listVoisins = $this->rechercheVoisin($this->villeSource);
			$listDest = $ant->villeEligible($listVoisins);//traiter les cas liste vide
			$villeDest = $ant->chooseDest($listDest);
			$ant->visite($villeDest,$this->matrixAdj[0][$villeDest]);
			$villeDest->stockage[] = new TSPant(0);
			$villeDest->incrPheromone(1);
		}

		//fonction d'évaporation
		public function evaporate(){

		}

		//effectue la phase de mouvement
		public function move(){
			$this->deplacerLesFourmis();
			$this->recupResultats();
			$this->transmuterLesListes();
		}

		public function run(){
			if($tour==0){
				$this->reinject();
			}
			else{
				$this->move();
				$this->reinject();
				$this->evaporate();
			}
			$this->tour++;
		}

		public function multipleRun($val){
			for($i=0;$i<$val;$i++){
				$this->run();
			}
		}
	}

?>