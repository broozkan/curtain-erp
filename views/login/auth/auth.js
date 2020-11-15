$(document).ready(function () {


  /* LOGIN POST */
  $("#frmLogin").on("submit",function (e) {
    e.preventDefault();
    var formVerileri = $("#frmLogin").serializeJSON();
    var json = JSON.stringify(formVerileri);


    jQuery.ajax({
      type: "POST",
      url: "/login/auth/",
      data: {auth:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingLogin").html("<img src='/assets/images/loading.gif'/>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(ajaxResponse)
      {
        $(".btnLoadingLogin").html("Giriş Yap");
        var ajaxResponse = $.parseJSON(ajaxResponse);
        if (ajaxResponse.response == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Giriş başarılı!"
          },{
            // settings
            type: 'success'
          });

          window.location.href = ajaxResponse.employeeRedirectUrl;

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
  /* LOGIN POST */

})
