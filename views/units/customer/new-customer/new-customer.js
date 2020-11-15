$(document).ready(function () {

  /* new customer submit */
  $("form#frmNewCustomer").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewCustomer").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/customer/new-customer/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewCustomer").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewCustomer").html("Kaydet");
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
          $("#frmNewCustomer").find("input").val("");
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
  /* new customer submit */

})
