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

	$rqt = "SELECT clf FROM lst WHERE lst='".$_COOKIE['todo_nomliste']."'";
	$vlr = $clsbdd->selectBDD($rqt);

	$rqt = "INSERT INTO act (lst, txt) VALUES (".$vlr['clf'].", '".$clsbdd->clsrcv->act."')";
	$clsbdd->insertBDD($rqt);
	$clsbdd->closeBDD();
	
	$clsbdd->clssnd->mss = "Action cree";																		// message d'erreur
	$clsbdd->clssnd->rtr = 0;																						// code erreur
	echo json_encode($clsbdd->clssnd);
	return false;																										// renvoie au js le json convertie en texte
?>

