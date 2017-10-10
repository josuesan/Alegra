Ext.onReady(function() {
    Ext.create('Ext.form.Panel', {
        width: 800,

        // The form will submit an AJAX request to this URL when submitted
        url: 'http://atijuggers.esy.es/alegra-api/public/contacts/',

        // Fields will be arranged vertically, stretched to full width
        layout: 'anchor',
        defaults: {
            anchor: '100%'
        },

        // The fields
        defaultType: 'textfield',
        items: [{
            fieldLabel: 'Nombre',
            name: 'name',
            allowBlank: false
        },{
            fieldLabel: 'Identificacion',
            name: 'identification',
            allowBlank: true
        }
        ,{
            fieldLabel: 'telefono 1',
            name: 'phonePrimary',
            allowBlank: true
        },{
            fieldLabel: 'Telefono 2',
            name: 'phoneSecondary',
            allowBlank: true
        },{
            fieldLabel: 'Celular',
            name: 'mobile',
            allowBlank: true
        },{
            fieldLabel: 'Direccion',
            name: 'address',
            allowBlank: true
        },{
            fieldLabel: 'Ciudad',
            name: 'city',
            allowBlank: true
        },{
            fieldLabel: 'Correo electronico',
            name: 'email',
            allowBlank: true
        },{
            fieldLabel: 'Observaciones',
            name: 'observations',
            allowBlank: true
        }
        ],

        // Reset and Submit buttons
        buttons: [{
            text: 'Reset',
            handler: function() {
                this.up('form').getForm().reset();
            }
        }, {
            text: 'Submit',
            formBind: true, //only enabled once the form is valid
            disabled: true,
            handler: function() {
                var form = this.up('form').getForm();
                if (form.isValid()) {
                    console.log(form);
                    form.submit({
                        success: function(form, action) {
                           console.log("listo");
                        },
                        failure: function(form, action) {
                            console.log("no listo");
                        }
                    });
                }
            }
        }],
        renderTo: Ext.getElementById('forms')
    });
}); 