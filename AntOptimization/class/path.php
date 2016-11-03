<?php

	class Path{
		private $lenght;//longeur du chemin
		private $last;
		private $nodes[];
		private $Food;

		public function __construct($lenght,$taux_evaporation){
			$this->lenght = $lenght;
			$this->last = $lenght - 1;
			$this->Food = new Node($taux_evaporation);
			for($j=0;$j<$lenght;$j++){
				$nodes[] = new Node($taux_evaporation)
			}
		}
		/* ---------------------------------------------------------------------------------------------
		* Getter collection
		--------------------------------------------------------------------------------------------- */
		public function getPheromone($i){
			if($i < 0 || $i > $this->last){
				return flase;
			}
			return $this->nodes[$i]->getPheromone();
		}

		public function getPheromoneEntree(){
			return $this->getPheromone(0);
		}

		public function getNumberAllAnt(){
			$sum = 0;
			for($j=0;$j<=$this->last;$j++){
				$sum += $this->nodes[$j]->getNumberAnt($j);
			}
			return $sum;
		}

		public function getNumberAnt($i){
			return $this->nodes[$i]->getNumberAntAller() + $this->nodes[$i]->getNumberAntRetour();
		}

		public function getNumberAntAller($i){
			return $this->nodes[$i]->getNumberAntAller();
		}

		public function getNumberAntRetour($i){
			return $this->nodes[$i]->getNumberAntRetour();
		}
		/* ---------------------------------------------------------------------------------------------
		* boucle principale de mouvement déplace les fourmis entre les buffer si besoin et gère l'incrément des pheromones
		*
		* retourne le nombre de fourmis qui retournent au nid.
		--------------------------------------------------------------------------------------------- */
		public function move(){
			$nbOut = 0; //nombre de fourmis qui vont retourner au nid;

			for($j=$this->last ; $j>=0 ; $j--){ // 1 Avancer la liste aller
				if($j == $this->last){ // libère la fin et prépare le départ pour la liste de nouriture
					$Food->setListRetour($Food->getListAller());
					$Food->resetListAller();
					$Food->setListAller($nodes[$j]->getListAller())
					$nodes[$j]->resetListAller();
				}
				else{
					$nodes[$j + 1]->setListAller($nodes[$j]->getListAller());
					$nodes[$j]->resetListAller();
				}
			}

			for($j=0 ; $j<=$this->last;$j++){ // 2 Avancer la liste retour
				if($j == 0){
					$nbOut = $nodes[0]->getListRetour();
					$nodes[0]->resetListRetour();
				}
				else if($j == $this->last){
					$nodes[$j - 1]->setListRetour($nodes[$j]->getListRetour());
					$nodes[$j]->resetListRetour();
					$nodes[$j]->setListRetour($Food->getListRetour());
					$Food->resetListRetour();
				}
				else{
					$nodes[$j - 1]->setListRetour($nodes[$j]->getListRetour());
					$nodes[$j]->resetListRetour();
				}
			}

			return $nbOut; //renvoie le nombre de fourmis qui sortent.
		}

		/* ---------------------------------------------------------------------------------------------
		* Fonction d'évaporation
		--------------------------------------------------------------------------------------------- */
		public function evaporate(){
			foreach ($this->$nodes as $node) {
				$node->evaporate();
			}
		}

		/* ---------------------------------------------------------------------------------------------
		* Boucle principale
		* renvoie le nombre de fourmis qui retourne au nid.
		--------------------------------------------------------------------------------------------- */
		public function proceed(){
			$nbReturnNid = $this->move();
			$this->evaporate();
			return $nbReturnNid;
		}
	}


?>