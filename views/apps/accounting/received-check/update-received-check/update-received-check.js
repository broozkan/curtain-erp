$(document).ready(function () {

  $('.select2').select2();

  /* update received-check submit */
  $("form#frmUpdateReceivedCheck").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmUpdateReceivedCheck").serializeJSON();
    $("#frmUpdateReceivedCheck input").each(function () {
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
      url: "/received-check/update-received-check/"+formValues["txtReceivedCheckId"],
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdateReceivedCheck").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateReceivedCheck").html("Kaydet");
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
          $("#frmUpdateReceivedCheck").find("input").val("");
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
  /* update received-check submit */

  /* vouch received check */
  $("form#frmVouchCheck").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmVouchCheck").serializeJSON();
    $("#frmVouchCheck input").each(function () {
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
      url: "/received-check/vouch-received-check/"+formValues["txtReceivedCheckId"],
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdateReceivedCheck").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateReceivedCheck").html("Kaydet");
        var ajaxResponse = $.parseJSON(response);
        if (ajaxResponse.response == true) {
          $.notify({
            // options
            icon: 'fa fa-warning fa-2x',
            message: "Çek başarılı bir şekilde cirolandı!"
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
  /* vouch received check */

})
