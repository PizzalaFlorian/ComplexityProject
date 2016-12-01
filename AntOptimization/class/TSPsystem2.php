<?php

	require("TSPant.php");
	require("city.php");

	class TSPsystem{
		private $matrixAdj;
		public $listVille;//source est la première ville
		private $NbVille;
		private $source;

		private $tauxEvaporation;
		private $tauxFourmirs;
		private $maxDim;

		private $tour;
		private $tripNumber;
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
			$this->tripNumber = 0;
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
			$this->source = $this->listVille[0]->getName();
		}

		public function constuctMatrix(){
			$maxDist = 0;
			for($i=0; $i < $this->NbVille; $i++){
				$this->matrixAdj[$i][$i] = 0;
			}
			for($i=0; $i < $this->NbVille; $i++){
				for ($j=($i+1); $j < $this->NbVille ; $j++) {
					$r = intval(sqrt(pow($this->listVille[$i]->x - $this->listVille[$j]->x,2) + pow($this->listVille[$i]->y - $this->listVille[$j]->y,2)));
					$this->matrixAdj[$i][$j] = $r;
					$this->matrixAdj[$j][$i] = $r;
					$maxDist += $r;
				}
			}
			$this->bestScore = $maxDist*2;
		}

		//chech la liste de stockage de la source pour voir les résultats.
		public function recupResultats($ant){
			if($ant->getScore() < $this->bestScore && $ant->getScore() > 0){
				$this->bestTrajet = $ant->getTrajet();
				$this->bestScore = $ant->getScore();
			}
		}

		//ajoute des nouvelles fourmis au système
		public function reinject(){
			for ($i=0; $i < $this->tauxFourmirs; $i++) { 
				$this->listFourmis[] = new TSPant($this->source);
			}
		}

		//fonction d'évaporation
		public function evaporate(){
			foreach ($this->listVille as $ville) {
				$ville->evaporate();
			}
		}

		public function getIndexByName($name){
			if(!is_string($name)){
				$name = $name->getName();
			}
			foreach ($this->listVille as $v) {
				if($v->getName() == $name){
					return $v->number;
				}
			}
			var_dump("pas trouver nom :");
			var_dump($name);
		}

		//effectue la phase de mouvement
		public function move(){
			//var_dump('moove');
			$removeList = array();
			for ($i=0; $i < count($this->listFourmis); $i++) { 
				//var_dump($this->listFourmis);
				if($this->listFourmis[$i]->isFinVoyage($this->NbVille)){
					//var_dump('c est la fin pour moi');
					//effectue le retour à la ville de départ
					//var_dump('one last ride');
					$this->listFourmis[$i]->visite( $this->source , $this->matrixAdj[0][ $this->getIndexByName( $this->listFourmis[$i]->nameCurrentCity())]  );
					//Notifie qu'il faudra supprimer cette fourmis.
					$this->listVille[ 0 ]->incrPheromone(1);
					$removeList[] = $i;
				}
				else{
					//var_dump('je suis en route');
					//choisi la ville
					$destIndex = $this->listFourmis[$i]->chooseDest($this->listVille,$this->tripNumber);
					$destName = $this->listVille[ $destIndex ]->getName();
					//ajoute le trajet du coté de la fourmis
					$this->listFourmis[$i]->visite( $destName , $this->matrixAdj[$destIndex][ $this->getIndexByName( $this->listFourmis[$i]->nameCurrentCity())]  );
					//incrémente le phéromone pour notifié le passage dans la ville
					$this->listVille[ $destIndex ]->incrPheromone(1);
				}
			}

			//Nettoye les fourmis qui ont finis leurs trajets
			foreach ($removeList as $key => $value) {
				$this->recupResultats($this->listFourmis[$value]);
				array_splice($this->listFourmis, $value, 1);
				$this->tripNumber ++;
			}
		}

		public function run(){
			if($this->tour==0){
				$this->reinject();
			}
			$this->move();
			$this->reinject();
			$this->evaporate();
			$this->tour++;
		}

		public function multipleRun($val){
			for($i=0;$i<$val;$i++){
				$this->run();
			}
		}

		public function doOneTrip(){
			$this->multipleRun($this->NbVille+1);
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
			$this->bestScore = 10000000000000000000000000000000000000;
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

		public function drawResultat(){
			echo '<div>';
			echo 'Cout du meilleur trajet : '.$this->bestScore.'<br/>';
			if(!empty($this->bestTrajet)){
				echo 'Trajet : ';
				var_dump($this->bestTrajet);
				foreach ($this->bestTrajet as $key) {
					echo '['.$key.']';
				}
				
			}
			echo '</div>';
			var_dump($this->listFourmis);
		}


	}

?>