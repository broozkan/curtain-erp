$(document).ready(function () {

  /* new company submit */
  $("form#frmUpdateCompany").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmUpdateCompany").serializeJSON();
    var json = JSON.stringify(formValues);


    var formData = new FormData();
    var photo = document.getElementById("txtCompanyLogo");
      if(photo.files[0] == "" || photo.files[0] == null){

      }else {
        formData.append("photo",photo.files[0]);
      }

    formData.append("post",json);

    jQuery.ajax({
      type: "POST",
      url: "/company/update-company/"+formValues["txtCompanyId"],
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingUpdateCompany").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateCompany").html("Kaydet");
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
  /* new company submit */

})
