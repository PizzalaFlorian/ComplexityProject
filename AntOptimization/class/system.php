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
	}

?>