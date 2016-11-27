<?php
	require('path.php');

	class System{
		private $taux_apparition_fourmis;
		private $path1;
		private $path2;
		private $tour;

		public function __construct($lenght_path1,$lenght_path2,$taux_apparition_fourmis,$taux_eveporation){
			$this->taux_apparition_fourmis = $taux_apparition_fourmis;
			$this->tour = 0 ;
			if($lenght_path1<1){
				$lenght_path1 = 1;
			}
			if($lenght_path2<1){
				$lenght_path2 = 1;
			}
			$this->path1 = new Path($lenght_path1,$taux_eveporation);
			$this->path2 = new Path($lenght_path2,$taux_eveporation);
		}

		/* -------------------------------------------------------------------------------------------------
		* Réalise un tour de la simulation, renvoie le nombre de fourmis revenue au nid.
		------------------------------------------------------------------------------------------------- */
		public function iterate(){
			$nbFourmisReturnP1 = $this->path1->iterate();
			$nbFourmisReturnP2 = $this->path2->iterate();
			$this->ReinjectAnts();
			$this->tour++;
			return $nbFourmisReturnP1 + $nbFourmisReturnP2;
		}

		public function ReinjectAntsMax(){
			if($this->tour == 0) {
				for($i=0;$i<$this->taux_apparition_fourmis;$i++) {
					$r= rand ( 1 , 2 );
					if($r == 1){
						$this->path1->addToNode(0,1);
						$this->path1->addPheToNode(0,1);
					}
					else{
						$this->path2->addToNode(0,1);
						$this->path2->addPheToNode(0,1);
					}
				}
			}
			else {
				if($this->path1->getPheromoneEntree() > $this->path2->getPheromoneEntree()){
					$this->path1->addToNode(0,$this->taux_apparition_fourmis);
					$this->path1->addPheToNode(0,$this->taux_apparition_fourmis);
				}
				else if($this->path1->getPheromoneEntree() < $this->path2->getPheromoneEntree()){
					$this->path2->addToNode(0,$this->taux_apparition_fourmis);
					$this->path2->addPheToNode(0,$this->taux_apparition_fourmis);
				}
				else{
					for($i=0;$i<$this->taux_apparition_fourmis;$i++) {
						$r= rand ( 1 , 2 );
						if($r == 1){
							$this->path1->addToNode(0,1);
							$this->path1->addPheToNode(0,1);
						}
						else{
							$this->path2->addToNode(0,1);
							$this->path2->addPheToNode(0,1);
						}
					}
				}
			}
		}

		public function ReinjectAnts(){
			$p1 = $this->path1->getPheromoneEntree();
			$p2 = $this->path2->getPheromoneEntree();
			$seuil = 0;
			if(($p1 + $p2) != 0){
				$seuil = intval(($p1 * 100)/($p1 + $p2));
			}
			if($seuil == 0){
				$seuil = 50;
			}
			
			for($i=0;$i<$this->taux_apparition_fourmis;$i++) {
				$r = rand(1,100);
				if($r < $seuil){
					$this->path1->addToNode(0,1);
					$this->path1->addPheToNode(0,1);
				}
				else{
					$this->path2->addToNode(0,1);
					$this->path2->addPheToNode(0,1);
				}
			}

		}

		public function multipleIteration($numberOfIteration){
			$sumReturn = 0;
			for($j=0;$j<$numberOfIteration;$j++){
				$sumReturn += $this->iterate();
			}
			return $sumReturn;
		}

		public function drawFood(){
			$F1 = $this->path1->getFoodNode();
			//var_dump($F1->listAller);
			$F2 = $this->path2->getFoodNode();
			$sum = $F1->listAller + $F1->listRetour + $F2->listAller + $F2->listRetour;
			//var_dump($F2);
			echo "
			<div class='schemaCenter'>
			<div class='nid'>
			Nid
			</div>
			<div class='food'>
					<table style='border:1px solid grey;text-align:center;'>";
			echo "    	<tr>
							<td colspan='2'> Nourriture </td>
						</tr>
						<tr>
							<td>Fourmis :</td>
							<td>".$sum."</td> 
						</tr>
					</table></div></div>";
					
		}

		public function draw(){
			
			echo "<h4> Tour n° ".$this->tour."<br/></h4><hr><br/>";
			echo "Chemin 1<br/>";
			$this->path1->draw();
			echo "<br/>";
			$this->drawFood();
			echo "<br/>";
			echo "Chemin 2<br/>";
			$this->path2->draw();
		}
	}

?>