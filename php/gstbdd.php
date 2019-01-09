<?php

	//
	// toute fonction retourne false (0) si il n'y a pas d'erreur
	// toute fonction retourne true (ou no erreur different de zero) en cas d'erreur
	//
	
	class clsSND																										// classe send JSON
	{
		public $mss;
		public $rtr;
	}
	
	class clsRCV																										// classe receive JSON
	{
		public $lgn;
		public $pwd;
	}
	
	class clsBDD
	{
		private $hote;
		private $base;
		private $user;
		private $pwrd;
		private $bdd;
		private $rsl;
		
		public  $clssnd;
		public  $clsrcv;

		public function __construct($hote, $base, $user, $pwrd)																// constructeur de la classe json
		{
			$this->rtr = -1;																								// reponse: code retour par defaut
			$this->mss = "Veuillez vous identifier ...";																	// reponse: message par defaut
			
			$this->hote = $hote;																							// remplie avec la saisie (form)
			$this->base = $base;																							// remplie avec la saisie (form)
			$this->user = $user;																							// remplie avec la saisie (form)
			$this->pwrd = $pwrd;	
			
			$this->clssnd = new clsSND();
			$this->clsrcv = new clsRCV();
		}

		function openBDD()
		{
			try
			{
				$this->bdd = new PDO("mysql: host=$this->hote;dbname=$this->base", $this->user, $this->pwrd);											// ouverture de la base (host bdd user password)
			}
			catch (PDOException $exc)
			{
				$this->clssnd->mss = $exc->getMessage();
				$this->clssnd->rtr = -1;
				return true;
			}
			$this->clssnd->mss = "Ouverture BDD ok";
			$this->clssnd->rtr = 0;
			return false;
		}

		function selectBDD($rqt)
		{
			$this->rsl = $this->bdd->query($rqt);																		// envoie la requete au gestionnaire de bdd (mysql)
			$this->rsl->setFetchMode(PDO::FETCH_ASSOC);																	// recupere physiquement les donnees (plus cache)
			return $this->rsl->fetch();
		}

		function suivantBDD($rqt)
		{
			return $this->rsl->fetch();
		}
		
		function closeBDD()
		{
			$bdd = null;
		}
	}

	//$clsbdd = new clsBDD('localhost', 'todo', 'todo', 'abcABC123$');													// creation instance classe json
	
?>
