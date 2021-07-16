/*=============================================
SUBIENDO LA FOTO DE LA PIEZA
=============================================*/

$(".foto").change(function(){
    var imagen = this.files[0];

    /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        
        $(".foto").val("");

        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
          });
        
    }else if(imagen["size"] > 6000000){
        $(".foto").val("");

        
  		Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 5MB!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
          });
    }else{

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
});

/*=============================================
AUTOCOMPLETAR MODELO
=============================================*/

function autocompletar(){
    const inputModelo = document.querySelector("#nuevoModelo");

    let indexFocus = -1;
    if(inputModelo){
        inputModelo.addEventListener('input', function(){
            const modelo = this.value;
            if(!modelo){ return false;}
            cerrarLista();
            // creando lista de sugerencias 
            const divlist = document.createElement('div');
            divlist.setAttribute('id',this.id + '-lista-autocompletar');
            divlist.setAttribute('class', 'lista-autocompletar-items');
    
            this.parentNode.appendChild(divlist);
    
            // conexión a base de datos 
            httpRequest('ajax/piezas.ajax.php?modelo=' + modelo, function(){
               // console.log(this.responseText);
               const arreglo = JSON.parse(this.responseText);
                // avlidar el input contra el arreglo
                if(arreglo.length == 0){ return false;}
    
                arreglo.forEach(item => {
                    if(item.substr(0, modelo.length) == modelo){
                        const elementoLista = document.createElement('div');
                        elementoLista.innerHTML  = `<strong>${item.substr(0, modelo.length)}</strong>${item.substr(modelo.length)}`;
                
                        
                        
                        
                        elementoLista.addEventListener('click',function(){
                            inputModelo.value = this.innerText;
                            cerrarLista();
                            return false;
                        });
    
                        divlist.appendChild(elementoLista);
                        
                    }
                });
    
            });
    
           
        });
    
        inputModelo.addEventListener('keydown',function(e){
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

$(document).on("click", "#agregarColorp", function(){
    agregarColor();
});
const  arregloColor = [];
const  arregloTalla = [];

function agregarColor(){
    
    var color = $("#color").val();
//    var verificarColores = verificarColor(color);
        var datos = new FormData();
            
    datos.append("verificarColor", "");
    datos.append("color", color);

    
    $.ajax({

        url:"ajax/piezas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta != false){
                if(color != ""){
                    arregloColor.push(color);
                    var duplicados = repetido(arregloColor, color);
                    
                    
                    if(duplicados >= 1 ){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El color ya se encuentra en la lista.!',
                            footer: ''
                          });
                    }else{
                        var fila = '<tr id="fila'+color+'">';
                        fila = fila + '<td>';
                        fila = fila + '<div>';
                        fila = fila + '<input type="text" class="form-control color" placeholder="Color"  name="colores[]" value="'+color+'" readonly>';
                        fila = fila + '</div>';
                    
                        fila = fila + '</td>';
                    
                        fila = fila + '<td class="text-center">';
                    
                      //  fila = fila + '<button type="button" class="btn btn-danger" onClick="eliminarFila('+this+')">Eliminar</button>';
                        fila = fila + '<input type="button" class="btn btn-danger" id="eliminarFilaColor" color="'+color+'"  value="Eliminar">';
                    
                        fila = fila + '</td>';
                    
                        fila = fila + '</tr>';
                    
                        $("#tbColor").append(fila);
                    
                        $("#color").val("");
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No ingreso color.!',
                        footer: ''
                      });
                }
            }else{
                Swal.fire('El color no está registrado');
            }
            
        }
    });


      
}



$(document).on("click", ".cerrar", function(){
    window.location = "piezas";
});



$(document).on("click", "#agregarTalla", function(){
    agregarTalla();
});

