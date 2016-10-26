$('#registerService').formValidation({
    framework: 'bootstrap',
    icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        address: {
            validators: {
                notEmpty: {
                    message: 'O endereço é obrigatório'
                }
            }
        },
        neighborhood: {
            validators: {
                notEmpty: {
                    message: 'O bairro é obrigatório'
                }
            }
        },
        selectState: {
            validators: {
                notEmpty: {
                    message: 'O estado é obrigatório'
                }
            }
        },
        selectCity: {
            validators: {
                notEmpty: {
                    message: 'O cidade é obrigatório'
                }
            }
        },
        zipCode: {
            validators: {
                notEmpty: {
                    message: 'O cep é obrigatório'
                }
            }
        }
    }
});