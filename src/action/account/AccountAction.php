<?php

namespace crazy\action\account;

use crazy\models\Users;

class AccountAction
{

	public function execute(): string
	{
		$user = Users::find(intval($_SESSION['user']));
		$error = '';
		
		// formulaire de modification des données de compte
		$catalogue = <<<END
		<div class="container col-sm-12 col-md-8 col-lg-6 col-xl-4 my-4">
			<form method="post">
				<!-- Email input -->
				<div class="form-outline mb-4">
					<input type="email" name="registerEmail" id="registerEmail" class="form-control disabled" value="{$user->email}" required />
					<label class="form-label" for="registerEmail">Email</label>
				</div>

				<!-- Name input -->
				<div class="form-outline mb-4">
					<input type="text" name="registerName" id="registerName" class="form-control" value="{$user->nom}" required />
					<label class="form-label" for="registerName">Nom</label>
				</div>

				<!-- Password input -->
				<div class="form-outline mb-4">
					<input type="password" name="registerPassword" id="registerPassword" class="form-control" required />
					<label class="form-label" for="registerPassword">Mot de passe</label>
					$error
				</div>

				<!-- Repeat Password input -->
				<div class="form-outline mb-4">
					<input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control" required />
					<label class="form-label" for="registerRepeatPassword">Répéter le mot de passe</label>
				</div>

				<!-- Phone input -->
				<div class="form-outline mb-4">
					<input type="tel" name="registerPhone" id="registerPhone" class="form-control" value="$user->telephone" />
					<label class="form-label" for="registerPhone">Téléphone</label>
				</div>

				<!-- Submit button -->
				<button type="submit" class="btn btn-primary btn-block mb-3">Enregistrer</button>
			</form>
		</div>
		END;

		return $catalogue;
	}
}
