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
	}

?>