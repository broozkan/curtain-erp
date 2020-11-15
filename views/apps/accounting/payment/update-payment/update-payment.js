$(document).ready(function () {

  $('.select2').select2();

  /* update payment submit */
  $("form#frmUpdatePayment").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmUpdatePayment").serializeJSON();
    $("#frmUpdatePayment input").each(function () {
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


    jQuery.ajax({
      type: "POST",
      url: "/payment/update-payment/"+formValues["txtPaymentId"],
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdatePayment").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdatePayment").html("Kaydet");
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
          $("#frmUpdatePayment").find("input").val("");
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
  /* update payment submit */

})
