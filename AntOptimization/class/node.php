<?php

class Node{
		public $listAller;
		public $listRetour;
		public $pheromone;
		private $taux_evaporation;

		public function __construct($taux_evaporation){
			$this->listAller = 0;
			$this->listRetour = 0;
			$this->pheromone = 0;
			$this->taux_evaporation = $taux_evaporation;
		}

		public function getPheromone(){
			return $this->pheromone;
		}

		public function incrPheromone($val){
			$this->pheromone += $val;
		}

		public function setPheromone($val){
			$this->pheromone = $val;
		}

		public function getListAller(){
			return $this->$listAller;
		}

		public function getListRetour(){
			return $this->listRetour;
		}

		public function setListAller($list){
			$this->listAller = $list;
		}

		public function setListRetour($list){
			$this->listRetour = $list;
		}

		public function resetListAller(){
			$this->listAller = 0;
		}

		public function resetListRetour(){
			$this->listRetour = 0;
		}

		public function addAller($value){
			$this->listAller += $value;
		}

		public function addRetour($value){
			$this->listRetour += $value;
		}

		public function addph($value){
			$this->pheromone += $value;
		}

		public function evaporate(){
			if($this->pheromone > 0 ){
				$this->pheromone = $this->pheromone - $this->taux_evaporation;
				if($this->pheromone < 0){
					$this->pheromone = 0;
				}
			}
		}

		public function isAllerEmpty(){
			if($this->listAller == 0){
				return true;
			}
			return false;
		}

		public function isRetourEmpty(){
			if($this->listRetour == 0){
				return true;
			}
			return false;
		}
	}

?>