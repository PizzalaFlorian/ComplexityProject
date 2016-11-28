<?php
	require('node.php');

	class Path{
		private $lenght;//longeur du chemin
		private $last;
		private $nodes;//liste de noeud
		private $Food; //noeud seul

		public function __construct($lenght,$taux_evaporation){
			$this->lenght = $lenght;
			$this->last = $lenght - 1;
			$this->Food = new Node($taux_evaporation);
			$this->nodes = array();
			for($j=0;$j<$lenght;$j++){
				$this->nodes[] = new Node($taux_evaporation);
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

		public function getFoodNode(){
			return $this->Food;
		}

		public function addToNode($i,$value){
			$this->nodes[$i]->addAller($value);
		}
		public function addPheToNode($i,$value){
			$this->nodes[$i]->addph($value);
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
					$this->Food->listRetour = $this->Food->listAller;
					$this->Food->listAller = 0;
					$this->Food->listAller = $this->nodes[$j]->listAller;
					$this->nodes[$j]->listAller = 0;
				}
				else{
					if(!$this->nodes[$j]->isAllerEmpty()){
						$this->nodes[$j + 1]->listAller = $this->nodes[$j]->listAller;
						$this->nodes[$j + 1]->pheromone += $this->nodes[$j]->listAller;
						$this->nodes[$j]->listAller = 0;
					}
				}
			}

			for($j=0 ; $j<=$this->last;$j++){ // 2 Avancer la liste retour
				if($j == 0){
					$nbOut = $this->nodes[0]->listRetour;
					$this->nodes[0]->listRetour = 0;
				}
				else if($j == $this->last){
					$this->nodes[$j - 1]->listRetour = $this->nodes[$j]->listRetour;
					$this->nodes[$j - 1]->pheromone += $this->nodes[$j]->listRetour;
					$this->nodes[$j]->listRetour = 0;
					$this->nodes[$j]->listRetour = $this->Food->listRetour;
					$this->nodes[$j]->pheromone += $this->Food->listRetour;
					$this->Food->listRetour = 0;
				}
				else{
					if(!$this->nodes[$j]->isRetourEmpty()){
						$this->nodes[$j - 1]->listRetour = $this->nodes[$j]->listRetour;
						$this->nodes[$j - 1]->pheromone += $this->nodes[$j]->listRetour;
						$this->nodes[$j]->listRetour = 0;
					}
				}
			}

			return $nbOut; //renvoie le nombre de fourmis qui sortent.
		}

		/* ---------------------------------------------------------------------------------------------
		* Fonction d'évaporation
		--------------------------------------------------------------------------------------------- */
		public function evaporate(){
			foreach ($this->nodes as $node) {
				$node->evaporate();
			}
		}

		/* ---------------------------------------------------------------------------------------------
		* Boucle principale
		* renvoie le nombre de fourmis qui retourne au nid.
		--------------------------------------------------------------------------------------------- */
		public function iterate(){
			$nbReturnNid = $this->move();
			$this->evaporate();
			return $nbReturnNid;
		}
		/* ---------------------------------------------------------------------------------------------
		* Fonction d'affichage du chemin
		--------------------------------------------------------------------------------------------- */
		public function draw(){
			echo "<center> (longueur : ".$this->lenght.")<br/>
			<table class='path'><tr><td> Noeud : </td>";
			for($i=0; $i<$this->lenght;$i++){
				echo "<td>n° ".$i."</td>";
			}
			echo "</tr><tr><td> Fourmis Aller: </td>";
			foreach ($this->nodes as $n) {
				$sum = $n->listAller;
				echo "<td>".$sum."</td>";
			}
			echo "</tr><tr><td> Fourmis Retour: </td>";
			foreach ($this->nodes as $n) {
				$sum = $n->listRetour;
				echo "<td>".$sum."</td>";
			}
			echo "</tr><tr><td> Pheromone : </td>";
			foreach ($this->nodes as $n) {
				$sum = $n->pheromone;
				echo "<td>".$sum."</td>";
			}
			echo "</tr></table><center>";
		}
	}


?>