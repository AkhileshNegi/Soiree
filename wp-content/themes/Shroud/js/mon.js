jQuery(document).ready(function(){
  jQuery("#soiree_request").click(function(){

    var form = jQuery('#registration_form');

    if (form[0].checkValidity()) {
      // make ajax call
      // alert('everything is fine!');

      var dataString = form.serialize();

      var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

    jQuery.ajax({
      type: "POST",
      url: ajaxurl,
      data: dataString,
      success: function(result){
        alert('ajax successful');
        //$("#box").load("thankyou.php");
      },
      error: function(error) {
        alert('ajax failed!');
      }
    });
    // } else {
      // report validation error
      form[0].reportValidity();
      return false;
    }

    // var name = $("#name").val();
    // var email = $("#email").val();
    // var gender = $("#gender").val();

   // Returns successful data submission message when the entered information is stored in database.
    // var dataString = 'name='+ name + '&email='+ email + '&gender='+ gender;
    // if(name=='' || email=='' || gender==''){
    //   alert("Please Fill All Fields");
    // } else {alert('everything is fine!');
      
    //   // AJAX Code To Submit Form.
    //   $.ajax({
    //     type: "POST",
    //     url: "admin_url('admin-ajax.php') ",
    //     data: dataString,
    //     cache: false,
    //     success: function(result){
    //       $("#box").load("thankyou.php");
    //     }
    //   });
    // }
    // return false;

  });
});
