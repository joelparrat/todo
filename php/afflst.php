
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>ToDo List</title>
		
        <link href="../css/style.css" rel="stylesheet" type="text/css">
		<!-- <link rel="shortcut icon" type="image/ico" href="../img/gstflm.ico"/> -->
	</head>
	
	<body>
		<h3>My Lists</h3>
		<div class="cadre">
			<div class="centre">
				<a href="creation.php">Creation nouvelle liste</a>
			</div>
			
			<ul>
				<?php
					require_once 'gstbdd.php';

					$vlr = $clsbdd->openBDD();																							// ouverture base
					if ($vlr != false)																									// erreur ouverture
					{
						echo json_encode($clsbdd->clssnd);																				// renvoie au js le json convertie en texte
						return true;
					}
					
					$rqt = "SELECT usr.prn, usr.nom, lst.lst FROM jnt, lst, usr WHERE usr.clf=jnt.nom AND lst.clf=jnt.lst AND jnt.drt=0 AND usr.clf=".$_COOKIE['clefutilisateur'];
					$vlr = $clsbdd->selectBDD($rqt);
					while ($vlr != false)
					{
						echo "<li>".$vlr['prn']." ".$vlr['nom']." ".$vlr['lst']."</li>";
						$vlr = $clsbdd->suivantBDD();
					}
					
					$rqt = "SELECT usr.prn, usr.nom, lst.lst FROM jnt, lst, usr WHERE usr.clf=jnt.nom AND lst.clf=jnt.lst AND jnt.drt=0 AND jnt.lst IN (SELECT jnt.lst FROM jnt, lst, usr WHERE usr.clf=jnt.nom AND lst.clf=jnt.lst AND jnt.drt=1 AND usr.clf=".$_COOKIE['clefutilisateur'].")";
					$vlr = $clsbdd->selectBDD($rqt);
					while ($vlr != false)
					{
						echo "<li>".$vlr['prn']." ".$vlr['nom']." ".$vlr['lst']."</li>";
						$vlr = $clsbdd->suivantBDD();
					}
					$clsbdd->closeBDD();
				?>
			</ul>
		</div>
	
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>

