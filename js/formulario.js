$(document).ready(function(){

/*****En formulario, se guardan todos los imputs que hay en el
  mismo. Se tiene que indicar el nombre del formulario, no sirve
  con su class. No entiendo por que???*/
  var formulario = document.formulario_registro; 
  var elementosForm = formulario.elements;
  var nombre;

  //Funciones

  function validarInputs(){
    for (var i = 0; i < elementosForm.length; i++) {
        if (elementosForm[i].type == "text" || elementosForm[i].type == "email" || elementosForm[i].type == "password"){
          if (elementosForm[i].value == "") {
            console.log("El campo " + elementosForm[i].name + " esta incompleto")
            elementosForm[i].className = elementosForm[i].className + " errorForm";
            return false;

          }else{
            elementosForm[i].className = elementosForm[i].className.replace(" errorForm", ""); //Remplaza errorForm por "" (por nada)
          }
        }
      }
        if(elementosForm.pass.value != elementosForm.pass2.value){
          elementosForm.pass.className = elementosForm.pass.className = " errorForm";
          elementosForm.pass2.className = elementosForm.pass2.className = " errorForm";
          console.log("Los campos password no son iguales")
          return false;
        
        }else{
          elementosForm.pass.className = elementosForm.pass.className.replace(" errorForm", "");
          elementosForm.pass2.className = elementosForm.pass2.className.replace(" errorForm", "");
          
        }
      
      return true;
  };
 

   var validarCheckbox = function() {
    var opciones = document.getElementsByName('terminos');
    var resultado = false;

    for (var i = 0; i < elementosForm.length; i++) {
      
      if (elementosForm[i].type == "checkbox") {

        for (var o = 0; o < opciones.length; o++) {
          if (opciones[o].checked) {
            resultado = true;
            break;
          }
        }

        if (resultado == false) {
          elementosForm[i].parentElement/*o .parentNode*/.className = elementosForm[i].parentNode.className + " errorForm";
          console.log('Los terminos no han sido aceptados');
          return false;
          
        } else {
          // Eliminamos la clase Error del radio button
          elementosForm[i].parentElement/*o .parentNode*/.className = elementosForm[i].parentNode.className.replace(" errorForm", "");
          return true;
        }
      }
    }
  };

  var enviar = function(e){
    if(!validarInputs()){ //Es lo mismo que poner: valudarInputs == false
      console.log("Falta validar los inputs");
      e.preventDefault();

    }else if(!validarCheckbox()){
      console.log("Falto validar los Checkbox");
      e.preventDefault();
    
    }else{
      console.log("Envia los datos correctamente");
    }
  };


  //Funciones Blur y Focus

  function focusInput(){

    /*Cuando se hace focus en los input; se selecciona el elemento padre (su div), 
    y luego se le indica que el elemento hijo que está en la posición 1 (su label)
    y lo desplaza hacia arriba aplicandole la clase desplazLabelForm*/
    this.parentElement.children[1].className = ("labelForm desplazLabelForm");
//*************por que no se puede poner: this.parentElement.children[1].addClass("desplazLabelForm") ????;
    this.className = this.parentElement.children[0].className.replace("errorForm", "");
  };

  function blurInput(){
    if(this.value == ""){
      this.parentElement.children[1].className = ("labelForm");; 
      this.parentElement.children[0].className = this.parentElement.children[0].className + "errorForm";
    }
  };


  //Eventos

  formulario.addEventListener("submit", enviar);

  for (var i = 0; i < elementosForm.length; i++) {
    if (elementosForm[i].type == "text" || elementosForm[i].type == "email" || elementosForm[i].type == "password") {
      elementosForm[i].addEventListener("focus", focusInput);
      elementosForm[i].addEventListener("blur", blurInput);
    }
  }
});