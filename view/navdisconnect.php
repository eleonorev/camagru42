<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Connexion</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Inscription</label>
		<div class="login-form">
			<form action="model/users.php" method="post">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Login</label>
					<input id="login" name="login" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input name="connexion" type="submit" class="button" value="Connexion">
				</div>
			</form>

				<div class="hr"></div>

				<div class="foot-lnk">
					<a href="#forgot">Mot de passe oublié ?</a>
					<div id=#forgot>
						<form action="model/users.php" method="post">
							<div class="group">
								<input id="login" name="login" type="text" class="input" placeholder="login">
							</div>
							<div class="group">
								<input name="forgot" type="submit" class="button forgot" value="Regenerer">
							</div>
						</form>

						</div>
					</div>
				</div>


			<div class="sign-up-htm">
				<form action="model/users.php" method="post">
				<div class="group">
					<label for="user" class="label">Login</label>
					<input name="login" id="login" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Mot de passe</label>
					<input id="passwd_one" name="passwd_one" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeter le mot de passe</label>
					<input id="passwd_two" name="passwd_two" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Adresse mail</label>
					<input id="mail" name="mail" type="text" class="input">
				</div>
				<div class="group">
					<input name="inscription" type="submit" class="button" value="S'inscrire">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Déja Membre ?</a>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
