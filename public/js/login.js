/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $('#startLogin').validate({
        errorElement: "em",
        rules: {
            username: {required: true, minlength: 5, maxlength: 15},
            password: {required: true, minlength: 5}
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

});
