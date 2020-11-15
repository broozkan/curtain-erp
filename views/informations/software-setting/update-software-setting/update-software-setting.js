$(document).ready(function () {

  /* new software-setting submit */
  $("form#frmUpdateSoftwareSetting").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmUpdateSoftwareSetting").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/software-setting/update-software-setting/"+formValues["txtSoftwareSettingId"],
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdateSoftwareSetting").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateSoftwareSetting").html("Kaydet");
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
  /* new software-setting submit */

})
