function obtenerTurno(empleado){

    

    var datos = new FormData();
	datos.append("empleado", empleado);

   

	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            // agregar 
            $("#nuevaTurno").val(respuesta["turno"]);
            $("#idEncargado").val(respuesta["id"]);

            // editar 
            $("#editarTurnoEditar").val(respuesta["turno"]);
            $("#idEncargadoEditar").val(respuesta["id"]);

		}

	});
}



function autocompletar(){
    const inputEncargado = document.querySelector("#encargado");
    let indexFocus = -1;
    if(inputEncargado !== undefined && inputEncargado !== null ){
        inputEncargado.addEventListener('input', function(){
            const encargado = this.value;
            if(!encargado){ return false;}
            cerrarLista();
            // creando lista de sugerencias 
            const divlist = document.createElement('div');
            divlist.setAttribute('id',this.id + '-lista-autocompletar');
            divlist.setAttribute('class', 'lista-autocompletar-items');
    
            this.parentNode.appendChild(divlist);
    
            // conexión a base de datos 
            httpRequest('ajax/maquina.ajax.php?encargado=' + encargado, function(){
               // console.log(this.responseText);
               const arreglo = JSON.parse(this.responseText);
                // avlidar el input contra el arreglo
                if(arreglo.length == 0){ return false;}
    
                arreglo.forEach(item => {
                    if(item.substr(0, encargado.length).toUpperCase() == encargado.toUpperCase()){
                        const elementoLista = document.createElement('div');
                        elementoLista.innerHTML  = `<strong>${item.substr(0, encargado.length)}</strong>${item.substr(encargado.length)}`;
                
                        
                        
                        
                        elementoLista.addEventListener('click',function(){
                            inputEncargado.value = this.innerText;
                            obtenerTurno(inputEncargado.value);
                        //    console.log("hola= "+inputEncargado.value);
                            cerrarLista();
                            return false;
                        });
    
                        divlist.appendChild(elementoLista);
                        
                    }
                });
    
            });
    
           
        });
    
        inputEncargado.addEventListener('keydown',function(e){
            const divlist = document.querySelector('#'+this.id +'-lista-autocompletar');
            let items;
            if(divlist){
                items = divlist.querySelectorAll('div');
    
                switch (e.keyCode) {
                    case 40: // tecla de abajo
                        indexFocus++;
                        if(indexFocus > items.length-1){
                            indexFocus = items.length -1;
                        }
                        break;
                    case 38: // tacla de arriba
                        indexFocus--;
                        if(indexFocus < 0){
                            indexFocus = 0;
                        }
                        break;
                    case 13: // presionas enter
                        e.preventDefault();
                        items[indexFocus].click();
                        indexFocus = -1;
                        break;
                
                    default:
                        break;
                }
    
                seleccionar(items, indexFocus);
                return false;
            }
        });
    
        document.addEventListener('click', function(){
            cerrarLista();
        });

    }
    

}

function autocompletarEditar(){
    const inputEncargado = document.querySelector("#editarEncargado");
    let indexFocus = -1;
    if(inputEncargado !== undefined && inputEncargado !== null ){
        inputEncargado.addEventListener('input', function(){
            const encargado = this.value;
            if(!encargado){ return false;}
            cerrarLista();
            // creando lista de sugerencias 
            const divlist = document.createElement('div');
            divlist.setAttribute('id',this.id + '-lista-autocompletar');
            divlist.setAttribute('class', 'lista-autocompletar-items');
    
            this.parentNode.appendChild(divlist);
    
            // conexión a base de datos 
            httpRequest('ajax/maquina.ajax.php?encargado=' + encargado, function(){
               // console.log(this.responseText);
               const arreglo = JSON.parse(this.responseText);
                // avlidar el input contra el arreglo
                if(arreglo.length == 0){ return false;}
    
                arreglo.forEach(item => {
                    if(item.substr(0, encargado.length).toUpperCase() == encargado.toUpperCase()){
                        const elementoLista = document.createElement('div');
                        elementoLista.innerHTML  = `<strong>${item.substr(0, encargado.length)}</strong>${item.substr(encargado.length)}`;
                
                        
                        
                        
                        elementoLista.addEventListener('click',function(){
                            inputEncargado.value = this.innerText;
                            obtenerTurno(inputEncargado.value);
                            cerrarLista();
                            return false;
                        });
    
                        divlist.appendChild(elementoLista);
                        
                    }
                });
    
            });
    
           
        });
    
        inputEncargado.addEventListener('keydown',function(e){
            const divlist = document.querySelector('#'+this.id +'-lista-autocompletar');
            let items;
            if(divlist){
                items = divlist.querySelectorAll('div');
    
                switch (e.keyCode) {
                    case 40: // tecla de abajo
                        indexFocus++;
                        if(indexFocus > items.length-1){
                            indexFocus = items.length -1;
                        }
                        break;
                    case 38: // tacla de arriba
                        indexFocus--;
                        if(indexFocus < 0){
                            indexFocus = 0;
                        }
                        break;
                    case 13: // presionas enter
                        e.preventDefault();
                        items[indexFocus].click();
                        indexFocus = -1;
                        break;
                
                    default:
                        break;
                }
    
                seleccionar(items, indexFocus);
                return false;
            }
        });
    
        document.addEventListener('click', function(){
            cerrarLista();
        });

    }


}

