<?php

	/**
	 *
	 */
	class Card
	{
		public $flip;
		public $value;
		public $src;
		public $validated;

		function __construct($value)
		{
			$this->flip = false;
			$this->value = $value;
			$this->validated = false;
			switch ($value) {
				case 'A':
					$this->src = 'A.jpg';
					break;
				case 'B':
					$this->src = 'B.jpg';
					break;
				case 'C':
					$this->src = 'C.jpg';
					break;
				case 'D':
					$this->src = 'D.jpg';
					break;
				case 'E':
					$this->src = 'E.jpg';
					break;
				case 'F':
					$this->src = 'F.jpg';
					break;
				case 'G':
					$this->src = 'G.jpg';
					break;
				case 'H':
					$this->src = 'H.jpg';
					break;
			}
		}

		public function flip()
		{
			if ($this->flip == false) {
				$this->flip = true;
			}else {
				$this->flip = false;
			}
		}

		public function validate()
		{
			$this->validated = true;
		}

	}

	/**
	 *
	 */
	class Memory
	{
		private $grid;	// Sauvegarde des cartes
		private $turn;  // Sauvegarde du tour
		private $begin; // Sauvegarde datetime début de partie



		function __construct($nb_paires = 4)
		{
			// Liste de toutes les types possibles de cartes
			$liste_paires = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

			// Choix aléatoire d'images en fonction du nombre de paires
			$selected_cards = array_rand($liste_paires, $nb_paires);
			// Remplissage de la grille
			for ($i=0; $i < $nb_paires; $i++) {
				//Ajout d'une carte tirée au sort
				$memory[] = new Card($liste_paires[$selected_cards[$i]]);
				// Ajout de sa paire (identique)
				$memory[] = new Card($liste_paires[$selected_cards[$i]]);
			}
			// Mélange de la grille (donc des paires)
			shuffle($memory);
			// Sauvegarde des cartes dans l'objet
			$this->grid = $memory;
		}

		public function printMemory()
		{
			foreach ($this->grid as $key => $card) {
				if ($card->flip && $card->validated) {
					echo "<button class='btn btn-primary' name='card' type='submit' value=".$key.' disabled'.">".$card->value."</button>";
				}
				elseif ($card->flip && !$card->validated) {
					echo "<button class='btn btn-primary' name='card' type='submit' value=".$key.">".$card->value."</button>";
				}
				else {
					echo "<button class='btn btn-primary' name='card' type='submit' value=".$key.">X</button>";
				}
			}
		}

		// Retourne une carte
		public function flipCard($card_number)
		{
			$this->grid[$card_number]->flip();
		}

		// Recherche les cartes retournées mais pas encore validées
		// Puis retourne leur position
		public function flippedCards()
		{
			$positions = [];
			foreach ($this->grid as $key => $card) {
				if ($card->flip && $card->validated == false){
					$positions[] = $key;
				}
			}
			return $positions;
		}

		// Vérifie si deux cartes correspondent
		public function checkFlippedCards($positions)
		{
			if ($this->grid[$positions[0]] == $this->grid[$positions[1]]) {
				return true;
			}else {
				return false;
			}
		}

		public function update($card_number)
		{

			// Vérifier si deux cartes déjà actives et retournées
			$positions = $this->flippedCards();
			if (count($positions) == 2) {
				// Si oui vérifier leur correspondance
				$correspond = $this->checkFlippedCards($positions);
				// Si elles correspondent les désactiver
				if ($correspond) {
					$this->grid[$positions[0]]->validate();
					$this->grid[$positions[1]]->validate();
				}
				// Sinon les retourner
				else {
					$this->grid[$positions[0]]->flip();
					$this->grid[$positions[1]]->flip();
				}
			}

			// On retourne la nouvelle carte
			$this->grid[$card_number]->flip();
			

		}
	}



 ?>
