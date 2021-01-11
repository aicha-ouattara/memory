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
		private $grid;		// Sauvegarde des cartes
		private $nb_cards;	// Nombre de cartes
		private $turn;  	// Sauvegarde du tour
		private $beginTime; // debut chrono
		private $time;		// Temps écoulé
		private $score;		// Score
		private $date; 		// Sauvegarde datetime début de partie
		private $mode;		// Mode de jeu INVITE / CHELEM
		private $level;		// Niveau de jeu

		function __construct($nb_paires = 3, $mode)
		{
			// Enregistrement du mode
			$this->mode = $mode;
			// Enregistrement du Niveau
			$this->level = $nb_paires;
			// Création de la grille
			$this->grid = $this->createGrid($nb_paires);
			// Sauvegarde du nombre de cartes dans le jeu
			$this->nb_cards = $nb_paires * 2;
			// Initialisation du nombre de tours
			$this->turn = 0;
			// Initialisation du Score
			$this->score = 0;
			// Initialisation du chrono
			$this->beginTime = Null;
			// Sauvegarde DateTime de création de la partie
			$this->date = new DateTime();

		}

		public function createGrid($nb_paires)
		{
			// Liste de toutes les types possibles de cartes
			$liste_paires = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];

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
			// retour de la grille
			return $memory;
		}

		public function beginGame()
		{
			$this->beginTime = microtime(true);
		}

		public function getGrid()
		{
			return $this->grid;
		}

		public function getTime()
		{
			$now = microtime(true);
			$this->time = $now - $this->beginTime;
			return $this->time;
		}

		public function getTurn()
		{
			return $this->turn;
		}

		public function getScore()
		{
			return $this->score;
		}

		public function getMode()
		{
			return $this->mode;
		}

		public function getLevel()
		{
			return $this->level;
		}

		public function win()
		{
			$this->score += (100 / $this->getTime());
		}

		public function lose()
		{
			//$this->score-= $this->turn / $this->getTime();
		}

		public function printMemory()
		{
			foreach ($this->grid as $key => $card) {
				if ($card->flip && $card->validated) {
					echo "<button class='btn btn-primary ".$card->value."' name='card' type='submit' value=".$key.' disabled'."></button>";
				}
				elseif ($card->flip && !$card->validated) {
					echo "<button class='btn btn-primary ".$card->value."' name='card' type='submit' value=".$key."></button>";
				}
				else {
					echo "<button class='btn btn-primary hidden' name='card' type='submit' value=".$key."></button>";
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

		//Recherche le nombre de cartes validées
		public function validatedCards()
		{
			$nb_of_cards = 0;
			foreach ($this->grid as $key => $card) {
				if ($card->validated == true){
					$nb_of_cards++;
				}
			}
			return $nb_of_cards;
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

		public function updateGrid($card_number)
		{
			// Vérifie les cartes actives et retournées
			$positions = $this->flippedCards();

			if (count($positions) == 2) {
				// Si oui vérifier leur correspondance
				$correspond = $this->checkFlippedCards($positions);
				// Si elles correspondent les désactiver
				if ($correspond) {
					$this->win();
					$this->grid[$positions[0]]->validate();
					$this->grid[$positions[1]]->validate();
				}
				// Sinon les retourner
				else {
					$this->lose();
					$this->grid[$positions[0]]->flip();
					$this->grid[$positions[1]]->flip();
				}
				// Et on retourne la nouvelle carte si cachée
				if ($this->grid[$card_number]->flip == false) {
					$this->grid[$card_number]->flip();
				}
			}

			// Si une seule carte active
			elseif (count($positions) == 1) {
				// Et on retourne la nouvelle carte si cachée
				if ($this->grid[$card_number]->flip == false) {
					$this->grid[$card_number]->flip();
				}
				// On ajoute la carte retournée à la liste des positions
				if ($card_number != $positions[0]) {
					$positions[] = $card_number;
					// On vérifie leur correspondance
					$correspond = $this->checkFlippedCards($positions);
					// Si elles correspondent les désactiver
					if ($correspond) {
						$this->win();
						$this->grid[$positions[0]]->validate();
						$this->grid[$positions[1]]->validate();
					}
					else {
						$this->lose();
					}
				}


			}
			// Sinon on retourne juste la nouvelle carte
			else {
				if ($this->grid[$card_number]->flip == false) {
					$this->lose();
					$this->grid[$card_number]->flip();
				}
			}
		}

		public function checkGameOver()
		{
			// Comptage du nombre de cartes validées
			$validatedCards = $this->validatedCards();
			// Vérification si partie terminée
			if ($validatedCards == $this->nb_cards) {
				return true;
			}else {
				return false;
			}
		}

		public function update($card_number)
		{
			if ($this->grid[$card_number]->flip == false) {
				// Incrémentation du nombre de tours
				$this->turn++;
			}

			// Mise à jour de la grille
			$this->updateGrid($card_number);

			// Vérif si partie terminée
			return $this->checkGameOver();


		}
	}



 ?>