function agregarTalla(){
    
    var talla = $("#nuevotalla").val();
    if(talla != ""){
        arregloTalla.push(talla);
        var duplicados = repetido(arregloTalla, talla);

        if(duplicados >= 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La talla ya se encuentra en la lista.!',
                footer: ''
              });
        }else{
            var fila = '<tr id="fila'+talla+'">';
            fila = fila + '<td>';
            fila = fila + '<div>';
            fila = fila + '<input type="text" class="form-control talla" placeholder="talla"  name="tallas[]" value="'+talla+'" readonly>';
            fila = fila + '</div>';
        
            fila = fila + '</td>';
        
            fila = fila + '<td class="text-center">';
        
          //  fila = fila + '<button type="button" class="btn btn-danger" onClick="eliminarFila('+this+')">Eliminar</button>';
            fila = fila + '<input type="button" class="btn btn-danger" id="eliminarFilaTallas" talla="'+talla+'"  value="Eliminar">';
        
            fila = fila + '</td>';
        
            fila = fila + '</tr>';
        
            $("#tbTalla").append(fila);
        
            $("#nuevotalla").val("");
        }


    }else{
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No ingreso talla.!',
            footer: ''
          });
    }

    
}

$(document).on("click", "#eliminarFilaColor", function(){
    /*
    var color = $("#Color").val();
    var id = $("#fila"+color).id; 
    console.log(id);
    */
   var color = $(this).attr('color');
   $(this).closest("tr").remove();
   eliminarArray(arregloColor, color);
  //  $("#fila").remove();
});

$(document).on("click", "#eliminarFilaTallas", function(){
    var talla = $(this).attr('talla');

    $(this).closest("tr").remove();
    eliminarArray(arregloTalla, talla);

});

$(document).on("click", "#eliminarFilaModelo", function(){
    $(this).closest("tr").remove();
});



/*
$(document).on("click", "#tbColor", function(){
    
   
    $("tr").click(function(){
       var id = $(this).attr("id");
        $("#"+id).remove();
    });


});

*/


