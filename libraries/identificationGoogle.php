<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
	require_once 'google/Google_Client.php';
	require_once 'google/contrib/Google_PlusService.php';
	require_once '../controllers/Utilisateur.php';
	
	$action = null;
	if(isset($_REQUEST['action']))
		$action = $_REQUEST['action'];
	
	$client = new Google_Client();
	$client->setApplicationName("Google+ PHP Starter Application");
	// Visit https://code.google.com/apis/console to generate your
	// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
	 $client->setClientId("YOUR CLIENT ID");
	 $client->setClientSecret("YOUR SECRET ID");
	 $client->setRedirectUri("YOUR REDIRECT URI");
	 $client->setDeveloperKey("YOUR DEVELOP KEY");
	 

	$plus = new Google_PlusService($client);
	
	
	
	if ($action == 'deconnexion') 
	{
		unset($_SESSION['utilisateur']);
		unset($_SESSION['access_token']);
		unset($_SESSION['google_access_token']);
		echo '<script language="Javascript">
			<!--
			document.location.replace("/index.php/login");
			// -->
			</script>';
			exit();
	}
	
	

	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['access_token'] = $client->getAccessToken();
	 // header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	}
	
	if (isset($_SESSION['access_token'])) {
	  $client->setAccessToken($_SESSION['access_token']);
	}
	if ($client->getAccessToken()) 
	{
		  $me = $plus->people->get('me');
		  
		  // The access token may have been updated lazily.
		  $_SESSION['access_token'] = $client->getAccessToken();
		  $_SESSION['google_access_token'] = true;
		if(!isset($_SESSION['utilisateur']))
		{	
			$utilisateur = Utilisateur::GetAccesGoogle($me['id']);
			if($utilisateur === false)
			{
				unset($_SESSION['access_token']);
				unset($_SESSION['google_access_token']);
				echo '<h1>Ce compte google+ n\'est associé à aucun compte du site - Redirection en cours...<h1>';
				echo '<script language="Javascript">
					<!--
					document.location.replace("/index.php/login");
					// -->
					</script>';
				exit();
			}
			else
			{
				$_SESSION['utilisateur'] = $utilisateur->id;
				$_SESSION['habilitation'] = $utilisateur->droits;
				echo '<h1>Vous êtes bien connecté ! - Redirection en cours...<h1>';
				echo '<script language="Javascript">
					<!--
					document.location.replace("/index.php/login");
					// -->
					</script>';
				exit();
			}
		}
		else
		{
			$utilisateur = Utilisateur::Get($_SESSION['utilisateur']);
			if($utilisateur->google_id == $me['id'])
			{
				echo '<h1>Votre compte est déjà associé à un compte google+ - Redirection en cours...<h1>';
				echo '<script language="Javascript">
					<!--
					document.location.replace("/index.php/login");
					// -->
					</script>';
				exit();
			}
			else
				if($utilisateur->UpdateGoogleId($me['id']) === true)
				{
					echo '</h1>Compte désormais associé à votre compte google+ - Redirection en cours...<h1>';
					echo '<script language="Javascript">
					<!--
					document.location.replace("/index.php/login");
					// -->
					</script>';
					exit();
				}
				else
				{
					unset($_SESSION['google_access_token']);
					echo '<h1>Erreur lors de l\'association à votre compte google+ - Redirection en cours...<h1>';
					echo '<script language="Javascript">
					<!--
					document.location.replace("/index.php/login");
					// -->
					</script>';
					exit();
				}
		}
	} 
	else 
	{
	  $authUrl = $client->createAuthUrl();
	 // header("Location: '.$authUrl.'");
	  echo '<script language="Javascript">
		<!--
		document.location.replace("'.$authUrl.'");
		// -->
		</script>';
		exit();
	}
  
?>
</body>
</html>