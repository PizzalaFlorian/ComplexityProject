<?php

	require("./TSPant.php");
	require("./city.php");

	class TSPsystem{
		private $matrixAdj;
		private $listVille;
		private $NbVille;
		private $tauxEvaporation;
		private $tauxFourmirs;
		private $tour;

		public function __construct($tauxEvaporation,$tauxFourmirs){
			$this->matrixAdj = $matrixAdj;
			$this->listVille = $listVille;
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
		//déplace les fourmis dans la liste de stockage du nouveau noeud
		public function deplacerLesFourmis(){
			foreach ($this->listVille as $vile) {
				$listVoisins = $this->rechercheVoisin($ville);
				foreach ($ville->antList as $ant) {
					$listDest = $ant->villeEligible($listVoisins);
					$villeDest = $ant->chooseDest($listDest);
				}
			}
		}

		//vide la liste active swap la liste de stokage dans la liste active
		public function transmuterLesListes(){

		}

		//ajoute des nouvelles fourmis au système
		public function reinject(){

		}

		//fonction d'évaporation
		public function evaporate(){

		}

		//effectue la phase de mouvement
		public function move(){
			$this->deplacerLesFourmis();
			$this->transmuterLesListes();
		}

		public function run(){
			$this->move();
			$this->reinject();
			$this->evaporate();
		}

		public function multipleRun($val){
			for($i=0;$i<$val;$i++){
				$this->run();
			}
		}
	}

?>