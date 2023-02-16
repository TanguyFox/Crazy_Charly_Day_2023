<?php

namespace crazy\action\account;

use crazy\auth\Authentication;
use crazy\models\Users;

class AccountAction
{

	public function execute(): string
	{
		$user = Users::find(intval($_SESSION['user']));

		$error = '';
		$success = '';

		if (isset($_POST['registerName']) || isset($_POST['registerPassword']) || isset($_POST['registerRepeatPassword']) || isset($_POST['registerPhone'])) {
			// vérification des données
			$name = htmlspecialchars(trim($_POST['registerName']));
			$password = htmlspecialchars(trim($_POST['registerPassword']));
			$repeatPassword = htmlspecialchars(trim($_POST['registerRepeatPassword']));
			$telephone = htmlspecialchars(trim($_POST['registerPhone']));
			if ($password !== $repeatPassword) {
				$error = '<div id="passwordHelp" class="form-text text-danger">Les mots de passe ne correspondent pas</div>';
			} else {
				// modification des données
				if ($user->nom !== $name) $user->nom = $name;
				if ($password !== '' && Authentication::checkPasswordStrength($password, 6)) $user->password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
				if ($user->telephone !== $telephone) $user->telephone = $telephone;
				$user->save();
				$success = '<div class="alert alert-success" role="alert">Les données ont été modifiées</div>';
				unset($_POST);
			}
		}

		// formulaire de modification des données de compte
		$catalogue = <<<END
		<div class="container col-sm-12 col-md-8 col-lg-6 col-xl-4 my-4">
			$success
			<form method="post">
				<!-- Email input -->
				<div class="form-outline mb-4">
					<input type="email" name="registerEmail" id="registerEmail" class="form-control" value="{$user->email}" disabled />
					<label class="form-label" for="registerEmail">Email</label>
				</div>

				<!-- Name input -->
				<div class="form-outline mb-4">
					<input type="text" name="registerName" id="registerName" class="form-control" value="{$user->nom}" required />
					<label class="form-label" for="registerName">Nom</label>
				</div>

				<!-- Password input -->
				<div class="form-outline mb-4">
					<input type="password" name="registerPassword" id="registerPassword" class="form-control" />
					<label class="form-label" for="registerPassword">Mot de passe</label>
					$error
				</div>

				<!-- Repeat Password input -->
				<div class="form-outline mb-4">
					<input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control" />
					<label class="form-label" for="registerRepeatPassword">Répéter le mot de passe</label>
				</div>

				<!-- Phone input -->
				<div class="form-outline mb-4">
					<input type="tel" name="registerPhone" id="registerPhone" class="form-control" value="$user->telephone" />
					<label class="form-label" for="registerPhone">Téléphone</label>
				</div>

				<!-- Submit button -->
				<button type="submit" class="btn btn-primary btn-block mb-3">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
					</svg>
					Enregistrer
				</button>
			</form>
		</div>
		END;

		return $catalogue;
	}
}
