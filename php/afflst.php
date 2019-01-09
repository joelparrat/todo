
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
					
					$rqt = "SELECT usr.prn, usr.nom, lst.lst FROM jnt, lst, usr WHERE usr.clf=lst.clf AND jnt.nom='".$_COOKIE['clefutilisateur']."'";
					$vlr = $clsbdd->selectBDD($rqt);
					while ($vlr != false)
					{
						echo "<li>".$vlr['prn']." ".$vlr['nom']." ".$vlr['lst']."</li>";
						$vlr = $clsbdd->suivantBDD();
					}
				?>
			</ul>
		</div>
	
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>

