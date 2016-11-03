<?php

class Node{
		private $listAller[];
		private $listRetour[];
		private $pheromone;
		private $taux_evaporation;

		public function __construct($taux_evaporation){
			$this->listAller = new array();
			$this->listRetour = new array();
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
			$this->listAller = new array();
		}

		public function resetListRetour(){
			$this->listRetour = new array();
		}

		public function getNumberAntAller(){
			return count($this->listAller);
		}

		public function getNumberAntRetour(){
			return count($this->listRetour);
		}

		public function evaporate(){

		}

		public function isAllerEmpty(){
			if(count($this->listAller) == 0){
				return true;
			}
			return false;
		}

		public function isRetourEmpty(){
			if(count($this->listAller) == 0){
				return true;
			}
			return false;
		}
	}

?>