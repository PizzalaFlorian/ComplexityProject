<?php

	require('pathNode.php');

	class Path{
		private $lenght;//longeur du chemin
		private $list_node[];//liste des noeud du chemin séparer d'une distance de 1;

		public function __construct($lenght){
			$this->lenght = $lenght;
			$this->list_node = new array();
			for($j=0;$j<$lenght;$j++){
				$this->list_node[j] = new PathNode();
			}
		}
	}


?>