function seleccionar(items, indexFocus){
    if (!items || indexFocus == -1) {
        return false;
    }
    items.forEach(x =>{
       x.classList.remove('autocompletar-active');  
    });

    items[indexFocus].classList.add('autocompletar-active');
}
function cerrarLista(){
     const item = document.querySelectorAll('.lista-autocompletar-items');

     item.forEach(item =>{
         item.parentNode.removeChild(item);
     });
     indexFocus= -1;
}

function httpRequest(url, callback){
    const http = new XMLHttpRequest();
    http.open('GET', url);
    http.send();
    http.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            callback.apply(http);
        }
    }
}

autocompletar();

autocompletarEditar();

function mostarLineasEditar(){
    var datos = new FormData();
	datos.append("mostrarLineas", "");

   

	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#slcLineaEditar").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#slcLineaEditar").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                
            }
            
        

		}

	});

}



/*=============================================
EDITAR MAQUINA
=============================================*/
$(document).on("click", ".btnEditarMaquinas", function(){

	var nombrelinea = "";
    var encargado = "";
    var maquina = "";
    var fila = "";
    
	var idMaquina = $(this).attr("idMaquina");
    var idLinea = $(this).attr("idLinea");
	
    

	var datos = new FormData();
//	datos.append("idMaquina", idMaquina);
    datos.append("idMaquina", idLinea);

   

	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#slcLineaEditar").append('<option value="'+respuesta[0]["idLinea"]+'">'+respuesta[0]["linea"]+'</option>');
            $("#tbCrearLineaEditar tbody").html("");
            for (let i = 0; i < respuesta.length; i++) {
                var accion = '<button type="button" index="'+i+'"   class="btn btn-info btnQuitarLineaMaquinaEditar" idMaquina="'+respuesta[i]["idMaquina"]+'"><i class="fas fa-trash"></i></button>';;
                var btnLinea = '<button type="button" empleado="'+respuesta[i]["empleado"]+'" turno="'+respuesta[i]["turno"]+'" idUsuario="'+respuesta[i]["idUsuario"]+'" idMaquina="'+respuesta[i]["idMaquina"]+'" maquina="'+respuesta[i]["maquina"]+'" idMaquina="'+respuesta[i]["idMaquina"]+'" idLinea="'+respuesta[i]["idLinea"]+'" linea="'+respuesta[i]["linea"]+'" style="background: rgb(255 136 2); border: 0px solid ;"   class="btn btn-dark btnEditarLineaMaquina" name="" id="btn'+i+'"><i class="fas fa-pen"></i></button>'; 
                fila += '<tr>';
                
                fila += '<td>'+respuesta[i]["linea"]+'</td>';
                fila += '<td>'+respuesta[i]["maquina"]+'</td>';
                fila += '<td>'+respuesta[i]["empleado"]+'</td>';
                fila += '<td>';
                fila += '<div class="btn-group">';
                fila += accion;
                fila += btnLinea;
                fila += '</div>';
                fila += '</td>';
                fila += '</tr>';
                
            }
            $("#tbCrearLineaEditar tbody").html(fila);
            /*
            $("#editarNombre").val(respuesta["nombreMaquina"]);
            $("#editarEncargado").val(respuesta["nombre"]);
            $("#idMaquina").val(respuesta["idMaquina"]);
            */
            mostarLineasEditar();


		}

	});

});