function autocompletarColor(){

    $( document ).ready(function() {
        const inputColor = document.querySelector(".color");
    let indexFocus = -1;
    if(inputColor){
        inputColor.addEventListener('input', function(){
            const color = this.value;
            if(!color){ return false;}
            cerrarLista();
            // creando lista de sugerencias 
            const divlist = document.createElement('div');
            divlist.setAttribute('id',this.id + '-lista-autocompletar');
            divlist.setAttribute('class', 'lista-autocompletar-items');
    
            this.parentNode.appendChild(divlist);
    
            // conexión a base de datos 
            httpRequest('ajax/colores.ajax.php?color=' + color, function(){
               // console.log(this.responseText);
               const arreglo = JSON.parse(this.responseText);
                // avlidar el input contra el arreglo
                
                if(arreglo.length == 0){ return false;}
    
                arreglo.forEach(item => {
                    
                    if(item.substr(0, color.length).toUpperCase() == color.toUpperCase()){
                        
                        const elementoLista = document.createElement('div');
                        elementoLista.innerHTML  = `<strong>${item.substr(0, color.length)}</strong>${item.substr(color.length)}`;
                
                        
                        
                        
                        elementoLista.addEventListener('click',function(){
                            inputColor.value = this.innerText;

                            cerrarLista();
                            return false;
                        });
                        
                        divlist.appendChild(elementoLista);
                        
                    }
                });
    
            });
    
           
        });
    
        inputColor.addEventListener('keydown',function(e){
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
    });
    

}


// editar pieza

$(document).on("click", ".btnEditarPieza", function(){
    var idPieza = $(this).attr('idPieza');
    

     
    var datos = new FormData();

    datos.append("idPieza", idPieza);

    $.ajax({

		url:"ajax/piezas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#idPieza").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarPorMinuto").val(respuesta["porMin"]);
            $("#editarModelo").val(respuesta["nombreModelo"]);
            $("#editartalla").val(respuesta["talla"]);
            $("#editarPrecio").val(respuesta["precio"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#imagen").attr("src",respuesta["foto"]); 
            $("#fotoActual").val(respuesta["foto"]);

            mostrarColores(idPieza);
            mostrarTallas(idPieza);


		}

	});
});

function mostrarColores(idPieza){

    var datos = new FormData();
    datos.append("idPiezaC", idPieza);


    $.ajax({

		url:"ajax/piezas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            let i = 0;
            for (i;  i < respuesta.length; i++ ) {
                if(respuesta[i]["nombre"] != undefined && respuesta[i]["nombre"] != null){
                    arregloColores.push(respuesta[i]["nombre"]);
                    var fila = '<tr id="fila">';
                    fila = fila + '<td>';
                    fila = fila + '<div>';
                    fila = fila + '<input type="text" class="form-control color" placeholder="Color"  name="colores[]" value="'+respuesta[i]["nombre"]+'" readonly>';
                    fila = fila + '</div>';
                
                    fila = fila + '</td>';
                
                    fila = fila + '<td class="text-center">';
                
                    fila = fila + '<input type="button" class="btn btn-danger eliminarFilaColoreditar" idColorPieza="'+respuesta[i]["idColorPieza"]+'" color= "'+respuesta[i]["nombre"]+'"  value="Eliminar">';
                
                    fila = fila + '</td>';
                
                    fila = fila + '</tr>';
                
                    $("#tbColorEditar").append(fila);
                }

            }

            i = 0;
            
            
		}

	});
}

function mostrarTallas(idPieza){

    var datos = new FormData();
    datos.append("idPiezaT", idPieza);


    $.ajax({

		url:"ajax/piezas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#tbTallaEditar").html(""); 
            for (let index = 0; index < respuesta.length; index++) {
                arregloTallas.push(respuesta[index]["talla"]);
                var fila = '<tr>';
                fila = fila + '<td>';
                fila = fila + '<div>';
                fila = fila + '<input type="text" class="form-control talla" placeholder="talla"  name="tallasEditar[]" value="'+respuesta[index]["talla"]+'" readonly>';
                fila = fila + '</div>';
            
                fila = fila + '</td>';
            
                fila = fila + '<td class="text-center">';
            
            //  fila = fila + '<button type="button" class="btn btn-danger" onClick="eliminarFila('+this+')">Eliminar</button>';
                fila = fila + '<input type="button" class="btn btn-danger eliminarFilaTallasEditar" idTalla="'+respuesta[index]["idTalla"]+'" talla="'+respuesta[index]["talla"]+'"  value="Eliminar">';
            
                fila = fila + '</td>';
            
                fila = fila + '</tr>';
            
                $("#tbTallaEditar").append(fila);  
                
            }
                     
		}

	});
}

const  arregloColores = [];
const  arregloTallas = [];
function agregarColores(){

    
    var color = $("#coloresEditar").val();
    var datos = new FormData();
            
    datos.append("verificarColor", "");
    datos.append("color", color);

    
    $.ajax({

        url:"ajax/piezas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta != false){
                if(color != ""){
                    arregloColores.push(color);
                    var duplicados = repetido(arregloColores, color);
            
                    if(duplicados >= 1){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El color ya se encuentra en la lista.!',
                            footer: ''
                          });
                    }else{
                        var fila = '<tr id="fila">';
                        fila = fila + '<td>';
                        fila = fila + '<div>';
                        fila = fila + '<input type="text" class="form-control color" placeholder="Color"  name="colores[]" value="'+color+'" readonly>';
                        fila = fila + '</div>';
                
                        fila = fila + '</td>';
                
                        fila = fila + '<td class="text-center">';
                
                        fila = fila + '<input type="button" class="btn btn-danger eliminarFilaColoreditar" color="'+color+'"  value="Eliminar">';
                
                        fila = fila + '</td>';
                
                        fila = fila + '</tr>';
                
                        $("#tbColorEditar").append(fila);
                
                        $("#coloresEditar").val("");
                    }
            
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No ingreso color!',
                        footer: ''
                      })
                }

            }else{
                Swal.fire('El color no está registrado');
            }
        }
    });
    

    
    
}

