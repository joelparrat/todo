
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>ToDo List</title>
		
        <link href="../css/style.css" rel="stylesheet" type="text/css">
		<!-- <link rel="shortcut icon" type="image/ico" href="../img/gstflm.ico"/> -->
	</head>
	
	<body>
		<?php
			if (isset($_GET["lst"]))
				setcookie("todo_nomliste", $_GET["lst"], time()+(24*60*60));
			else
				setcookie("todo_nomliste", "", -1);
		?>
		<h3>Les actions<?php echo ' de '.$_GET["lst"]; ?></h3>
		<div class="cadre">
			<div class="centre">
				<a href="../html/crtact.html">Ajout action</a>
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
					
					$rqt = "SELECT txt FROM act, lst WHERE act.lst=lst.clf AND lst.lst='".$_GET['lst']."'";
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

