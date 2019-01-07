
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
							//console.log(reponse);
							let rcv = $.parseJSON(reponse);																// conversion objet json texte en objet js (rcv)
							//console.log(rcv.mss);
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
				if (($('[name="lgn"]').val() != "") && (($('[name="pwd"]').val() != "")))								// controle si la saisie a ete faite (oui)
				{
					let objJSON =																						// creation d'un objet js pour json
					{
						lgn: $('[name="lgn"]').val(),																	// le login (nom+valeur)
						pwd: $('[name="pwd"]').val()																	// le password (nom+valeur)
					};
					
					$.post																								// envoi json avec la methode post
					(
						"../php/inscription.php",																			// url de destination (php)
						JSON.stringify(objJSON), 																		// convertie l'objet js en texte json
						function(reponse)																				// quand le serveur repond ca va dans reponse
						{
							//console.log(reponse);
							let rcv = $.parseJSON(reponse);																// conversion objet json texte en objet js (rcv)
							//console.log(rcv.mss);
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
						$('.message').html("Veuillez saisir votre prenom ...");											// on affiche le message d'erreur
					else																								// on n'a pas le password
						$('.message').html("Veuillez saisir votre nom ...");											// on affiche le message d'erreur
				}
			}
		)
		
		function affPage()
		{
			$(location).attr('href',"gstflm.html");
		} 
	}
);

