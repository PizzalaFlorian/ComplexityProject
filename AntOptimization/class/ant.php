<?php
	class Ant{
		private $chose_direction_function;//STRING
		private $path; //INTEGER chemin choisie a l'aller
		//private $pheromone_rate;//INTEGER

		public function __construct($fct){
			$this->$chose_direction_function = $fct;
			$this->path = false;
		}

		public setPath($path_name){
			$this->path = $path_name;
		}

		/*----------------------------------------------------------------------------------------------------------------
		* fonction de déplacement d'une fourmis
		* in : tableau des direction possible avec la valeur du phéromone pour chaque direction.
		*
		* out : l'indice du tableau representant la direction choisie.
		*
		* appelle la fonction de déplacement choisie par rapport au comportement fournis par le contructeur de la fourmis.
		----------------------------------------------------------------------------------------------------------------- */
		public function move($array_choice){
			if(count($array_choice)==0){ //cas erreur, on envoie un tableau vide.
				return False;
			}
			if(count($array_choice)==1){ //cas d'un chemin, pas de choix donc pas besoin de faire le calcul. on avance.
				return 0;//indice du coup de la seule case du tableau.
			}
			if($this->$chose_direction_function == "random"){
				return $this->moveRandom($array_choice);
			}
			if($this->chose_direction_function == "choseMax"){
				return $this->moveToMax($array_choice);
			}
			if($this->chose_direction_function =="RandWithProba"){
				return $this->moveProba($array_choice);
			}
		}

		/*----------------------------------------------------------------------------------------------------------------
		*Fonction de déplacement aléatoire
		*Choisie au hasard un des chemin du tableau, met a jours le path de la fourmis pour son retour et remonte le résultat.
		 -----------------------------------------------------------------------------------------------------------------*/
		public function moveRandom($array_choice){
			$possibility = count($array_choice);
			$res = rand(0,$possibility - 1);
			$this->setPath($res);
			return $res;
		}
	}



?>