$(document).ready(function () {

  /* new product submit */
  $("form#frmNewStockProduct").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewStockProduct").serializeJSON();
    $("#frmNewStockProduct input").each(function () {
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
    var photo = document.getElementById("txtStockProductPhoto");
      if(photo.files[0] == "" || photo.files[0] == null){

      }else {
        formData.append("photo",photo.files[0]);
      }

    formData.append("post",json);


    jQuery.ajax({
      type: "POST",
      url: "/stock-product/new-stock-product/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingNewStockProduct").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewStockProduct").html("Kaydet");
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
          $("#frmNewStockProduct").find("input").val("");
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
  /* new product submit */

})
