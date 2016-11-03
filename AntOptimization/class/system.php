<?php
	require('path.php');

	class System{
		private $taux_apparition_fourmis;
		private $path1;
		private $path2;
		private $tour;

		public function __construct($lenght_path1,$lenght_path1,$taux_apparition_fourmis,$taux_eveporation){
			$this->taux_apparition_fourmis = $taux_apparition_fourmis;
			$this->tour = 0 ;
			$this->path1 = new Path($lenght_path1,$taux_eveporation);
			$this->path2 = new Path($lenght_path2,$taux_eveporation);
		}

		/* -------------------------------------------------------------------------------------------------
		* Réalise un tour de la simulation, renvoie le nombre de fourmis revenue au nid.
		------------------------------------------------------------------------------------------------- */
		public function iterate(){
			$nbFourmisReturnP1 = $path1->iterate();
			$nbFourmisReturnP2 = $path2->iterate();
			$this->ReinjectAnts();
			return $nbFourmisReturnP1 + $nbFourmisReturnP2;
		}

		public function multipleIteration($numberOfIteration){
			$sumReturn
			for($j=0;$j<$numberOfIteration;$j++){
				$sumReturn += $this->iterate();
			}
			return $sumReturn;
		}
	}

?>