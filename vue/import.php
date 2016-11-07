
<h2>Import des données</h2>
<form enctype="multipart/form-data" method="post" id="import" action="import.php">

	</br>
	<input type="file" name="fileAUploader" id="fileAUploader" required="required">
	</br>

	<input class="bouton" type="submit" value="Uploader"/> <br>
</form>
<span>
		<?php if(isset($messageErreur)){echo $messageErreur;} ?> <br/>
</span>
