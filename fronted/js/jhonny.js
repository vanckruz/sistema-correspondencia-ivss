$(document).on("ready",function(){
	$("#ver").load("http://localhost/Cor_ivss/index.php/verOficios");
	//caja_tabla
	//tabla_general
	$("#crear_cor").load("http://localhost/Cor_ivss/index.php/ingresoCorrespondencia");
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
		
	//$("#CrearCorrespondencia").serialize();	

//var cont=0;
		
$("#mas_file").on("click",function(e){
	e.preventDefault();
		//cont++;
function agregar(){
var file="<div class='cuanto'><div class='inner-addon left-addon'>";
file+="<i class='glyphicon glyphicon-folder-open'></i>";
file+="<input type='file' name='archivo[]'";
file+=" class='form-control' style='padding-bottom:10px;'></div></div>";

 var nuevo_file=$(file);
  $("#archive").append(nuevo_file);
	}
	
	if($(".cuanto").length <= 9){
		agregar();
		console.log($(".cuanto").length);
	}else{
		$("#mas_file").off("click",agregar);
		}
});

		$("#menos_file").on("click",function(e){
			e.preventDefault();
			if($(".cuanto").length > 1){
			$(".cuanto:last").remove();
			}
		});
/*Fin*/
});