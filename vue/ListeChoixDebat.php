<?php

$debatClass = new Debat();
$debats = $debatClass->getList();
//echo print_r($_SESSION);
?>
<div>
	<?php
		//echo print_r($_SESSION);
		//echo print_r($SERVER_NAME)."<br>";
/*		echo $_SESSION['prop_arg_rank_default']."<br>";
		echo $_SESSION['prop_arg_u_rank_default']."<br>";
		echo $_SESSION['prop_debat_rank_default']."<br>";
		echo $_SESSION['prop_arg_rank_validation']."<br>";
		echo $_SESSION['prop_debat_rank_validation']."<br>";
		echo $_SESSION['prop_arg_u_rank_validation']."<br>";
		echo $_SESSION['prop_arg_rank_delete']."<br>";
		echo $_SESSION['prop_arg_u_rank_delete']."<br>";
		echo $_SESSION['prop_debat_rank_delete']."<br>";
*/	?>
</div>
<div id="main_debats" class="global">
	<H3 id="debats">Debats</H3>
	<ul id='listDebats' >
		<?php
		foreach($debats as $cle => $debat){
				echo"<div class='ligne_debat' ><li id='".$debats[$cle]->debat_id."' class='ligne_debat_lib'>".$debats[$cle]->debat_lib_fr. " </li> ".
						" <div class='boutons_debat' id='debat_bouton_".$debats[$cle]->debat_id."'><button onclick=\"vote( 'plus','".$debats[$cle]->debat_id."','debat' )\">vote +</button>  " .
						" <button onclick=\"vote( 'moins','".$debats[$cle]->debat_id."','debat')\">vote -</button>   score=".$debats[$cle]->debat_rank."</div></div>";
		}
		?>
	</ul>
	<div id='ajouterDebatDiv'><button onclick='ajouterDebat()'> ajouter un débat</button></div>
</div>
<script type="text/javascript" src="js/manageDebatArg.js" ></script>



