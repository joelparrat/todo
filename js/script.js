
$(																														// jquery: attente chargement dom
	function()
	{
		$('.connexion').click																							// evenement click du bouton connexion
		(
			function()
			{
				if (($('[name="lgn"]').val() != "") && (($('[name="pwd"]').val() != "")))								// controle si la saisie a ete faite (oui)
				{
					let objJSON =																						// creation d'un objet js pour json
					{
						lgn: $('[name="lgn"]').val(),																	// le login (nom+valeur)
						pwd: $('[name="pwd"]').val()																	// le password (nom+valeur)
					};
					
					$.post																								// envoi json avec la methode post
					(
						"../php/connexion.php",																			// url de destination (php)
						JSON.stringify(objJSON), 																		// convertie l'objet js en texte json
						function(reponse)																				// quand le serveur repond ca va dans reponse
						{
							//console.log("@@"+reponse+"$$");
							let rcv = $.parseJSON(reponse);																// conversion objet json texte en objet js (rcv)
							//	$('.message').html("Erreur interne");
							//	alert("Erreur interne: pb format json");
							//	console.log("texteJSON:@@"+reponse+"$$");
							//console.log(rcv.mss);
							//console.log(rcv.rtr);
							$('.message').html(rcv.mss);
							if (!rcv.rtr)																				// droit en ecriture
							{
								$('[name="lgn"]').css("color", "black");
								$('[name="pwd"]').css("color", "black");
								$('.message').css("color", "green");
								window.setTimeout(affPage, 5000);														// ajout attente pour demo
							}
							else if (rcv.rtr == 1)																		// droit en lecture
							{
								$('[name="lgn"]').css("color", "darkblue");
								$('[name="pwd"]').css("color", "darkblue");
								$('.message').css("color", "darkblue");
								window.setTimeout(affPage, 5000);														// ajout attente pour demo
							}
							else																						// pas autorise
							{
								//$('#bdd') disabled
								//$('#adm') disabled
								$('[name="lgn"]').css("color", "red");
								$('[name="pwd"]').css("color", "red");
								$('.message').css("color", "darkblue");
							}
						}
					);

				}
				else																									// controle si la saisie a ete faite (non)
				{
					$('.message').css("color", "red");																	// positionne la couleur du message d'erreur (rouge)
					if (($('[name="lgn"]').val() == "") && ($('[name="pwd"]').val() == ""))								// on n'a ni le login ni le password
						$('.message').html("Veuillez vous identifier ...");												// on affiche le message d'erreur
					else if ($('[name="lgn"]').val() == "")																// on n'a pas le login
						$('.message').html("Entrez votre identifiant ...");												// on affiche le message d'erreur
					else																								// on n'a pas le password
						$('.message').html("Entrez votre mot de passe ...");											// on affiche le message d'erreur
				}
			}
		)

		$('.inscription').click																							// evenement click du bouton inscription
		(
			function()
			{
				if (($('[name="prn"]').val() != "") && (($('[name="nom"]').val() != "")) &&
					($('[name="lgn"]').val() != "") && (($('[name="pwd"]').val() != "")))								// controle si la saisie a ete faite (oui)
				{
					let objJSON =																						// creation d'un objet js pour json
					{
						prn: $('[name="prn"]').val(),																	// le prenom (nom+valeur)
						nom: $('[name="nom"]').val(),																	// le nom (nom+valeur)
						lgn: $('[name="lgn"]').val(),																	// le login (nom+valeur)
						pwd: $('[name="pwd"]').val()																	// le password (nom+valeur)
					};
					
					$.post																								// envoi json avec la methode post
					(
						"../php/inscription.php",																		// url de destination (php)
						JSON.stringify(objJSON), 																		// convertie l'objet js en texte json
						function(reponse)																				// quand le serveur repond ca va dans reponse
						{
							//console.log(reponse);
							let rcv = $.parseJSON(reponse);																// conversion objet json texte en objet js (rcv)
							//console.log(rcv.mss);
							$('.message').html(rcv.mss);
							if (!rcv.rtr)																				// pas encore inscrit
							{
								$('[name="prn"]').css("color", "black");
								$('[name="nom"]').css("color", "black");
								$('[name="lgn"]').css("color", "black");
								$('[name="pwd"]').css("color", "black");
								$('.message').css("color", "green");
								window.setTimeout(affPage, 5000);														// ajout attente pour demo
							}
							else																						// deja inscrit
							{
								//$('#bdd') disabled
								//$('#adm') disabled
								$('[name="prn"]').css("color", "red");
								$('[name="nom"]').css("color", "red");
								$('[name="lgn"]').css("color", "black");
								$('[name="pwd"]').css("color", "black");
								$('.message').css("color", "darkblue");
							}
						}
					);

				}
				else																									// controle si la saisie a ete faite (non)
				{
					$('.message').css("color", "red");																	// positionne la couleur du message d'erreur (rouge)
					if (($('[name="prn"]').val() == "") && ($('[name="nom"]').val() == "") &&
						($('[name="lgn"]').val() == "") && ($('[name="pwd"]').val() == ""))								// on n'a ni le login ni le password
						$('.message').html("Veuillez vous identifier ...");												// on affiche le message d'erreur
					else if ($('[name="prn"]').val() == "")																// on n'a pas le login
						$('.message').html("Veuillez saisir votre prenom ...");											// on affiche le message d'erreur
					else if ($('[name="nom"]').val() == "")																// on n'a pas le login
						$('.message').html("Veuillez saisir votre nom ...");											// on affiche le message d'erreur
					else if ($('[name="lgn"]').val() == "")																// on n'a pas le login
						$('.message').html("Veuillez saisir votre login ...");											// on affiche le message d'erreur
					else if ($('[name="pwd"]').val() == "")																// on n'a pas le login
						$('.message').html("Veuillez saisir votre mot de passe ...");											// on affiche le message d'erreur
				}
			}
		)

		$('.connexion').hover																							// evenement click du bouton inscription
		(
			function()
			{
				//$('.message').html("Veuillez vous identifier ...");														// on affiche le message d'erreur
				$('.aff').css("display", "none");
				//$('.message').css("color", "darkblue");
			}
		)

		$('.inscription').hover																							// evenement click du bouton inscription
		(
			function()
			{
				//$('.message').html("Veuillez vous inscrire ...");														// on affiche le message d'erreur
				$('.aff').css("display", "flex");
				//$('.message').css("color", "darkblue");
			}
		)
		
		function affPage()
		{
			$(location).attr('href',"../php/afflst.php");
		} 
	}
);

