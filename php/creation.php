<?php
	echo "<h3>Creation Liste</h3>";
	echo "<label>Libelle</label>";
	echo '<input type="text" name="lst"/>';
	
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
	
	$this->rqt = 'SELECT clf, exs FROM usr WHERE prn="'.$this->prn.'" AND nom="'.$this->nom.'"';				// genere la requete sql dynamiquement
	$this->rsl = $this->bdd->query($this->rqt);																	// envoie la requete au gestionnaire de bdd (mysql)
	$this->rsl->setFetchMode(PDO::FETCH_ASSOC);																	// recupere physiquement les donnees (plus cache)
	$this->vlr = $this->rsl->fetch();
	
	if ($this->vlr == false)																					// pas d'article correspondant dans la base
	{
		$this->rtr = 3;
		$this->mss="Utilisateur non autorise ...";
	}
	else if (count($this->vlr) > 0)																				// une seule reponse
	{
		$clf = $this->vlr['clf'];
		$this->exs=$this->vlr['exs'];																			// sauve la valeur lue (inscrit ?)
		if ($this->exs == 0)																					// si 0 pas inscrit
		{
			$this->rqt = "UPDATE usr SET lgn='".$this->lgn."', pwd='".$this->pwd."', exs=1 WHERE clf=".$clf;	// creation du login / password
			$this->rsl = $this->bdd->exec($this->rqt);															// envoie la requete au gestionnaire de bdd (mysql)
			if ($this->rsl == false)																			// pas d'article correspondant dans la base
			{
				$this->rtr = 3;
				$this->mss="Probleme BDD ...";
			}
			else if ($this->vlr == 0)																			// une seule reponse
			{
				$this->rtr = 3;
				$this->mss="Pas de modification ...";
			}
			else
			{
				$this->rtr = 0;
				$this->mss="Utilisateur enregistre ...";
			}
		}
		else																									// inscrit
		{
			$this->rtr = 1;
			$this->mss="Vous etes deja inscrit ...";
		}
	}

	$this->bdd = null;																							// referme la bdd
	return true;
?>

