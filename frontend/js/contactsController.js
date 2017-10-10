function viewContact(id){
  $content = $("#content").hide();
  $HomeMenu = $(".home-Menu").hide();
  $table = $("#table").show();
  $userMenu = $(".user-Menu").show();
  getContact(id);
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

Ext.onReady(function() {
  var path =document.location.href ;
  var res = path.split("?");
  var result = res[1].split(":");
  console.log(result);
  getContact(result[1]);
}); 