<?php

namespace crazy\action;

use crazy\models\Utilisateur;
use Psr\Http\Message\ResponseInterface as Response;

class ProfilAction {

	/**
	 * Affiche et traite le formulaire d'inscription
	 */
	public function inscription(Response $rs, $args): Response {
		$rs->getBody()->write("TODO");
		// Si le formulaire a été soumis :
		if (isset($_POST['submit'])) {
			// Si le bouton Inscription a été cliqué :
			if ($_POST['submit'] == 'inscription') {
				// Vérification des champs :
				if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])) {
					// Échappement des balises HTML :
					$nom = htmlspecialchars($_POST['nom']);
					$prenom = htmlspecialchars($_POST['prenom']);
					$email = htmlspecialchars($_POST['email']);
					$pass = $_POST['password'];
					$pass2 = $_POST['password2'];
					// Vérification de la validité des champs :
					if (strlen($nom) > 0 && strlen($prenom) > 0 && strlen($email) > 0 && strlen($pass) > 0 && strlen($pass2) > 0) {
						// Vérification de la validité de l'email :
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							// Vérification de la correspondance des mots de passe :
							if ($pass == $pass2) {
								// Vérification de l'unicité de l'email :
								$user = Utilisateur::where('email', '=', $email)->first();
								if ($user == []) {
									// Création de l'utilisateur :
									$user = new Utilisateur();
									$user->nom = $nom;
									$user->prenom = $prenom;
									$user->email = $email;
									$user->password = password_hash($pass, PASSWORD_DEFAULT);
									$user->save();
									// Redirection vers le profil :
									$rs = $rs->withRedirect($this->container->router->pathFor('Profil', ['token' => $args['token']]));
								} else {
									echo "<p class='erreur'>Un compte existe déjà avec cet email.</p>";
								}
							} else {
								echo "<p class='erreur'>Les mots de passe ne correspondent pas.</p>";
							}
						} else {
							echo "<p class='erreur'>L'adresse email n'est pas valide.</p>";
						}
					} else {
						echo "<p class='erreur'>Veuillez remplir tous les champs.</p>";
					}
				} else {
					echo "<p class='erreur'>Veuillez remplir tous les champs.</p>";
				}
			}
		}
		return $rs;
	}

	/**
	 * Affiche et traite le formulaire de connexion
	 */
	public function connexion(Response $rs, $args): Response {
		$rs->getBody()->write("TODO");
		// Si le formulaire a été soumis :
		if (isset($_POST['submit'])) {
			// Si le bouton Connexion a été cliqué :
			if ($_POST['submit'] == 'connexion') {
				// Vérification des champs :
				if (isset($_POST['email']) && isset($_POST['password'])) {
					// Échappement des balises HTML :
					$email = htmlspecialchars($_POST['email']);
					$pass = $_POST['password'];
					// Vérification de la validité des champs :
					if (strlen($email) > 0 && strlen($pass) > 0) {
						// Vérification de la validité de l'email :
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							// Vérification de l'existence de l'utilisateur :
							$user = Utilisateur::where('email', '=', $email)->first();
							if ($user != []) {
								// Vérification du mot de passe :
								if (password_verify($pass, $user->password)) {
									// Création du token :
									$token = bin2hex(random_bytes(32));
									// Mise à jour de l'utilisateur :
									$user->token = $token;
									$user->save();
									// Redirection vers le profil :
									$rs = $rs->withRedirect($this->container->router->pathFor('Profil', ['token' => $token]));
								} else {
									echo "<p class='erreur'>Le mot de passe est incorrect.</p>";
								}
							} else {
								echo "<p class='erreur'>Aucun compte n'existe avec cet email.</p>";
							}
						} else {
							echo "<p class='erreur'>L'adresse email n'est pas valide.</p>";
						}
					} else {
						echo "<p class='erreur'>Veuillez remplir tous les champs.</p>";
					}
				} else {
					echo "<p class='erreur'>Veuillez remplir tous les champs.</p>";
				}
			}
		}
		return $rs;
	}

	/**
	 * Permet la déconnexion de l'utilisateur
	 */
	public function deconnexion(Response $rs, $args): Response {
		$rs->getBody()->write("TODO");
		// Vérification de l'existence du token :
		if (isset($args['token'])) {
			// Vérification de l'existence de l'utilisateur :
			$user = Utilisateur::where('token', '=', $args['token'])->first();
			if ($user != []) {
				// Mise à jour de l'utilisateur :
				$user->token = null;
				$user->save();
			}
		}
		// Redirection vers la page d'accueil :
		return $rs->withRedirect($this->container->router->pathFor('Accueil'));
	}

}