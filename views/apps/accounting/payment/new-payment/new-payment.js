$(document).ready(function () {

  /* payment repeat type */
  $("#txtIsPaymentRepeat").on("click",function () {
    $(".div-payment-repeat").toggleClass("d-none");
  })
  /* payment repeat type */

  /* new payment submit */
  $("form#frmNewPayment").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewPayment").serializeJSON();
    $("#frmNewPayment input").each(function () {
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
      url: "/payment/new-payment/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewPayment").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewPayment").html("Kaydet");
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
          $("#frmNewPayment").find("input").val("");
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
  /* new payment submit */

})
