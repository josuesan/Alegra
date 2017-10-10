function addButtons (contactos){
  for (var i = 0; i < contactos.length; i++) {
    var id = contactos[i].id;
    contactos[i].actions = `
    <a class="actions-icons add" href="./views/contact.html?id:${id}" "><i class="fa fa-eye" aria-hidden="true"></i></a>
    <a class="actions-icons edit" onclick="editContact(${id})"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    <a class="actions-icons delete" onclick="deleteContact(${id});"><i class="fa fa-window-close" aria-hidden="true"></i></a>`;
  }
  
  return contactos;
}
function getContact(id){
    Ext.Ajax.request({
        url: 'http://atijuggers.esy.es/alegra-api/public/contacts/'+id,
        method: 'GET',
        disableCaching: false,
        useDefaultXhrHeader: false,
        success: function(conn, response, options, eOpts) {
           var data = Ext.decode(conn.responseText);
           $("#name_user").text(data.name);
           $("#name").text(data.name);
           $("#identification").text(data.identification);
           $("#phonePrimary").text(data.phonePrimary);
           $("#phoneSecondary").text(data.phoneSecondary);
           $("#mobile").text(data.mobile);
           $("#address").text(data.address.address);
           $("#city").text(data.address.city);
           $("#email").text(data.email);
           $("#observations").text(data.observations);
        },
        failure: function(conn, response, options, eOpts) {
        }
    });
}
function deleteContact(id){
  Ext.Ajax.request({
            url: 'http://atijuggers.esy.es/alegra-api/public/contacts/'+id,
            method: 'DELETE',
            disableCaching: false,
            useDefaultXhrHeader: false,
            success: function(conn, response, options, eOpts) {
               var data = Ext.decode(conn.responseText);
               console.log(data);
               var newData = addButtons(data);
               GetContacts();
            },
            failure: function(conn, response, options, eOpts) {
            }
        });
}
function GetContacts(){
  Ext.Ajax.request({
            url: 'http://atijuggers.esy.es/alegra-api/public/contacts',
            method: 'GET',
            disableCaching: false,
            useDefaultXhrHeader: false,
            success: function(conn, response, options, eOpts) {
               var data = Ext.decode(conn.responseText);
               console.log(data);
               var newData = addButtons(data);
               Ext.StoreManager.lookup('jsonClients').loadData(newData);
            },
            failure: function(conn, response, options, eOpts) {
            }
        });
}
function listContact(jsonClients){
  Ext.Ajax.request({
            url: 'http://atijuggers.esy.es/alegra-api/public/contacts',
            method: 'GET',
            disableCaching: false,
            useDefaultXhrHeader: false,
            success: function(conn, response, options, eOpts) {
               var data = Ext.decode(conn.responseText);
               console.log(data);
               var newData = addButtons(data);
               Ext.StoreManager.lookup('jsonClients').loadData(newData);
            },
            failure: function(conn, response, options, eOpts) {
            }
        });
}
function createStore(){
  var jsonClients = Ext.create('Ext.data.Store', {
          autoLoad: false,
          storeId: 'jsonClients',
          proxy: 'memory'
      });
  return jsonClients;
}
    Ext.onReady(function() {
      var jsonClients = createStore();
      listContact(jsonClients);

      Ext.define('alegraPanel', {
         extend: 'Ext.grid.Panel',
         resizable: true,
         title: 'Contactos',
         store: jsonClients,
         columns: {
           defaults: {
              resizable: false
            },
            items: [
              { text: 'Nombre',  dataIndex: 'name',flex: 20 / 100,},
              { text: 'Identificación', dataIndex: 'identification',flex: 20 / 100 },
              { text: 'Telefono 1', dataIndex: 'phonePrimary',flex: 20 / 100  },
              { text: 'Observaciones', dataIndex: 'observations',flex: 20 / 100  },
              { text: 'Acciones', dataIndex: 'actions',flex: 20 / 100,},
            ],
          },
      });
      var list = Ext.create('alegraPanel', {
                  renderTo: Ext.getElementById('content'),
      });  
  }); 