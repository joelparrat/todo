<?php
	require_once 'gstbdd.php';
	
	//$clsbdd = new clsBDD('localhost', 'todo', 'todo', 'abcABC123$');													// creation instance classe bdd

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
	
	$rqt = "SELECT clf FROM usr WHERE lgn='".$clsbdd->clsrcv->lgn."' AND pwd='".$clsbdd->clsrcv->pwd."' AND exs=1";
	$vlr = $clsbdd->selectBDD($rqt);																					// lecture des droit dans la bdd
	if ($vlr == false)																									// pas d'article correspondant dans la base
	{
		$clsbdd->clssnd->rtr = 3;
		$clsbdd->clssnd->mss="Acces non autorise ...";
		echo json_encode($clsbdd->clssnd);																				// renvoie au js le json convertie en texte
		return true;
	}

	$clsbdd->clssnd->rtr = 0;
	$clsbdd->clssnd->mss="Acces autorise ...";
	setcookie("todo_clefutilisateur", $vlr['clf'], time()+(24*60*60));

	echo json_encode($clsbdd->clssnd);
	$clsbdd->closeBDD();
																						// renvoie au js le json convertie en texte
	return false;
 ?>

