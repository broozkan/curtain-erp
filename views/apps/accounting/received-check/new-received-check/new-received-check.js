$(document).ready(function () {



  /* new received-check submit */
  $("form#frmNewReceivedCheck").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewReceivedCheck").serializeJSON();
    $("#frmNewReceivedCheck input").each(function () {
      if ($(this).hasClass("input-search")) {
        if (!$(this).attr("data-id")) {
          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Lütfen boş alan bırakmayınız!"
          },{
            // settings
            type: 'danger'
          });
          return false;
        }
        formValues[""+$(this).attr("name")+""] = $(this).attr("data-id");
      }
    });
    var json = JSON.stringify(formValues);

    var formData = new FormData();
    var photo = document.getElementById("txtReceivedCheckPhoto");
    if(photo.files[0] == "" || photo.files[0] == null){

    }else {
      formData.append("photo",photo.files[0]);
    }

    formData.append("post",json);

    jQuery.ajax({
      type: "POST",
      url: "/received-check/new-received-check/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingNewReceivedCheck").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewReceivedCheck").html("Kaydet");
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
          $("#frmNewReceivedCheck").find("input").val("");
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
  /* new received-check submit */

})
