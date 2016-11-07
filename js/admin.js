function modif2(justif_id,htmlIdJustif) {
	var e = document.getElementById('container2');
	e.style.display = 'none';
	var f = document.getElementById('modif2');
	f.style.display = 'block';
	var comboArgs = document.getElementById('listArgs2');
	var comboArgsValue = comboArgs.value ;
	var comboDebat = document.getElementById('listDebats2');
	var comboDebatValue = comboDebat.value ;
	document.getElementById('formIdArg').value = comboArgsValue;
	document.getElementById('formIdDebat').value = comboDebatValue;
	document.getElementById('formIdJustif').value = justif_id;
	document.getElementById('formJustif').value = document.getElementById('justif_lib_fr'+htmlIdJustif).innerHTML.split('] - ')[1].split('<br>')[0];
//il manque une requete qui mettra à jour le teste en base de données
}

function modif3(justif_id,htmlIdJustif) {
	var e = document.getElementById('container3');
	e.style.display = 'none';
	var f = document.getElementById('modif3');
	f.style.display = 'block';
	var comboArgs = document.getElementById('listArgs3');
	var comboArgsValue = comboArgs.value ;
	var comboDebat = document.getElementById('listDebats3');
	var comboDebatValue = comboDebat.value ;
	document.getElementById('formIdArg3').value = comboArgsValue;
	document.getElementById('formIdDebat3').value = comboDebatValue;
	document.getElementById('formIdJustif3').value = justif_id;
	document.getElementById('formJustif3').value = document.getElementById('justif_lib_en'+htmlIdJustif).innerHTML.split('] - ')[1].split('<br>')[0];
//il manque une requete qui mettra à jour le teste en base de données
}
$(

function() {
	$('#listDebats2').comboSelect();

	$('#listDebats2').on("change",function(e, v){
		fillListArg2();
		return false;
	});

	$('#listDebats2').on("click",function(e, v){
		$('.idx').text(e.target.selectedIndex)
		$('.val').text(e.target.value)
	});

	$('#listArgs2').on("change",function(e, v){
		var val = this.value;
		var page = "model/getArgInfo.php";
		if(val != '' && val != null ){
			$.ajax({
				url: "model/getArgInfo.php",
				async: false,
				type: 'post',
				data: {page: page, id: val},
				dataType: 'json',
				success: function (data) {
					if (data["argJustif"] != null && data["argT"] != null && data["maxCom"] != null){
						data1 = data["argT"];
						data2 = data["argJustif"];
						maxCom = data["maxCom"][0].nbCom;

						$("#maxCom").val(maxCom);
						$("#arg_lib_fr").empty();
						$("#arg_lib_en").empty();
						for (nb=1; nb<=maxCom; nb++){
							$("#justif_lib_fr"+nb).empty();
							$("#justif_lib_en"+nb).empty();
						}
						for (var i in data1) {
							$("#arg_lib_fr").append( data1[i].arg_lib_fr);
							$("#arg_lib_en").append(data1[i].arg_lib_en);
						}
						var n = 0;
						for (var j in data2) {
							n ++;
							$("#justif_lib_fr"+n).justif_lib_fr+ "</br></br>");
							if(data2[j].justif_lib_fr == null){
								$("#justif_lib_en"+n);
							}
							else{
								$("#justif_lib_en"+n).justif_lib_en+ "</br></br>");
							}
						}
					}
				}
			});
		}
		return false;
	})

	function fillListArg2(){
		var val = $('#listDebats2 option:selected').val();
		var page = "model/getDebatArg.php";

		if(val != '' && val != null ){
			$.ajax({
				url: "model/getDebatArg.php",
				async: true,
				type: 'post',
				data: {page: page, id: val},
				dataType: 'json',
				success: function (data) {
					var content = "";
					$("#listArgs2").empty();
					if (data !== null){
						var choixS = "A1a";
						for (var i in data) {
							if(data[i].arg_id == choixS ){
								content += "<option value ='" + data[i].arg_id + "' selected='selected'>" + data[i].arg_id + " : " + data[i].arg_lib_fr + " - " +  data[i].arg_lib_en + "</option>";
							}else{
								content += "<option value ='" + data[i].arg_id + "'>" + data[i].arg_id + " : " + data[i].arg_lib_fr + " - " +  data[i].arg_lib_en + "</option>";
							}
						}
					}
					$("#listArgs2").append(content);
					$('#listArgs2').comboSelect();
					$("#listArgs2").trigger("change");
				}
			});
		}else{
			maxCom = $("#maxCom").val();
			$("#listArgs2").empty();
			$("#arg_lib_fr").empty();
			$("#arg_lib_en").empty();
			for (nb=1; nb<=maxCom; nb++){
				$("#justif_lib_fr"+nb).empty();
				$("#justif_lib_en"+nb).empty();
			}
		}
		return false;
	}

	//window.onload = fillListArg2;

	$('#listDebats3').comboSelect();

	$('#listDebats3').on("change",function(e, v){
		fillListArg3();
		return false;
	});

	$('#listDebats3').on("click",function(e, v){
		$('.idx').text(e.target.selectedIndex)
		$('.val').text(e.target.value)
	});

	$('#listArgs3').on("change",function(e, v){
		var val = this.value;
		var page = "model/getArgInfo.php";
		if(val != '' && val != null ){
			$.ajax({
				url: "model/getArgInfo.php",
				async: false,
				type: 'post',
				data: {page: page, id: val},
				dataType: 'json',
				success: function (data) {
					if (data["argJustif"] != null && data["argT"] != null && data["maxCom"] != null){
						data1 = data["argT"];
						data2 = data["argJustif"];
						maxCom = data["maxCom"][0].nbCom;

						$("#maxCom").val(maxCom);
						$("#arg_lib_fr").empty();
						$("#arg_lib_en").empty();
						for (nb=1; nb<=maxCom; nb++){
							$("#justif_lib_en"+nb).empty();
						}
						for (var i in data1) {
							$("#arg_lib_fr").append(data1[i].arg_lib_fr);
							$("#arg_lib_en").append(data1[i].arg_lib_en);
						}
						var n = 0;
						for (var j in data2) {
							n ++;
							if(data2[j].justif_lib_en == null){
								$("#justif_lib_en"+n).justif_id.justif_lib_fr + " </bold>]</span> - not translated</br></br>");
							}
							else{
								$("#justif_lib_en"+n).justif_lib_en+ "</br></br>");
							}
						}
					}
				}
			});
		}
		return false;
	})

	function fillListArg3(){
		var val = $('#listDebats3 option:selected').val();
		var page = "model/getDebatArg.php";

		if(val != '' && val != null ){
			$.ajax({
				url: "model/getDebatArg.php",
				async: true,
				type: 'post',
				data: {page: page, id: val},
				dataType: 'json',
				success: function (data) {
					var content = "";
					$("#listArgs3").empty();
					if (data !== null){
						var choixS = "A1a";
						for (var i in data) {
							if(data[i].arg_id == choixS ){
								content += "<option value ='" + data[i].arg_id + "' selected='selected'>" + data[i].arg_id + " : " + data[i].arg_lib_fr + " - " +  data[i].arg_lib_en + "</option>";
							}else{
								content += "<option value ='" + data[i].arg_id + "'>" + data[i].arg_id + " : " + data[i].arg_lib_fr + " - " +  data[i].arg_lib_en + "</option>";
							}
						}
					}
					$("#listArgs3").append(content);
					$('#listArgs3').comboSelect();
					$("#listArgs3").trigger("change");
				}
			});
		}else{
			maxCom = $("#maxCom").val();
			$("#listArgs3").empty();
			$("#arg_lib_fr").empty();
			$("#arg_lib_en").empty();
			for (nb=1; nb<=maxCom; nb++){
				$("#justif_lib_fr"+nb).empty();
				$("#justif_lib_en"+nb).empty();
			}
		}
		return false;
	}


function start() {
  fillListArg2();
  fillListArg3();
}
window.onload = start;
});


