jQuery(document).ready(function(){
  jQuery("#soiree_request").click(function(){
    var form = jQuery('#registration_form');
    if (form[0].checkValidity()) {
      var dataString = form.serialize();   
      jQuery.ajax({
        type: "POST",
        url: 'http://soiree.test/wp-admin/admin-ajax.php',
        data: dataString,
        success: function(result){
          if (result=='1') {
            $("#box").load("../Thankyou");
          }
          else{
            $("#box").load("../already");
          }
        },
        error: function(error) {
        alert('ajax failed!');
        }
        });
      form[0].reportValidity();
      return false;
    }
  });
});
