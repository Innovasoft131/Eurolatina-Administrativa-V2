function autocompletarColorCombinacion(){

    $( document ).ready(function() {
        const inputColor = document.querySelector(".conbinacionColor");
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
            httpRequest('ajax/piezas.ajax.php?color=' + color, function(){
               
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



autocompletarColorCombinacion();


var combinaciones = [];
$(document).on("click", ".btnAgregarConbinacion", function(){
    var nombreConbinacion = $("#nuevoConbinacion").val();
    var nombreColorC = $("#nombreColorC").val();

    const arrayCombinacion = combinaciones.filter( m => m.nombreColor == nombreColorC );

    if(arrayCombinacion.length >= 1){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ya existe un color con el nombre: "'+ nombreColorC + '" en la tabla de registro',
            footer: ''
        });
    }else{
        combinaciones.push({
            "nombreColor" : nombreColorC
        });

        mostrarConbinacion();
        $("#nombreColorC").val("")

    }
    


});



$(document).on("click", ".btnGuardarConbinacion", function(){
    var nombreConbinacion = $("#nuevoConbinacion").val();
    var jsonCombinaciones = JSON.stringify(combinaciones);
    var datos = new FormData();
    datos.append("guardarConbinacion", "");
    datos.append("nombreConbinacion", nombreConbinacion);
    datos.append("nombreColorC", jsonCombinaciones);

    $.ajax({

        url: "ajax/combinacion.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if(respuesta == "ok"){
                Swal.fire({
                    title: '¡El color ha sido Registrada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Cancelar',
                    //  confirmButtonText: 'Si, borrar Categoría!'
                  }).then(function(result){
                    if(result.value){
                        window.location = "combinacion";
                    }
                  });

            //    mostrarConbinacion();

            }else if(respuesta == "error"){
                Swal.fire('Error interno');
            }else if(respuesta == "errorSintaxis"){
                Swal.fire('Los datos ingresados no puede ir vacío o llevar caracteres especiales');
            }


        }

    });
});


function mostrarConbinacion(){

    var fila = "";
    $("#tbConbinacionColor tbody").html("");
    for (let i = 0; i < combinaciones.length; i++) {
        var accion = '<td><button type="button" index="'+i+'"   class="btn btn-info btnQuitarCombinacion" ><i class="fas fa-trash"></i></button></td>';
        fila += '<tr>';
        fila += '<td>'+combinaciones[i]["nombreColor"]+'</td>';
        fila += accion;
        fila += '</tr>';
    }
    $('#tbConbinacionColor tbody').append(fila);
}

$(document).on("click", ".btnQuitarCombinacion", function(){
    let index = $(this).attr("index");
    var num_color =  $(this).closest("tr");

    Swal.fire({
        title: '¿Está seguro de borrar el color?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar color!'
      }).then(function(result){
		if(result.value){
			num_color.remove();
            
			combinaciones.splice(index, 1);

		}
	  });

});

$(document).on("click", ".btnAgregarCombinacionColor", function(){
    $("#nuevoConbinacion").val("Com");
});


$(document).on("click",".btnEditarColorCombinar", function(){
    var idCombinacion = $(this).attr("idcombinacion");
    var nombreCombinacion = $(this).attr("combinacion");

    $("#idCombinacion").val(idCombinacion);
    $("#editarColorCombinacion").val(nombreCombinacion);

    mostrarConbinacionColor();
});


function mostrarConbinacionColor(){
    var idColor = $("#idCombinacion").val();
    var fila = "";
    var datos = new FormData();
    datos.append("obtenerColores", "");
    datos.append("idCombinacion", idColor);

    $.ajax({

        url: "ajax/combinacion.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            
            $("#tbConbinacionColorEditar tbody").html("");
            for (let i = 0; i < respuesta.length; i++) {
                var accion = '<td><button type="button" idCombinacion="'+respuesta[i]["id"]+'"   class="btn btn-info btnQuitarCombinacion" ><i class="fas fa-trash"></i></button></td>';
                fila += '<tr>';
                fila += '<td>'+respuesta[i]["nombre"]+'</td>';
                fila += accion;
                fila += '</tr>';
            }
            $('#tbConbinacionColorEditar tbody').append(fila);

        }

    });

}

function autocompletarColorCombinacionEditar(){
    
    $( document ).ready(function() {
        const inputColor = document.querySelector("#EditarnombreColorC");
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
            httpRequest('ajax/piezas.ajax.php?color=' + color, function(){
              
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
autocompletarColorCombinacionEditar();



$(document).on("click", ".btnAgregarConbinacionEditar", function(){
    var idColor = $("#idCombinacion").val();
    var nombreColor = $("#EditarnombreColorC").val();

    var datos = new FormData();
    datos.append("guardarConbinacionEditar", "");
    datos.append("idColor", idColor);
    datos.append("nombreColor", nombreColor);

    $.ajax({

        url: "ajax/combinacion.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if(respuesta == "ok"){
                Swal.fire({
                    title: '¡El color ha sido Registrada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Cancelar',
                    //  confirmButtonText: 'Si, borrar Categoría!'
                  }).then(function(result){
                    if(result.value){
                    //    window.location = "combinacion";
                    mostrarConbinacionColor();
                    $("#EditarnombreColorC").val("");
                    }
                  });

            //    mostrarConbinacion();

            }else if(respuesta == "error"){
                Swal.fire('Error interno');
            }else if(respuesta == "errorSintaxis"){
                Swal.fire('Los datos ingresados no puede ir vacío o llevar caracteres especiales');
            }


        }

    });
    

});

$(document).on("click", ".btnQuitarCombinacion", function(){
    var idcombinacion = $(this).attr("idcombinacion");
    Swal.fire({
        title: '¿Está seguro de borrar el color?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar color!'
      }).then(function(result){
        
        if(result.value){
            
            var datos = new FormData();
            datos.append("EliminarColorCombinacion", "");
            datos.append("idcombinacion", idcombinacion);
        
        
        
            $.ajax({
        
                url:"ajax/combinacion.ajax.php",
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
                                mostrarConbinacionColor();
                                


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

$(document).on("click", ".btnEliminarColorCombinar", function(){
    var idColor = $(this).attr("idColor");
    Swal.fire({
        title: '¿Está seguro de borrar el color?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar color!'
      }).then(function(result){
        
        if(result.value){
            
            var datos = new FormData();
            datos.append("EliminarColorCombinacionCrud", "");
            datos.append("idColor", idColor);
        
        
        
            $.ajax({
        
                url:"ajax/combinacion.ajax.php",
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
                                    window.location = "combinacion";
                            //    mostrarConbinacionColor();
                                


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