/*=============================================
ELIMINAR Maquina
=============================================*/
$(document).on("click", ".btnEliminarMaquina", function(){

    var idUsuario = $(this).attr("idUsuario");
    var idMaquina = $(this).attr("idMaquina");
    var usuario = $(this).attr("usuario");
  
    Swal.fire({
      title: '¿Está seguro de borrar la maquina?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Maquina!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=maquinas&idUsuario="+idUsuario+"&usuario="+usuario+"&idMaquina="+idMaquina;
  
      }
  
    });
  
  });

  $(document).on("click", ".btnCodigoQR", function(){
      var idMaquina = $(this).attr('idMaquina');
      var nombreMaquina = $(this).attr('nombreMaquina');

      $("#codigosQr").attr("data","ajax/codigoQR.php?idMaquina="+idMaquina+"&nombreMaquina="+nombreMaquina);
  });



  
$(document).on("click", ".cerrarQR", function(){
    window.location = "maquinas";
});


$(document).on("click", "#agregarMaquinas", function(){
    var datos = new FormData();
	datos.append("mostrarLineas", "");

   

	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#slcLinea").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#slcLinea").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                
            }
            
        

		}

	});
});

/*
function buscarDuplicados(){
    var maquina = $("#nuevaMaquina").val();
    var datos = new FormData();
	datos.append("buscarDuplicados", "");
    datos.append("maquina", maquina);




	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            
            if(respuesta != false){
                duplicados = 1;

            }else{
                console.log(respuesta);
                duplicados = 0;
            }

		}

	});

    return duplicados;

}

*/
var arrogloMaquinas = [];
//var duplicados = "";
$(document).on("click", ".btnAgregarListas", function(){

    var idlinea = $("#slcLinea").val();
	var nombrelinea = document.getElementById("slcLinea");
	var lineaSelect = nombrelinea.options[nombrelinea.selectedIndex].text;
    var encargado = $("#encargado").val();
    var maquina = $("#nuevaMaquina").val();

    if(idlinea == ""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Selecciona una Línea, el campo no puede ir vacío.!',
			footer: ''
		});
    }else if(encargado == ""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ingresa un encargado, el campo no puede ir vacío.!',
			footer: ''
		});
    }else if(maquina == ""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ingresa una maquina, el campo no puede ir vacío.!',
			footer: ''
		});
    }else{

        const arrayMaquina = arrogloMaquinas.filter( m => m.maquina == maquina );
        
        if(arrayMaquina.length >= 1 ){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ya existe una maquina con el nombre: "'+ maquina + '" en la tabla de registro',
                footer: ''
            });
        }else{
            var datos = new FormData();
            datos.append("buscarDuplicados", "");
            datos.append("maquina", maquina);
        
        
        
        
            $.ajax({
        
                url:"ajax/maquina.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    
                    if(respuesta.length == 0){
                    //    console.log(respuesta);
                        arrogloMaquinas.push({
                            "idLinea": idlinea,
                            "nombrelinea": lineaSelect,
                            "empleado" : encargado,
                            "maquina": maquina 
                        });
            
            
            
                        var fila = "";
                        $("#tbCrearLinea tbody").html("");
                        for (let i = 0; i < arrogloMaquinas.length; i++) {
            
                            var accion = '<td><button type="button" index="'+i+'"   class="btn btn-info btnQuitarLineaMaquina" ><i class="fas fa-trash"></i></button></td>';
                    
                            fila += '<tr>';
                            fila += '<td>'+arrogloMaquinas[i]["nombrelinea"]+'</td>';
                            fila += '<td>'+arrogloMaquinas[i]["maquina"]+'</td>';
                            fila += '<td>'+arrogloMaquinas[i]["empleado"]+'</td>';
                            
                            fila += accion;
                            fila += '</tr>';
                            
                        }
            
                        $("#tbCrearLinea tbody").append(fila);
        
        
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ya existe una maquina con el nombre: "'+ maquina + '" Registrada',
                            footer: ''
                        });
                    }
        
                }
        
            });
        //    buscarDuplicados();
            /*
            if(duplicados == 0){

            }else{
   
            }
            */
        }



    
       

    }


