$(document).ready(function () {

  /* new supplier submit */
  $("form#frmNewSupplier").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewSupplier").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/supplier/new-supplier/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewSupplier").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewSupplier").html("Kaydet");
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
          $("#frmNewSupplier").find("input").val("");
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
  /* new supplier submit */

})
