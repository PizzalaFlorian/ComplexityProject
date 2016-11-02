<?php
	class PathNode{
		private $pheromone_rate;
		private $evaporation;//fonction d'évaporation choisie.
		private $ant_list[];
		private $ant_number;

		public function __construct($evaporation){
			$this->pheromone_rate = 0;
			$this->$ant_list = new array();
			$this->ant_number = 0;
			$this->evaporation = $evaporation;
		}

		public function getPheromone(){
			return $this->pheromone_rate;
		}

		public function setPheromone($value){
			$this->pheromone_rate = $value;
		}

		public function IncrPheromone($incr){
			$this->pheromone_rate += $incr;
		}

		public function getAntNumber(){
			return $this->ant_number;
		}

		/* --------------------------------------------------------------------------------------------------
		* Insère un ensemble de fourmis dans le node.
		-------------------------------------------------------------------------------------------------- */
		public function push($list_of_ants){
			$this->ant_list = array_merge($this->ant_list,$list_of_ants);
			$this->ant_number = count($this->list_of_ants);
		}

		/* --------------------------------------------------------------------------------------------------
		* Extrait et retourne les fourmis du noeud.
		-------------------------------------------------------------------------------------------------- */
		public function pop(){
			$res = new array();
			$res = array_merge($res,$this->ant_list);
			$this->ant_list = new array();
			$this->ant_number = 0;
			return $res;
		}

	}



?>