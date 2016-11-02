<?php

	class Path{
		private $lenght;//longeur du chemin
		private $nodes_pheromone[];//tableau des noeud du chemin, on y stoque la valeur du phéromone.
		private $nodes_fourmis[];
		private $function_evaporation;//functon d'évaporation

		public function __construct($lenght,$function_evaporation){
			$this->lenght = $lenght;
			$this->function_evaporation = $function_evaporation;
			$this->nodes_pheromone[] = new array();
			$this->nodes_fourmis[] = new array();
			for($j=0;$j<=$lenght;$j++){
				$this->nodes_pheromone[j]=0;
				$this->nodes_fourmis[j]=0;
			}
		}

		/* ---------------------------------------------------------------------------------------------
		*Met en place la valeur de pheromone a un indice du chemin
		*renvoie false si valeurs incorecte
		*renvoie true si réussite
		--------------------------------------------------------------------------------------------- */
		public function set_pheromone($indice_node,$value){
			if($indice_node < 0 || $indice_node >= $this->lenght){
				return false;
			}
			$this->nodes_pheromone[$indice_node] = $value;
			return true;
		}

		/* ---------------------------------------------------------------------------------------------
		*Incremente de "value" la valeur de pheromone a un indice du chemin
		*renvoie false si valeurs incorecte
		*renvoie true si réussite
		--------------------------------------------------------------------------------------------- */
		public function increment_pheromone($indice_node,$value){
			if($indice_node < 0 || $indice_node >= $this->lenght){
				return false;
			}
			$this->nodes_pheromone[$indice_node] += $value;
			return true;
		}

		public function fourmis_avancent(){
			$l = $this->lenght;
		}
	}


?>