function verificarColor(color){
    var  verificarColores;
    var datos = new FormData();
            
    datos.append("verificarColor", "");
    datos.append("color", color);

    
    $.ajax({

        url:"ajax/piezas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta == false){
                Swal.fire('El color no está registrado');
                verificarColores = respuesta; 
                console.log(respuesta);
            }
            
        }
    });

    return verificarColores;
}


$(document).on("click", "#editarColor", function(){
    agregarColores();
});

$(document).on("click", ".eliminarFilaColoreditar", function(){
    var idColorPieza = $(this).attr("idcolorpieza");
    var color = $(this).attr("color");
    var tabla = $(this).closest("tr");
    Swal.fire({
        title: '¿Está seguro de borrar el color?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Color!'
    }).then(function(result) {

        if (result.value) {

            //  $(this).closest("tr").remove();
            var datos = new FormData();
            
            datos.append("idColorPieza", idColorPieza);

            
            $.ajax({

                url:"ajax/piezas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    
                    if(respuesta["estatus"] == "ok"){
                        tabla.remove();
                        eliminarArray(arregloColores, color);
                    }
                }
            });
            
            
        }

    });
  
});


function autocompletarColorEditar(){

    $( document ).ready(function() {
        
        const inputColor = document.querySelector("#coloresEditar");
    let indexFocus = -1;
    if(inputColor){
        inputColor.addEventListener('input', function(){
            const color = this.value;
            if(!color){ return false;}
            cerrarLista();
            // creando lista de sugerencias 
            const divlist = document.createElement('div');
            divlist.setAttribute('id',this.id + '-lista-autocompletar');
            divlist.setAttribute('class', 'lista-autocompletar-items');
    
            this.parentNode.appendChild(divlist);
    
            // conexión a base de datos 
            httpRequest('ajax/colores.ajax.php?color=' + color, function(){
               // console.log(this.responseText);
               const arreglo = JSON.parse(this.responseText);
                // avlidar el input contra el arreglo
                if(arreglo.length == 0){ return false;}
    
                arreglo.forEach(item => {
                    if(item.substr(0, color.length).toUpperCase() == color.toUpperCase()){
                        const elementoLista = document.createElement('div');
                        elementoLista.innerHTML  = `<strong>${item.substr(0, color.length)}</strong>${item.substr(color.length)}`;
                
                        
                        
                        
                        elementoLista.addEventListener('click',function(){
                            inputColor.value = this.innerText;

                            cerrarLista();
                            return false;
                        });
    
                        divlist.appendChild(elementoLista);
                        
                    }
                });
    
            });
    
           
        });
    
        inputColor.addEventListener('keydown',function(e){
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
    });
    

}

function cerrarLista(){
    const item = document.querySelectorAll('.lista-autocompletar-items');

    item.forEach(item =>{
        item.parentNode.removeChild(item);
    });
    indexFocus= -1;
}   

autocompletar();

autocompletarColor();
autocompletarColorEditar();


// eliminar
$(document).on('click', '.btnEliminarPieza', function(){
    var idPieza = $(this).attr('idPieza');
    var foto = $(this).attr('fotoPieza');
    var nombre = $(this).attr('nombre');

    Swal.fire({
        title: '¿Está seguro de borrar la Modelo?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar Modelo!'
      }).then(function(result){
    
        if(result.value){
    
          window.location = "index.php?ruta=piezas&idPieza="+idPieza+"&fotoPieza="+foto+"&nombre="+nombre;
    
        }
    
      });
});




$(document).on("click", ".eliminarFilasModeloEdi", function(){
    var idPieza = $("#EditaridPieza").val();
    var modelo = $(this).attr("modelo");
    var idModelo = $(this).attr("idmodal");
    var idpiezaModelo = $(this).attr("idpiezaModelo");

    Swal.fire({
        title: '¿Está seguro de borrar el Modelo?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar Modelo!'
      }).then(function(result){
    
        if(result.value){
            var datos = new FormData();

            datos.append("idpiezaModelo", idpiezaModelo);
            /*
            $.ajax({

                url:"ajax/piezas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    console.log(respuesta);
                    if(respuesta){
                        $(this).closest("tr").remove();
                    }
                }
            });
            */
        }
    
      });
});



function agregarTallaEditar(){
    
    var talla = $("#editartalla").val();

    if(talla != ""){

        arregloTallas.push(talla);
        var duplicados = repetido(arregloTallas, talla);

        if(duplicados >= 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La talla ya se encuentra en la lista.!',
                footer: ''
              });
        }else{
            var fila = '<tr id="fila'+talla+'">';
            fila = fila + '<td>';
            fila = fila + '<div>';
            fila = fila + '<input type="text" class="form-control talla" placeholder="talla"  name="tallasEditar[]" value="'+talla+'" readonly>';
            fila = fila + '</div>';
        
            fila = fila + '</td>';
        
            fila = fila + '<td class="text-center">';
        
          //  fila = fila + '<button type="button" class="btn btn-danger" onClick="eliminarFila('+this+')">Eliminar</button>';
            fila = fila + '<input type="button" class="btn btn-danger eliminarFilaTallasEditar" talla="'+talla+'"   value="Eliminar">';
        
            fila = fila + '</td>';
        
            fila = fila + '</tr>';
        
            $("#tbTallaEditar").append(fila);
        
            $("#editartalla").val("");

        }


    }else{
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No ingreso talla!',
            footer: ''
          });
    }

    
}

