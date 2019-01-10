
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>ToDo List</title>
		
        <link href="../css/style.css" rel="stylesheet" type="text/css">
		<!-- <link rel="shortcut icon" type="image/ico" href="../img/gstflm.ico"/> -->
	</head>
	
	<body>
		<h3>My Actions</h3>
		<div class="cadre">
			<div class="centre">
				<a href="../html/crtact.php">Ajout action</a>
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
					
					$rqt = "SELECT txt FROM act, lst WHERE act.clf=lst.clf AND lst.clf=1";
					$vlr = $clsbdd->selectBDD($rqt);
					while ($vlr != false)
					{
						echo "<li>".$vlr['txt']."<li>";
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

