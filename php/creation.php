<?php

	require_once 'gstbdd.php';
	
	$rcv = trim(file_get_contents("php://input"));																		// lecture du post (deja controle en js)
	$clsbdd->clsrcv = json_decode($rcv);																				// conversion json text en objet php
	if (!is_object($clsbdd->clsrcv))																					// si erreur json --> reponse erreur + arret
	{
		$clsbdd->clssnd->mss = "Erreur objet JSON";																		// message d'erreur
		$clsbdd->clssnd->rtr = -3;																						// code erreur
		echo json_encode($clsbdd->clssnd);																				// renvoie au js le json convertie en texte
		return true;
	}

	$vlr = $clsbdd->openBDD();																							// ouverture base
	if ($vlr != false)																									// erreur ouverture
	{
		echo json_encode($clsbdd->clssnd);																				// renvoie au js le json convertie en texte
		return true;
	}
	
	$rqt = "SELECT lst.lst FROM jnt, lst, usr WHERE usr.clf=jnt.nom AND lst.clf=jnt.lst AND jnt.drt=0 AND usr.clf=".$_COOKIE['clefutilisateur'];

	$vlr = $clsbdd->selectBDD($rqt);
	while ($vlr != false)
	{
		if ($vlr['lst'] == $clsbdd->clsrcv->lst)
		{
			$clsbdd->clssnd->mss = "Vous avez deja cette liste";															// message d'erreur
			$clsbdd->clssnd->rtr = -3;																						// code erreur
			echo json_encode($clsbdd->clssnd);																				// renvoie au js le json convertie en texte
			return true;
		}
		$vlr = $clsbdd->suivantBDD();
	}

	$rqt = "INSERT INTO lst (lst) VALUES ('".$clsbdd->clsrcv->lst."')";
	$clsbdd->insertBDD($rqt);
	$clsbdd->closeBDD();
	
	$clsbdd->clssnd->mss = "Liste cree";																		// message d'erreur
	$clsbdd->clssnd->rtr = 0;																						// code erreur
	echo json_encode($clsbdd->clssnd);
	return false;																										// renvoie au js le json convertie en texte
?>

