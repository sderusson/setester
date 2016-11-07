<h3>Modification du profil</h3>
<span>
	<p> Ne remplissez que les champs à modifier.</p>
</span>
<?php
$adminClass = new Administrateur();
$username = $_SESSION['username'];
$password = $adminClass->getPasswordByLogin($username);
$email = $adminClass->getMailByLogin($username);
?>

<form method="post" id="profil" action="profil.php">
    <table border="0">
        <tr>
            <td class="libelle">Login</td>
            <td><input type="text" name="login" <?php echo "value=" . $username ?> id="login"></td>
        </tr>
        <tr>
            <td class="libelle">Mot de passe</td>
            <td><input type="password" name="mdp"  <?php echo "value=" . $password->result ?> id="mdp"></td>
        </tr>
        <tr>
            <td class="libelle">Mot de passe</td>
            <td><input type="password" name="mdp2" <?php echo "value=" . $password->result ?> id="mdp2"></td>
        </tr>
        <tr>
            <td class="libelle">E-mail</td>
            <td><input type="email" name="mail" <?php echo "value=" . $email->result ?> id="mail"></td>
        </tr>
        <tr>
            <td><input type="submit" id="modifProfil" value="Modifier"></td>
        </tr>
        <tr>
            <?php if (isset($messageErreurProfil)) {
                echo $messageErreurProfil;
            } ?>
        </tr>
    </table>
</form>

