$(document).ready(function () {



  /* new given-check submit */
  $("form#frmNewGivenCheck").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewGivenCheck").serializeJSON();
    $("#frmNewGivenCheck input").each(function () {
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
    var photo = document.getElementById("txtGivenCheckPhoto");
    if(photo.files[0] == "" || photo.files[0] == null){

    }else {
      formData.append("photo",photo.files[0]);
    }

    formData.append("post",json);

    jQuery.ajax({
      type: "POST",
      url: "/given-check/new-given-check/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingNewGivenCheck").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewGivenCheck").html("Kaydet");
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
          $("#frmNewGivenCheck").find("input").val("");
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
  /* new given-check submit */

})
