$(document).ready(function () {

  $(document).on("submit",".modal form.new",function (e) {
    e.preventDefault();
    var form = $(this);
    var formValues = $(this).serializeJSON();
    $(this).find("input").each(function () {
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
    var model = $(this).attr("model");



    jQuery.ajax({
      type: "POST",
      url: "/"+model+"/new-"+model+"/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".modal form button[type=submit]").html("<span class='fa fa-spinner fa-spin fa-2x fa-fw'></span>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".modal form button[type=submit]").html("Kaydet");

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
          $(".modal").modal("hide");
          if($(".txtSaleDiscountId").length > 0){

            var html = '<option value="'+ajaxResponse.lastInsertId+'" discount_type="'+formValues["txtDiscountType"]+'" discount_amount="'+formValues["txtDiscountAmount"]+'">'+formValues["txtDiscountName"]+'</option>';
            $(".txtSaleDiscountId").append(html);
            $(".txtSaleDiscountId").select();
          }

          if($(".txtSaleCustomerId").length > 0){

            $(".txtSaleCustomerId").val(formValues["txtCustomerName"]);
            $(".txtSaleCustomerId").attr("data-id",ajaxResponse.lastInsertId);
          }

          form.find("input").val("");
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
