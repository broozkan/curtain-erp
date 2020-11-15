$(document).ready(function () {


  /* add stock decrease information row */
  $(document).on("click",".btnAddStockDecreaseInformationRow",function () {

    var html = '<div class="divDecreaseInformations" >';
    html += '<input type="text"  class="form-control input-search col-lg-6 txtSaleProductStockDecreaseStockProductIds" name="txtSaleProductStockDecreaseStockProductIds[]" table="tbl_stock_products" model="stock_product"  property="name" click="true" style="display:inline"';
    html += 'placeholder="Stok ürünü arayınız">';
    html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html += '<input type="number" class="form-control col-lg-4" name="txtSaleProductStockDecreaseStockDecreaseAmounts[]" placeholder="Stok düşüm miktarı" style="display:inline" value="">';
    html += '<button type="button" class="btn btn-sm btn-danger btnDeleteStockDecreaseInformationRow" name="button"> <span class="fa fa-trash"></span> </button>';
    html += '</div>';

    $(".div-stock-decrease-informations").append(html);

  })
  /* add stock decrease information row */

  /* delete stock decrease information row */
  $(document).on("click",".btnDeleteStockDecreaseInformationRow",function () {

    $(this).closest(".divDecreaseInformations").remove();

  })
  /* delete stock decrease information row */



  /* open stock decrease informations*/
  $("#txtSaleProductStockDecrease").on("click",function () {
    $(".div-stock-decrease-informations").toggleClass("d-none");
  })
  /* open stock decrease informations*/

  /* new product submit */
  $("form#frmNewSaleProduct").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewSaleProduct").serializeJSON();
    var stockDecreaseProductIds = new Array();
    $("#frmNewSaleProduct input").each(function () {
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
        stockDecreaseProductIds.push($(this).attr("data-id"));
        formValues[""+$(this).attr("name")+""] = $(this).attr("data-id");
      }
    });
    formValues["txtSaleProductStockDecreaseStockProductIds"] = stockDecreaseProductIds;
    var json = JSON.stringify(formValues);

    var formData = new FormData();
    var photo = document.getElementById("txtSaleProductPhoto");
      if(photo.files[0] == "" || photo.files[0] == null){

      }else {
        formData.append("photo",photo.files[0]);
      }

    formData.append("post",json);


    jQuery.ajax({
      type: "POST",
      url: "/sale-product/new-sale-product/",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $(".btnLoadingNewSaleProduct").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewSaleProduct").html("Kaydet");
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
          $("#frmNewSaleProduct").find("input").val("");
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
