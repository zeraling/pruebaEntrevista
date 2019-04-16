/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function loadCiudades() {
    $.ajax({
        cache: false,
        type: "GET",
        url: '/getCiudades',
        dataType: 'json'
        , success: function (data) {
            let html = ''
            let cidudadSelect=parseInt($('#idCiudad').attr('data-select'));
            if (data.length > 0) {
                html = '<option value=""> - seleccione - </option>'
                data.forEach(element => {
                    let selected= cidudadSelect>0?'selected="selected"':'';
                    html += '<option value="' + element.cod + '" '+selected+'>' + element.name + '</option>'
                })
            } else {
                html = '<option value="">No se han Cargado datos</option>'
            }
            $('#idCiudad').html(html)
        }, error: function () {
            alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
        }
    });
}

$(document).ready(function () {
     loadCiudades()
     
     $('#formCliente').validate({
        errorElement: "em",
        rules: {
            Id: {required: true, minlength: 1, maxlength: 5},
            Nombre: {required: true, minlength: 3},
            idCiudad: {required: true}
        },errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }
        },highlight: function (element, errorClass, validClass) {
            $(element).parents(".wrap-input100").addClass("has-error").removeClass("has-success");
        }, unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".wrap-input100").addClass("has-success").removeClass("has-error");
        }, submitHandler: function(form) {
            form.submit()
        }
    });
     
})