$(function() {

//	$("li").css({"cursor":"pointer"});

	$('.ligne_debat_lib').on("click",function(e, v){
		//$(this).slideToggle('slow');
		fillListArg($(this).attr('id'));
		return false;
	});

	function fillListArg(debat_id){
		var debat_lib_fr = $("#"+debat_id).text();
		var content = "<h3>Liste des arguments </h3><ul>";
		if(debat_id != '' && debat_id != null ){
			$("#listDebats").remove();
			$("#debats").empty();
			$("#debats").append(debat_lib_fr);
			$.ajax({
				url: "controller/Arg.php",
				async: true,
				type: 'post',
				data: {id: debat_id},
				dataType: 'json',
				success: function (data) {
					$("#listArgs_ul").empty();
					if (data !== null){
						for (var i in data) {
							content += "<div class='ligne_arg'><li id='" + data[i].arg_id + "'>"+  data[i].arg_lib_fr +"</li>"+
							" <div class='boutons_vote' id='arg_bouton_"+data[i].arg_id+"'><button  onclick=\"modifierArg( '"+data[i].arg_id+"' )\"> proposer une reformulation</button>  "+
						" <button onclick=\"vote( 'plus','"+data[i].arg_id+"','arg' )\">vote +</button>  " +
						" <button onclick=\"vote( 'moins','"+data[i].arg_id+"','arg')\">vote -</button>   score="+  data[i].arg_rank +"</div></div>";
						}
					content+= "</ul>";
					$("#listArgs_ul").append(content); //considerer content comme du html
					var content3 ="<button onclick=\"ajouterArg( '"+debat_id+"'  )\"> ajouter un argument</button>";
					$("#ajouterArgDiv").append(content3);
					}
				$("#ajouterDebatDiv").empty();
				var content2="<button onclick=\"ajouterDebat()\"> ajouter un débat</button>";
				$("#ajouterDebatDiv").append(content2);
				}
			});
		}else{
			$("#listArgs_ul").empty();
		}
		return false;
	}
});


	function ajouterDebat(debat_id){
		$("#ajouterArgDiv").empty();
		$("#ajouterDebatDiv").empty();
		$("#modif_arg").empty();
		$("#listArgs_ul").empty();
		$("#listDebats").empty();
		$("#main_debats").empty();
		var content ="<p><h3> Ajouter un débat </h3> <p>";
		content +='<form method="post" action="controller/Prop.php" >';
		content +='<textarea name="new_debat_lib" rows="6" cols="40"></textarea>';
		content +='<br><input type="submit" value="Je propose ce nouveau débat">';
		content += '</form>';
		$("#content").append(content);

		$.ajax({
			url: "controller/Prop.php",
			async: true,
			type: 'post',
			data: {prop_type: 'debat', prop_link_id: debat_id},
			dataType: 'json',
			success: function (data) {
				$("#listProps_ul").empty();
				if (data !== null){
					content = "";
					var content2 = "<h3>Voici la liste des débats déjà proposés, veuillez soutenir ou désapprouver ces propositions avant d'en faire une nouvelle </h3><ul>";
					for (var i in data) {
//						var lib_used = data[i].prop_lib_fr.replace(/'/g, '\\\'');
						content += "<div class='ligne_debat_prop'><li id='" + data[i].prop_id + "'>"+  data[i].prop_lib_fr + "</li>"+
						" <div class='boutons_vote' id='arg_bouton_"+data[i].prop_id+"'> <button onclick=\"vote( 'plus','"+data[i].prop_id+"' ,'prop')\">vote +</button>  " +
						" <button onclick=\"vote( 'moins','"+data[i].prop_id+"','prop')\">vote -</button>   score="+  data[i].prop_rank+ "</div></div>";
					}
					if(content !== ""){
						content = content2+content+"</ul>";
						$("#listProps_ul").append(content);
					}
				}
			}
		});
		return false;
	}

	function vote(vote, vote_id, vote_type){
		$.ajax({
			url: "controller/Vote.php",
			async: true,
			type: 'post',
			data: {vote: vote, vote_id: vote_id, vote_type: vote_type},
			dataType: 'json',
			success: function (data) {
			}
		});
		if(vote_type == "arg_u"){
				$('#listArgs_ul').find('#' + vote_id).hide();
		}else if (vote_type == "debat"){
				$('#debat_bouton_' + vote_id).hide();
		}else if (vote_type == "arg" ){
				$('#arg_bouton_' + vote_id).hide();
		}else if (vote_type == "prop"){
//			$('.ligne_arg_prop').find('#' + vote_id).hide();
			$('#arg_bouton_' +  vote_id).hide();
		}
		return false;
	}

	function ajouterArg(debat_id){
		$("#modif_arg").empty();
		$("#ajouterArgDiv").empty();
		var content ="<p><h3> Ajouter un argument au débat </h3> <p>";
		content +='<form method="post" action="controller/Prop.php" >';
		content +='<input type="hidden" name="id" value="'+debat_id+'" />';
		content +='<textarea name="new_arg" rows="6" cols="40"></textarea>';
		content +='<br><input type="submit" value="Je propose ce nouvel argument">';
		content += '</form>';
		$("#ajouterArgDiv").append(content);

		$.ajax({
			url: "controller/Prop.php",
			async: true,
			type: 'post',
			data: {prop_type: 'arg', prop_link_id: debat_id},
			dataType: 'json',
			success: function (data) {
				$("#listProps_ul").empty();
				if (data !== null){
					content = "";
					var content2 = "<h3>Voici la liste des arguments déjà proposés, veuillez soutenir ou désapprouver ces propositions avant d'en faire une nouvelle </h3><ul>";
					for (var i in data) {
//						var lib_used = data[i].prop_lib_fr.replace(/'/g, '\\\'');
						content +=
						"<div class='ligne_arg_prop'>"+
							" <li id='" + data[i].prop_id + "'>"+  data[i].prop_lib_fr +"</li>"+
							" <div class='boutons_vote' id='arg_bouton_"+data[i].prop_id+"'>" +
								" <button onclick=\"vote( 'plus','"+data[i].prop_id+"' ,'prop')\">vote +</button>  " +
								" <button onclick=\"vote( 'moins','"+data[i].prop_id+"','prop')\">vote -</button>   score="+  data[i].prop_rank+
							"</div>"+
						"</div>";
					}
					if(content !== ""){
						content = content2+content+"</ul>";
						$("#listProps_ul").append(content);
					}
				}
			}
		});
		return false;
	}

	function modifierArg(arg_id){
		$("#modif_arg").empty();
		$("#ajouterArgDiv").empty();
		var arg_lib_fr = $("#listArgs_ul #"+arg_id).text();
		var content ="<p><h3> Modification de l'argument </h3>"+arg_lib_fr+" <p>";
		content +='<form method="post" action="controller/Prop.php" >';
		content +='<textarea name="updated_arg" rows="6" cols="40">'+arg_lib_fr+'</textarea>';
		content +='<input type="hidden" name="id" value="'+arg_id+'" />';
		content +='<br><input type="submit" value="Je propose cette correction">';
		content += '</form>';
		$("#modif_arg").append(content);
		$.ajax({
			url: "controller/Prop.php",
			async: true,
			type: 'post',
			data: {prop_type: 'arg_u', prop_link_id: arg_id},
			dataType: 'json',
			success: function (data) {
				$("#listProps_ul").empty();
				if (data !== null){
					content = "";
					var content2 = "<h3>Voici la liste des reformulations de l'arguments déjà proposés, veuillez soutenir ou désapprouver ces propositions avant d'en faire une nouvelle </h3><ul>";
					for (var i in data) {
//						var lib_used = data[i].prop_lib_fr.replace(/'/g, '\\\'');
						content += "<div class='ligne_arg_prop'> <li id='" + data[i].prop_id + "'>"+  data[i].prop_lib_fr +"</li>"+
						" <div class='boutons_vote' id='arg_bouton_"+data[i].prop_id+"'><button onclick=\"vote( 'plus','"+data[i].prop_id+"' ,'prop')\">vote +</button>  " +
						" <button onclick=\"vote( 'moins','"+data[i].prop_id+"','prop')\">vote -</button>   score="+  data[i].prop_rank+"</div></div>";
					}
					if(content !== ""){
						content = content2+content+"</ul>";
						$("#listProps_ul").append(content);
					}
				}
			}
		});
		return false;
	}