$(document).on("click", ".eliminarFilaTallasEditar", function(){
    var idTallaPieza = $(this).attr("idtalla");
    var talla = $(this).attr("talla");
    var tabla = $(this).closest("tr");
    Swal.fire({
        title: '¿Está seguro de borrar la talla?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar talla!'
      }).then(function(result){
    
        if(result.value){
    
            var datos = new FormData();
            
            datos.append("idTallaPieza", idTallaPieza);

            
            $.ajax({

                url:"ajax/piezas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    
                    if(respuesta["estatus"] == "ok"){
                        tabla.remove();
                        eliminarArray(arregloTallas, talla);
                    }
                }
            });
    
        }
    
      });
});

function repetido(array, buscar) {

    if(array.length > 1){
        for (let index = 0; index < array.length-1; index++) {
        //    console.log(array[index]);
            if(array[index] == buscar){
                return 1;
            }
        }
    }else{
        return 0;
    }    
}

function eliminarArray(array, buscar) {
  
    for (let i = 0; i < array.length; i++) {
        if(array[i].toUpperCase() == buscar.toUpperCase() ){
            array.splice(i, 1);
        }
        
    }

}

$(document).on("change","#nuevoNombre", function(){
    var pieza = $(this).val(); 
    var datos = new FormData();
    datos.append("obtenerPieza","");
    datos.append("pieza",pieza);
    $.ajax({

		url:"ajax/piezas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            if(respuesta != ""){
                Swal.fire('El nombre del modelo ya se encuentra registrado');
                $("#nuevoNombre").val("");
            }
            
		}

	});
});




$(document).on("click", "#btnEditarTalla", function(){
    var idPieza = $("#idPieza").val();
    var talla = $("#editartalla").val();
    
    var datos = new FormData();
    datos.append("insertTalla","");
    datos.append("idPiezaEditar",idPieza);
    datos.append("talla",talla);
    $.ajax({
		url:"ajax/piezas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            console.log("hola");
            if(respuesta == "ok"){
                Swal.fire('La talla se a registrado con éxito');
                $("#editartalla").val("");
                mostrarTallas(idPieza);
            }
        //    
            
		}

	});    
});