//    $("#tbCrearLinea tbody").html("");
});


$(document).on("change","#slcLinea",function(){
    $("#slcLinea").prop('disabled', true);
});


$(document).on("click", ".btnguardarMaquina", function(){
    datosJson =	JSON.stringify(arrogloMaquinas);
    var idUsuario = $("#idEncargado").val();
    var datos = new FormData();
	datos.append("guardarMaquina", "");
    datos.append("datosMaquina", datosJson);
    datos.append("idUsuario", idUsuario);



	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            if(respuesta == "ok"){
                    Swal.fire({
                        title: '¡La Maquina ha sido Registrada correctamente!',
                        text: "",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        //  cancelButtonColor: '#d33',
                        //  cancelButtonText: 'Cancelar',
                        //  confirmButtonText: 'Si, borrar Categoría!'
                      }).then(function(result){
                        if(result.value){
                            window.location = "maquinas";
                        }
                      });
            }else if(respuesta == "error"){
                Swal.fire('Error interno');
            }
		}

	});


});


$(document).on("click", ".btnQuitarLineaMaquina", function(){
    let index = $(this).attr("index");
    var num_maquinaLista =  $(this).closest("tr");
//    console.log(arrogloMaquinas);
    Swal.fire({
        title: '¿Está seguro de borrar la maquina?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar maquina!'
      }).then(function(result){
		if(result.value){
			num_maquinaLista.remove();
            
			arrogloMaquinas.splice(index, 1);
//            console.log(arrogloMaquinas);
		}
	  });

});

$(document).on("click", ".btnEditarLineaMaquina", function(){
    var idmaquina = $(this).attr("idmaquina");
    var maquina = $(this).attr("maquina");
    var idlinea = $(this).attr("idlinea");
    var linea = $(this).attr("linea");
    var empleado = $(this).attr("empleado");
    var turno = $(this).attr("turno");
    var idusuario = $(this).attr("idusuario");
    $("#slcLineaEditar").html("");
    mostarLineasEditar();
   // $("#slcLineaEditar").append('<option value="" selected></option>');
    $("#slcLineaEditar").append('<option value="'+idlinea+'" selected>'+linea+'</option>');
    $("#editarEncargado").val(empleado);
    $("#editarTurnoEditar").val(turno);
    $("#idEncargadoEditar").val(idusuario);
    $("#editarNombre").val(maquina);
    $("#idMaquina").val(idmaquina);


});

var arrogloMaquinasEditar = [];
$(document).on("click", ".btnAgregarListasEditar", function(){
    var idmaquina = $("#idMaquina").val();
    var idlinea = $("#slcLineaEditar").val();
    var nombrelinea = document.getElementById("slcLineaEditar");
	var lineaSelect = nombrelinea.options[nombrelinea.selectedIndex].text;
    var idusuario = $("#idEncargadoEditar").val();;
    var maquina = $("#editarNombre").val();
    var encargado = $("#editarEncargado").val();

    arrogloMaquinasEditar.push({
        "idLinea": idlinea,
        "nombrelinea": lineaSelect,
        "empleado" : encargado,
        "maquina": maquina 
    });

    datosJsonEditar =	JSON.stringify(arrogloMaquinasEditar);

    if(idlinea == ""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Selecciona una Línea, el campo no puede ir vacío.!',
			footer: ''
		});
    }else if(encargado == ""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ingresa un encargado, el campo no puede ir vacío.!',
			footer: ''
		});
    }else if(maquina == ""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Ingresa una maquina, el campo no puede ir vacío.!',
			footer: ''
		});
    }else{
        var maquina = $("#editarNombre").val();


        var datos = new FormData();
        datos.append("buscarDuplicados", "");
        datos.append("maquina", maquina);
    
    
    
    
        $.ajax({
    
            url:"ajax/maquina.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta.length == 0){

                    var datos = new FormData();
                    datos.append("guardarMaquina", "");
                    datos.append("datosMaquina", datosJsonEditar);
                    datos.append("idUsuario", idusuario);
                
                
                
                    $.ajax({
                
                        url:"ajax/maquina.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(respuesta){
                            if(respuesta == "ok"){
                                    Swal.fire({
                                        title: '¡La Maquina ha sido Registrada correctamente!',
                                        text: "",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        //  cancelButtonColor: '#d33',
                                        //  cancelButtonText: 'Cancelar',
                                        //  confirmButtonText: 'Si, borrar Categoría!'
                                      }).then(function(result){
                                        if(result.value){
                                        //    window.location = "maquinas";
                                            mostrarDatosEditar();
                                            $("#slcLineaEditar").html("");
                                            mostarLineasEditar();
                                            $("#editarEncargado").val("");
                                            $("#editarTurnoEditar").val("");
                                            $("#idEncargadoEditar").val("");
                                            $("#editarNombre").val("");
                                        }
                                      });
                            }else if(respuesta == "error"){
                                Swal.fire('Error interno');
                            }
                        }
                
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya existe una maquina con el nombre: "'+ maquina + '" Registrada',
                        footer: ''
                    });
                }
            }
        });
        
    }

    


});

