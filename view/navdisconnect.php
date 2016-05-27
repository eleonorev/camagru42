<div class="login-wrap">
<?php

	if (isset($_GET['r'])) {
		switch($_GET['r']) {
			case 2 : echo "<span class='alert error'> Les mots de passe sont différents </span>"; break;
			case 3 : echo "<span class='alert error'> Votre mot de passe doit contenir au moins 8 caracteres </span>";  break;
			case 4 : echo "<span class='alert error'> Votre login doit contenir au moins 3 caracteres </span>";  break;
			case 5 : echo "<span class='alert error'> Faux mail. </span>";  break;
			case 6 : echo "<span class='alert error'>Login existant. Merci d'en choisir un autre.</span>";  break;
			case 7 : echo "<span class='alert error'> Vous ne pouvez pas accéder a cette page sans identification </span>";  break;
			case 12 : echo "<span class='alert success'> Vous avez reçu un mail de confirmation </span>";  break;
			case 13 : echo "<span class='alert error'>Me prend pas pour un con </span>";  break;

		}
	}
	if (isset($_GET['l'])) {
		switch($_GET['l']) {
			case 1 : echo "<span class='alert error'> Vous n'avez pas valider votre compte ou votre mot de passe ne correspond pas a ce login.</span>"; break;
			case 5 : echo "<span class='alert success'> Felicitation, vous avez valider votre compte, vous pouvez vous connectez. </span>";  break;

		}
	}

?>
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
					<span id="linkforgot">Mot de passe oublié ?</span>
					<div id="forgot">
						<form action="model/users.php" method="post">
							<div class="group">
								<input id="loginforgot" name="login" type="text" class="input" placeholder="login">
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
	<script>
	document.getElementById("linkforgot").addEventListener("click", function() {
	  var fg = document.getElementById('forgot');
	  fg.classList.toggle("active");
	}); </script>
</div>
