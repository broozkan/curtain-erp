$(document).ready(function () {

  /* new product submit */
  $("form#frmNewPaymentMethod").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewPaymentMethod").serializeJSON();
    var json = JSON.stringify(formValues);



    jQuery.ajax({
      type: "POST",
      url: "/payment-method/new-payment-method/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewPaymentMethod").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewPaymentMethod").html("Kaydet");
        var ajaxResponse = $.parseJSON(response);
        if (ajaxResponse.response == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Başarılı bir şekilde kaydedildi!"
          },{
            // settings
            type: 'success'
          });
          $("#frmNewPaymentMethod").find("input").val("");
        }else {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: ajaxResponse.response
          },{
            // settings
            type: 'danger'
          });
        }
      }
    });
  })
  /* new product submit */

})