$(document).on("click", ".btnEditarLineaMaquinaUpdate", function(){
    var idmaquina = $("#idMaquina").val();
    var idLinea = $("#slcLineaEditar").val();
    var nombrelinea = document.getElementById("slcLineaEditar");
	var lineaSelect = nombrelinea.options[nombrelinea.selectedIndex].text;
    var idusuario = $("#idEncargadoEditar").val();
    var maquina = $("#editarNombre").val();


    var datos = new FormData();
    datos.append("buscarDuplicados", "");
    datos.append("maquina", maquina);




    $.ajax({

        url:"ajax/maquina.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta.length == 0){
                var datos = new FormData();
                datos.append("editarMaquina", "");
                datos.append("idLinea", idLinea);
                datos.append("nombre", maquina);
                datos.append("idUsuario", idusuario);
                datos.append("idmaquina", idmaquina);
            
            
            
                $.ajax({
            
                    url:"ajax/maquina.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){
                        if(respuesta == "ok"){
                                Swal.fire({
                                    title: '¡Se han aplicado los cambios correctamente!',
                                    text: "",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    //  cancelButtonColor: '#d33',
                                    //  cancelButtonText: 'Cancelar',
                                    //  confirmButtonText: 'Si, borrar Categoría!'
                                  }).then(function(result){
                                    if(result.value){
                                    //    window.location = "maquinas";
                                    
                                    mostrarDatosEditar();
                                    $("#slcLineaEditar").html("");
                                    mostarLineasEditar();
                                    $("#editarEncargado").val("");
                                    $("#editarTurnoEditar").val("");
                                    $("#idEncargadoEditar").val("");
                                    $("#editarNombre").val("");

                                    }
                                  });
                        }else if(respuesta == "error"){
                            Swal.fire('Error interno al aplicado los cambios');
                        }else if(respuesta == "errorSintaxis"){
                            Swal.fire('Los datos ingresados no puede ir vacío o llevar caracteres especiales');
                        }
                    }
            
                });

            }else{
                /*
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ya existe una maquina con el nombre: "'+ maquina + '" Registrada',
                    footer: ''
                });
                */
                Swal.fire({
                    title: '¡Ya existe una maquina con el nombre: "'+ maquina + '" Registrada!',
                    text: "¡Si no lo está puede cancelar la accíón!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, Aplicar cambios!'
                  }).then(function(result){
                    if(result.value){
                        var datos = new FormData();
                        datos.append("editarMaquina", "");
                        datos.append("idLinea", idLinea);
                        datos.append("nombre", maquina);
                        datos.append("idUsuario", idusuario);
                        datos.append("idmaquina", idmaquina);
                    
                    
                    
                        $.ajax({
                    
                            url:"ajax/maquina.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(respuesta){
                                if(respuesta == "ok"){
                                        Swal.fire({
                                            title: '¡Se han aplicado los cambios correctamente!',
                                            text: "",
                                            icon: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            //  cancelButtonColor: '#d33',
                                            //  cancelButtonText: 'Cancelar',
                                            //  confirmButtonText: 'Si, borrar Categoría!'
                                          }).then(function(result){
                                            if(result.value){
                                            //    window.location = "maquinas";
                                            
                                            mostrarDatosEditar();
                                            $("#slcLineaEditar").html("");
                                            mostarLineasEditar();
                                            $("#editarEncargado").val("");
                                            $("#editarTurnoEditar").val("");
                                            $("#idEncargadoEditar").val("");
                                            $("#editarNombre").val("");
        
                                            }
                                          });
                                }else if(respuesta == "error"){
                                    Swal.fire('Error interno al aplicado los cambios');
                                }else if(respuesta == "errorSintaxis"){
                                    Swal.fire('Los datos ingresados no puede ir vacío o llevar caracteres especiales');
                                }
                            }
                    
                        });
                    }
                  });
            }

        }
    });



});


