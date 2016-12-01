<?php

	require("TSPant.php");
	require("city.php");

	class TSPsystem{
		private $matrixAdj;
		public $listVille;//source est la première ville
		private $NbVille;

		private $tauxEvaporation;
		private $tauxFourmirs;
		private $maxDim;

		private $tour;
		private $listFourmis;

		private $bestTrajet;//liste des ville du meilleur trajet
		private $bestScore;//score du meilleur trajet

		public function __construct($stringVilles,$maxDim){
			$this->matrixAdj = array();
			$this->listVille = array();
			$this->listFourmis = array();

			$this->tauxFourmirs = 0;
			$this->tauxEvaporation = 0;

			$this->NbVille = 0;
			$this->tour = 0;
			$this->bestScore = 0;
			$this->bestTrajet = 0;

			$this->maxDim = $maxDim;

			$this->setListVille($stringVilles);
			$this->constuctMatrix();
		}

		public function setParam($tauxEvaporation,$tauxFourmirs){
			$this->tauxFourmirs = $tauxFourmirs;
			$this->tauxEvaporation = $tauxEvaporation;
			foreach ($this->listVille as $ville) {
				$ville->setEvap($tauxEvaporation);
			}
		}

		public function setListVille($stringVilles){
			$list = explode(";",$stringVilles);
			$count=0;
			foreach ($list as $ville) {
				if($ville!=""){
					$city = new City($ville,$count,$this->tauxEvaporation,$this->maxDim);
					$this->listVille[] = $city;
					$this->NbVille++;
					$count++;
				}
			}
		}

		public function constuctMatrix(){
			for($i=0; $i < $this->NbVille; $i++){
				$this->matrixAdj[$i][$i] = 0;
			}
			for($i=0; $i < $this->NbVille; $i++){
				for ($j=($i+1); $j < $this->NbVille ; $j++) {
					$r = intval(sqrt(pow($this->listVille[$i]->x - $this->listVille[$j]->x,2) + pow($this->listVille[$i]->y - $this->listVille[$j]->y,2)));
					$this->matrixAdj[$i][$j] = $r;
					$this->matrixAdj[$j][$i] = $r;
				}
			}
		}

		//déplace les fourmis dans la liste de stockage du nouveau noeud
		public function deplacerLesFourmis(){
			// for($i=1; $i < count($this->listVille) ; $i++) {//utilise les indices pour acces rapide au tableau
			// 	$listVoisins = $this->listVille;
			// 	foreach ($this->listVille[$i]->antList as $ant) {
			// 		$listDest = $ant->villeEligible($listVoisins);//traiter les cas liste vide
			// 		if(!isset($listDest) || empty($listDest)){
			// 			if($ant->getNombreVilleVisite() == $NbVille){//cas elle as tout visité
			// 				//retour à la case départ
			// 				$ant->addCout($this->matrixAdj[$i][0]);
			// 				$this->listVille[0]->stockage = $ant;
			// 			}
			// 			else{//cas elle est bloqué
			// 				var_dump($ant);
			// 				var_dump("error");
			// 			}
			// 		}
			// 		else{//il y as des villes à visité
			// 			$villeDest = $ant->chooseDest($i,$listDest);
			// 			$ant->visite($villeDest,$this->matrixAdj[$i][$villeDest]);
			// 			$villeDest->stockage[] = $ant;
			// 			$villeDest->incrPheromone(1);
			// 		}
			// 	}
			// }
		}

		//chech la liste de stockage de la source pour voir les résultats.
		public function recupResultats(){
			foreach ($this->listVille[0]->stockage as $ant) {
				if($ant->getScore() < $this->bestScore){
					$this->bestTrajet = $ant->getTrajet();
					$this->bestScore = $ant->getScore();
				}
			}
			$this->listVille[0]->stockage = array();
		}

		//vide la liste active swap la liste de stokage dans la liste active
		public function transmuterLesListes(){
			// foreach ($this->listVille as $ville) {
			// 	if(!empty($ville->antList)){
			// 		$ville->antList = array();
			// 	}
			// 	if( !empty($ville->stockage)){
			// 		$ville->antList = array_merge($ville->antList,$ville->stockage);
			// 		$ville->stockage = array();
			// 	}
			// }
		}

		//ajoute des nouvelles fourmis au système
		public function reinject(){
			// $listVoisins = $this->listVille;
			// for($i=0;$i<$this->tauxFourmirs;$i++){
			// 	$ant = new TSPant(0);
			// 	$villeDest = $ant->chooseDest(0,$listVoisins);
			// 	$ant->visite($villeDest,$this->matrixAdj[0][$villeDest]);
			// 	$this->listVille[$villeDest]->stockage[] = $ant;
			// 	$this->listVille[$villeDest]->incrPheromone(1);
			// }
		}

		//fonction d'évaporation
		public function evaporate(){
			foreach ($this->listVille as $ville) {
				$ville->evaporate();
			}
		}

		//effectue la phase de mouvement
		public function move(){
			$this->deplacerLesFourmis();
			$this->recupResultats();
			$this->transmuterLesListes();
		}

		public function run(){
			if($this->tour==0){
				$this->reinject();
			}
			else{
				$this->move();
				$this->reinject();
				$this->evaporate();
			}
			$this->tour++;
		}

		public function multipleRun($val){
			for($i=0;$i<$val;$i++){
				$this->run();
			}
		}

		public function doOneTrip(){
			$this->multipleRun($this->NbVille);
		}

		public function doNTrip($N){
			for ($i=0; $i < $N ; $i++) { 
				$this->doOneTrip();
			}
		}

		public function reset(){
			foreach ($this->listVille as $ville) {
				$ville->resetSimu();
			}
			$this->bestScore = 0;
			$this->bestTrajet = array();
			$this->listFourmis = array();
		}

		public function drawTableVille(){
			echo '<div>';
			echo '<table class="superTable">
					<tr>
						<td> Ville </td>
						<td> Pheromone </td>
					</tr>
			';
			foreach ($this->listVille as $ville) {
				echo '
					<tr>
						<td>'.$ville->getName().'</td>
						<td>'.$ville->getPheromone().'</td>
					</tr>';
			}
			echo '</table>';
			echo '<br/><br/>';
			echo '<table class="superTable">';
			echo '<tr>';
			echo '<td> </td>';
			for ($i=0; $i < $this->NbVille ; $i++) {
				echo '<td>'.$this->listVille[$i]->getName().'</td>';
			}
			echo '</tr>';
			for ($i=0; $i < $this->NbVille ; $i++) { 
				echo '<tr>';
				echo '<td>'.$this->listVille[$i]->getName().'</td>';
				for ($j=0; $j < $this->NbVille; $j++) { 
					if($j == $i){
						echo '<td>#</td>';
					}else{
						echo '<td>'.$this->matrixAdj[$i][$j].'</td>';
					}
				}
				echo '</tr>';
			}
			echo '</table>';
			echo '</div>';

		}

		public function drawResultat(){

		}

		public function draw()
		{
			echo '<div class="fb">';
				$this->drawTableVille();
				echo '<canvas id="myCanvas" width='.$this->maxDim.' height='.$this->maxDim.' style="width:'.$this->maxDim.'px;height:'.$this->maxDim.'px"></canvas>';
				$this->drawGraph();
			echo '</div>';
			$this->drawResultat();
		}

		public function drawGraph(){
			echo '<script>
			var canvas = document.getElementById("myCanvas");
			console.log(canvas);
			var canvasWidth = canvas.width;
			var canvasHeight = canvas.height;
			var ctx = canvas.getContext("2d");

			function city(x, y, ctx, lettre){
				ctx.imageSmoothingEnabled = false;
				ctx.beginPath();
				ctx.arc(x,y,10,0,2*Math.PI);
				ctx.fillStyle="black";
				ctx.fill();
				ctx.stroke();

				ctx.beginPath();
				ctx.font="20px Georgia";
				ctx.fillStyle="white";
				ctx.fillText(lettre,x-7,y+7);
				ctx.stroke();
			}';
			for ($i=0; $i < $this->NbVille; $i++) { 
				for ($j=$i+1; $j <$this->NbVille ; $j++) { 
					echo '	ctx.beginPath();
							ctx.moveTo('.$this->listVille[$i]->x.','.$this->listVille[$i]->y.');
							ctx.lineTo('.$this->listVille[$j]->x.','.$this->listVille[$j]->y.');
							ctx.stroke();';
				}
			}
			foreach ($this->listVille as $ville) {
				echo 'city('.$ville->x.','.$ville->y.',ctx,"'.$ville->getName().'");';
			}
			
			echo '</script>';
		}


	}

?>