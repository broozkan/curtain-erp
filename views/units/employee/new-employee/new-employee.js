$(document).ready(function () {

  /* new employee submit */
  $("form#frmNewEmployee").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewEmployee").serializeJSON();
    var json = JSON.stringify(formValues);


    var formData = new FormData();
    var photo = document.getElementById("txtEmployeePhoto");
      if(photo.files[0] == "" || photo.files[0] == null){

      }else {
        formData.append("photo",photo.files[0]);
      }

    formData.append("post",json);

    jQuery.ajax({
      type: "POST",
      url: "/employee/new-employee/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingNewEmployee").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewEmployee").html("Kaydet");
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
          $("#frmNewEmployee").find("input").val("");
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
  /* new employee submit */

})
