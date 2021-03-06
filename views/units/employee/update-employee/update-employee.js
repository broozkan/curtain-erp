$(document).ready(function () {

  /* new employee submit */
  $("form#frmUpdateEmployee").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmUpdateEmployee").serializeJSON();
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
      url: "/employee/update-employee/"+formValues["txtEmployeeId"],
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingUpdateEmployee").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateEmployee").html("Kaydet");
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
  /* new employee submit */

})
