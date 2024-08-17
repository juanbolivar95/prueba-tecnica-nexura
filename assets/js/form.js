// $.validator.setDefaults({
//     submitHandler: function () {
//         alert("submitted!");
//     }
// });

$(document).ready(function () {
    $('#signupForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            gender: {
                required: true,
            },
            area: {
                required: true,
            },
            description: {
                required: true
            },
            "rol[]": {
                required: true
            }
        },
        messages: {
            name: {
                required: "Por favor ingresa tu nombre completo",
                minlength: "Tu nombre debe ser de no menos de 5 caracteres"
            },
            email: "Por favor ingresa un correo válido",
            gender: "Por favor seleccione el genero",
            area: "Por favor seleccione el área",
            description: "Por favor ingresa una descripción",
            "rol[]": "Por favor selecciona al menos un rol"
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            console.log(element[0].type === 'radio');

            if (element[0].type === 'radio' || element[0].type === 'checkbox') {
                error.appendTo(element.closest('.col-sm-9'));
                // console.log(element.closest(".col-sm-9"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).closest(".col-sm-9").addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest(".col-sm-9").addClass("has-success").removeClass("has-error");
        }
    });
});
