$(document).ready(function () {

  /* SEND SMS TO CUSTOMER */
  $("#frmSendSmsToCustomer").on("submit",function (e) {
    e.preventDefault();
    var receiverCustomerIds = new Array();
    var formValues = $("form#frmSendSmsToCustomer").serializeJSON();
    $("#frmSendSmsToCustomer input").each(function () {
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
        receiverCustomerIds.push($(this).attr("data-id"));
      }
    });
    formValues["txtReceiverCustomerIds"] = receiverCustomerIds;
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/sms/send-sms-to-customer/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingTakeSaleCollection").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingTakeSaleCollection").html("Kaydet");
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
          $("#modalSendSmsToCustomer").modal("hide");
          location.reload();

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
})
