function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57 || (key == 127 || key == 32 ))
}
function sinSignos(e){
	var key = window.Event ? e.which : e.keyCode
	return ((key >= 65 && key <= 90)||(key >= 48 && key <= 57) || (key == 127 || key == 32 ) || (key >= 97 && key <= 122))
}
function soloLetras(e){
	var key = window.Event ? e.which : e.keyCode
	return ((key >= 65 && key <= 90) || (key == 127 || key == 32 ) || (key >= 97 && key <= 122))
}

function mayus(e) {
    e.value = e.value.toUpperCase();


}
