$(document).ready(function () {

  /* new workshop submit */
  $("form#frmNewWorkshop").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewWorkshop").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/workshop/new-workshop/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewWorkshop").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewWorkshop").html("Kaydet");
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
          $("#frmNewWorkshop").find("input").val("");
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
  /* new workshop submit */

})
