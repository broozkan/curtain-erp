$(document).ready(function () {

  /* new email submit */
  $("form#frmUpdateEmail").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmUpdateEmail").serializeJSON();
    var json = JSON.stringify(formValues);

    jQuery.ajax({
      type: "POST",
      url: "/email/update-email/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdateEmail").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateEmail").html("Kaydet");
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
  /* new email submit */

})
