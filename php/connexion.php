<?php

	class clsJSN																										// classe JSON
	{																													// *** les proprietes champ bdd ***
		private $clf;																									// clef
		private $lgn;																									// login
		private $pwd;																									// password
		private $drt;																									// droit
																														// *** les proprietes acces bdd ***
		private $bdd;																									// handle de la bdd
		private $rqt;																									// requete sql
		private $rsl;																									// resultat en memoire de la requete
		private $vlr;																									// valeur reel lu dans la base
																														// *** les propriete pour repondre ***
		public $mss;																									// message retour
		public $rtr;																									// code retour
																														// *** les methodes ***
		public function __construct($lgn, $pwd)																			// constructeur de la classe json
		{
			$this->rtr=-1;																								// reponse: code retour par defaut
			$this->mss="Veuillez vous identifier ...";																	// reponse: message par defaut
			
			$this->lgn = $lgn;																							// remplie avec la saisie (form)
			$this->pwd = $pwd;																							// remplie avec la saisie (form)
		}
		
		public function lectureBDD()																					// lecture de la bdd
		{
			try
			{
				$this->bdd = new PDO("mysql: host=localhost;dbname=todo", 'todo', 'abcABC123$');						// ouverture de la base (host bdd user password)
			}
			catch (PDOException $pe)
			{
				$this->mss = $pe->getMessage();
				$this->rtr=-2;
				return false;
			}
			
			$this->rqt = 'SELECT drt FROM usr WHERE lgn="'.$this->lgn.'" AND pwd="'.$this->pwd.'"';						// genere la requete sql dynamiquement
			$this->rsl = $this->bdd->query($this->rqt);																	// envoie la requete au gestionnaire de bdd (mysql)
			$this->rsl->setFetchMode(PDO::FETCH_ASSOC);																	// recupere physiquement les donnees (plus cache)
			$this->vlr = $this->rsl->fetch();
			
			if ($this->vlr == false)																					// pas d'article correspondant dans la base
			{
				$this->rtr = 3;
				$this->mss="Utilisateur inconnu ...";
			}
			else if (count($this->vlr) > 0)																				// une seule reponse
			{
				$this->drt=$this->vlr['drt'];																			// sauve la valeur lue (droit)
				if ($this->drt == 9)																					// droit en ecriture (9)
				{
					$this->rtr = 0;
					$this->mss="Controle total ...";
				}
				else if ($this->drt == 0)																				// pas autorise (0)
				{
					$this->rtr = 2;
					$this->mss="Acces inderdit ...";
				}
				else																									// droit en lecture (de 1 a 8)
				{
					$this->rtr = 1;
					$this->mss="Acces autorise ...";
				}
			}

			$this->bdd = null;																							// referme la bdd
			return true;
		}
		
		public function sndRPN()																						// envoi reponse
		{
			echo json_encode($clsjsn);																					// renvoie au js le json convertie en texte
		}
/*		
		public function setmss($mss)																					// setter du message en retour
		{
			$this->mss = $mss;
		}
		public function setrtr($rtr)																					// setter du code retour
		{
			$this->rtr = $rtr;
		}
*/
	}
	
	$rcv = trim(file_get_contents("php://input"));																		// lecture du post (deja controle en js)
	$rcvOBJ = json_decode($rcv);																						// conversion json text (rcv) en objet php (rcvOBJ)

	$clsjsn = new clsJSN($rcvOBJ->lgn, $rcvOBJ->pwd);																	// creation instance classe json

	if (!is_object($rcvOBJ))																							// si erreur format json --> reponse erreur + arret
	{
		$clsjsn->mss = "Erreur objet JSON";																				// message d'erreur
		$clsjsn->rtr = -3;																								// code erreur
		echo json_encode($clsjsn);																						// renvoie au js le json convertie en texte
		return false;
	}

	$clsjsn->lectureBDD();																								// lecture des droit dans la bdd
	//$clsjsn->sndRPN();																								// repond au js 
	echo json_encode($clsjsn);																							// renvoie au js le json convertie en texte
	return true;
 ?>