function mostrarDatosEditar(){
    var idmaquina = $("#slcLineaEditar").val();
//    var idmaquina = $("#idMaquina").val();
 
    var fila = "";
	var datos = new FormData();
	datos.append("idMaquina", idmaquina);

   

	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
         
            $("#tbCrearLineaEditar tbody").html("");
            for (let i = 0; i < respuesta.length; i++) {
                var accion = '<button type="button" index="'+i+'"    class="btn btn-info btnQuitarLineaMaquinaEditar" idMaquina="'+respuesta[i]["idMaquina"]+'" idMaquina="'+respuesta[i]["idMaquina"]+'"><i class="fas fa-trash"></i></button>';;
                var btnLinea = '<button type="button" empleado="'+respuesta[i]["empleado"]+'" turno="'+respuesta[i]["turno"]+'" idUsuario="'+respuesta[i]["idUsuario"]+'" idMaquina="'+respuesta[i]["idMaquina"]+'" maquina="'+respuesta[i]["maquina"]+'" idMaquina="'+respuesta[i]["idMaquina"]+'" idLinea="'+respuesta[i]["idLinea"]+'" linea="'+respuesta[i]["linea"]+'" style="background: rgb(255 136 2); border: 0px solid ;"   class="btn btn-dark btnEditarLineaMaquina" name="" id="btn'+i+'"><i class="fas fa-pen"></i></button>'; 
                fila += '<tr>';
                
                fila += '<td>'+respuesta[i]["linea"]+'</td>';
                fila += '<td>'+respuesta[i]["maquina"]+'</td>';
                fila += '<td>'+respuesta[i]["empleado"]+'</td>';
                fila += '<td>';
                fila += '<div class="btn-group">';
                fila += accion;
                fila += btnLinea;
                fila += '</div>';
                fila += '</td>';
                fila += '</tr>';
                
            }
            $("#tbCrearLineaEditar tbody").html(fila);
            /*
            $("#editarNombre").val(respuesta["nombreMaquina"]);
            $("#editarEncargado").val(respuesta["nombre"]);
            $("#idMaquina").val(respuesta["idMaquina"]);
            */



		}

	});
}

$(document).on("click",".btnQuitarLineaMaquinaEditar",function(){
    var idMaquina = $(this).attr("idmaquina");
    Swal.fire({
        title: '¿Está seguro de borrar la maquina?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar Maquina!'
      }).then(function(result){
    
        if(result.value){
            var datos = new FormData();
            datos.append("EliminarMaquina", "");
            datos.append("idmaquina", idMaquina);
        
        
        
            $.ajax({
        
                url:"ajax/maquina.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    if(respuesta == "ok"){
                            Swal.fire({
                                title: '¡Se eliminado correctamente!',
                                text: "",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                //  cancelButtonColor: '#d33',
                                //  cancelButtonText: 'Cancelar',
                                //  confirmButtonText: 'Si, borrar Categoría!'
                              }).then(function(result){
                                if(result.value){
                                //    window.location = "maquinas";
                                
                                mostrarDatosEditar();
                                $("#slcLineaEditar").html("");
                                mostarLineasEditar();
                                $("#editarEncargado").val("");
                                $("#editarTurnoEditar").val("");
                                $("#idEncargadoEditar").val("");
                                $("#editarNombre").val("");

                                }
                              });
                    }else if(respuesta == "error"){
                        Swal.fire('Error interno al aplicado los cambios');
                    }
                }
        
            });
        }
    
      });
    
});

$(document).on("click", ".cerrarMaquinas", function(){
    window.location = "maquinas";
});
