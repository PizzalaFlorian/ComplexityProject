<?php

	class Path{
		private $lenght;//longeur du chemin

		private $antListAller[];//liste des fourmis sur le chemin aller
		private $antListRetour[];//liste sur le chemin retour
		private $antListFood[];//liste qui sont en train de collecter la nouriture.

		private $dureeFood;//temps de collecte de la nourriture avant le retour

		private $pheromoneEntree;//taux pheromone en entrée.
		private $pheromoneSortie;//taux pheromone en sortie.

		public function __construct($lenght,$dureeFood){
			$this->lenght = $lenght;
			$this->dureeFood = $dureeFood;
			$this->antListAller = new array();
			$this->antListRetour = new array();
			$this->antListFood = new array();
			$this->pheromoneEntree = 0;
			$this->pheromoneSortie = 0;
		}

		/* ---------------------------------------------------------------------------------------------
		*Ajoute une fourmis dans le sens aller et met a jour le pheromone.
		--------------------------------------------------------------------------------------------- */
		public function addAntAller(){
			$this->addAntAller[]=$this->lenght;
			$this->pheromoneEntree++;
		}

		public function addAntRetour($key){
			$this->addAntRetour[]=$this->lenght;
			$this->pheromoneSortie++;
		}

		public function addAndFood($key){
			$this->antListFood[]=$this->dureeFood;
			$this->pheromoneSortie++;
		}

		public function RetourNid($key){
			$this->pheromoneEntree++;
			unset($this->antListRetour[$key]);
		}

		/* ---------------------------------------------------------------------------------------------
		* boucle principale de mouvement déplace les fourmis entre les buffer si besoin et gère l'incrément des pheromones
		*
		* retourne le nombre de fourmis qui retournent au nid.
		--------------------------------------------------------------------------------------------- */
		public function move(){
			$nbOut = 0;
			foreach ($antListAller as $key => $value) {
				$antListAller[$key]--;
				if($antListAller[$key] <= 0){//si la fourmis a eu le temps de traverser
					$this->addAndFood();//elle est sortit aller chercher de la nouriture
					unset($this->$antListAller[$key]);//la retirer du chemin aller.
				}
			}
			foreach ($antListFood as $key => $value) {
				$antListFood[$key]--;
				if($antListFood[$key] <= 0){//fourmis as fini de récupéré la nouriture.
					$this->addAntRetour();//elle revient au nid;
					unset($this->$antListFood[$key]);//la retirer de la source de nouriture.
				}
			}
			foreach ($antListRetour as $key => $value) {
				$antListRetour[$key]--;
				if($antListRetour[$key] <= 0){//fourmis as fini de récupéré la nouriture.
					RetourNid($key);
					$nbOut ++;
				}
			}
			return $nbOut;
		}

		/* ---------------------------------------------------------------------------------------------
		* Fonction d'évaporation
		--------------------------------------------------------------------------------------------- */
		public function evaporate(){

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