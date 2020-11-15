$(document).ready(function () {


  /* new sale- submit */
  $("form#frmUpdateSaleInvoice").on("submit",function (e) {
    e.preventDefault();

    var permission = true;
    var formValues = $("form#frmUpdateSaleInvoice").serializeJSON();
    $("#frmUpdateSaleInvoice input").each(function () {
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
          permission = false;
          return false;
        }
        formValues[""+$(this).attr("name")+""] = $(this).attr("data-id");
      }
    });

    if (permission == false) {
      return false;
    }


    var product_ids = new Array();
    $(".txtSaleInvoiceProductId").each(function () {
      var productId = $(this).attr("data-id");
      product_ids.push(productId);
    });
    formValues["txtUpdateSaleInvoiceItemProductId"] = product_ids;

    formValues["txtUpdateSaleInvoiceSubTotal"] = $(".spanSubTotal").html();
    var taxTotal = 0;
    $(".spanTaxTotal").each(function () {
      taxTotal = taxTotal + parseFloat($(this).html());
    })
    formValues["txtUpdateSaleInvoiceTaxTotal"] = $(".spanTaxTotal").html();
    formValues["txtUpdateSaleInvoiceTotal"] = $(".spanTotal").html();


    var json = JSON.stringify(formValues);

    jQuery.ajax({
      type: "POST",
      url: "/sale-invoice/update-sale-invoice/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdateSaleInvoice").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdateSaleInvoice").html("Kaydet");
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
          $("#frmUpdateSaleInvoice").find("input").val("");
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
  /* new sale-invoice submit */

  $(document).on("change",".txtSaleInvoiceItemTaxId",function () {
    makeInvoiceCalculations();
  })

  $(document).on("input",".tbl-sale-invoice-products tbody input",function () {
    makeInvoiceCalculations();
  })

  /* add new row */
  $(".btnAddRow").on("click",function () {
    var innerHtml = $(".tbl-sale-invoice-products tbody tr:first").html();

    var html = '<tr>';
    html += innerHtml;
    html += '</tr>';

    $(".tbl-sale-invoice-products tbody").append(html);
  })
  /* add new row */


  /* clicking product suggestion and getting product data */
  $(document).on("input",".txtSaleInvoiceProductId",function () {
    var saleProductId = $(this).attr("data-id");
    var row = $(this).closest("tr");
    /* if it has product id get product informations */
    if (saleProductId) {
      jQuery.ajax({
        type: "POST",
        url: "/sale-product/get-sale-product-informations/"+saleProductId,
        data: {post:saleProductId},
        cache: false,
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          var ajaxResponse = $.parseJSON(response);
          if (ajaxResponse.saleProductInformations) {
            row.find(".txtSaleInvoiceItemSalePrice").val(ajaxResponse.saleProductInformations["sale_product_unit_selling_price"]);

            makeInvoiceCalculations();
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
    }
  })
  /* clicking product suggestion and getting product data */


})


function loadSaleInvoiceInformations(saleInvoiceId) {

  var json = {
    "txtSaleInvoiceId":saleInvoiceId
  };
  json = JSON.stringify(json);

  jQuery.ajax({
    type: "POST",
    url: "/sale-invoice/get-sale-invoice-informations/",
    data: {post:json},
    cache: false,
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      var ajaxResponse = $.parseJSON(response);
      if (ajaxResponse.saleInvoiceInformations) {
        $(".txtUpdateSaleInvoiceCustomerId").val(ajaxResponse.saleInvoiceInformations[0]["customer_name"]);
        $(".txtUpdateSaleInvoiceCustomerId").attr("data-id",ajaxResponse.saleInvoiceInformations[0]["sale_invoice_customer_id"]);

        $(".txtUpdateSaleInvoiceCategoryId").val(ajaxResponse.saleInvoiceInformations[0]["category_name"]);
        $(".txtUpdateSaleInvoiceCategoryId").attr("data-id",ajaxResponse.saleInvoiceInformations[0]["sale_invoice_category_id"]);

        $(".txtUpdateSaleInvoiceMaturityDate").val(ajaxResponse.saleInvoiceInformations[0]["sale_invoice_maturity_date"]);

        $(".txtUpdateSaleInvoiceCashId").val(ajaxResponse.saleInvoiceInformations[0]["sale_invoice_cash_id"]);
        $(".txtUpdateSaleInvoiceCashId").select();

        $(".txtUpdateSaleInvoiceNote").val(ajaxResponse.saleInvoiceInformations[0]["sale_invoice_note"]);

        $("#txtUpdateSaleInvoiceStockAddition[value="+ajaxResponse.saleInvoiceInformations[0]["sale_invoice_stock_addition"]+"]").prop("checked",true);


        for (var i = 0; i < ajaxResponse.saleInvoiceInformations.length; i++) {


          var html = '<tr>';
          html += '<td><button type="button" class="btn btn-danger btn-sm btnDeleteRow" name="button"> <span class="fa fa-minus"></span> </button> </td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input type="text" class="form-control form-control-sm input-search txtSaleInvoiceProductId" name="txtSaleInvoiceItemProductId[]" table="tbl_sale_products" data-id="'+ajaxResponse.saleInvoiceInformations[i]["sale_invoice_product_product_id"]+'" model="sale_product" property="name" click="true" value="'+ajaxResponse.saleInvoiceInformations[i]["sale_product_name"]+'" required>';
          html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<select class="form-control form-control-sm txtUpdateSaleInvoiceItemUnitId" data-value="'+ajaxResponse.saleInvoiceInformations[i]["sale_invoice_product_product_unit_id"]+'" name="txtSaleInvoiceItemUnitId[]">';
          html += '<option value="" disabled selected>-Seçiniz-</option>';
          for (var a = 0; a < ajaxResponse.units.length; a++) {
            html += '<option value="'+ajaxResponse.units[a]["unit_id"]+'">'+ajaxResponse.units[a]["unit_name"]+'</option>';
          }
          html += '</select>';
          html += '<button type="button" class="btn btn-xs btn-default btnInsideInput btnNewStockProduct" data-toggle="modal" data-target="#modalNewUnit" name="button"> <span class="fa fa-plus"></span> </button>';
          html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
          html += '</div>';
          html += '</td>';
          html += '<td><input type="text" class="form-control form-control-sm txtSaleInvoiceItemPiece" name="txtUpdateSaleInvoiceItemPiece[]" value="'+ajaxResponse.saleInvoiceInformations[i]["sale_invoice_product_product_piece"]+'"> </td>';
          html += '<td><input type="text" class="form-control form-control-sm txtSaleInvoiceItemSalePrice" name="txtUpdateSaleInvoiceItemSalePrice[]" value="'+ajaxResponse.saleInvoiceInformations[i]["sale_invoice_product_product_unit_sale_price"]+'"> </td>';
          html += '<input type="hidden" class="txtSaleInvoiceItemPurchasePrice" name="txtUpdateSaleInvoiceItemPurchasePrice[]" value="'+ajaxResponse.saleInvoiceInformations[i]["sale_invoice_product_product_unit_purchase_price"]+'"> </td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<select class="form-control form-control-sm txtSaleInvoiceItemTaxId" name="txtSaleInvoiceItemTaxId[]" data-value="'+ajaxResponse.saleInvoiceInformations[i]["sale_invoice_product_product_tax_id"]+'">';
          html += '<option value="" disabled selected>-Seçiniz-</option>';
          for (var a = 0; a < ajaxResponse.taxes.length; a++) {
            html += '<option tax_percentage="'+ajaxResponse.taxes[a]["tax_percentage"]+'" value="'+ajaxResponse.taxes[a]["tax_id"]+'">'+ajaxResponse.taxes[a]["tax_name"]+'</option>';
          }
          html += '</select>';
          html += '<button type="button" class="btn btn-xs btn-default btnInsideInput btnNewTax" data-toggle="modal" data-target="#modalNewTax" name="button"> <span class="fa fa-plus"></span> </button>';
          html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
          html += '</div>';
          html += '</td>';
          html += '<td><span class="lead spanRowTotal">'+ajaxResponse.saleInvoiceInformations[i]["row_total"]+' ₺</span> </td>';
          html += '</tr>';

          $(".tbl-sale-invoice-products tbody").append(html);


        }
        changeSelect();
        makeInvoiceCalculations();
      }
    }
  });


}


function makeInvoiceCalculations() {
  var total = 0;
  $(".tbl-sale-invoice-products tbody tr").each(function () {
    var taxInformations = $(this).find(".txtSaleInvoiceItemTaxId").val();
    var rowItemPiece = parseFloat($(this).find(".txtSaleInvoiceItemPiece").val());
    var rowItemUnitSalePrice = parseFloat($(this).find(".txtSaleInvoiceItemSalePrice").val());
    var rowAmount = rowItemPiece * rowItemUnitSalePrice;
    $(this).find(".spanRowTotal").html(rowAmount.toFixed(2)+" ₺");
    total = total + rowAmount;



    /* tax calculations */
    var tax_informations = new Array();
    $(".txtSaleInvoiceItemTaxId").each(function () {
      var tax_percentage = $(this).find("option:selected").attr("tax_percentage");
      var row_amount = parseFloat($(this).closest("tr").find(".spanRowTotal").html());

      row_tax_amount = (row_amount * tax_percentage) / 100;
      tax_informations[tax_percentage] = row_tax_amount;
    })

    $(".trTax").remove();
    for (var key in tax_informations) {
      var html = '<tr class="trTax">';
      html += '<td colspan="6" class="text-right">Vergi (%'+key+'): </td>';
      html += '<td class="text-right"><span class="spanTaxTotal">'+tax_informations[key]+'</span> ₺ </td>';
      html += '</tr>';
      $(".trSubTotal").after(html);
    }
    /* tax calculations */


    /* sub total calculations */
    var subTotal = 0;
    $(".spanRowTotal").each(function () {
      subTotal = subTotal + parseFloat($(this).html());
    })
    $(".spanSubTotal").html(subTotal.toFixed(2));
    /* sub total calculations */


    /* total amount calculations */
    var total = 0;
    $(".spanTaxTotal").each(function () {
      total = total + parseFloat($(this).html());
    })
    total = total + parseFloat($(".spanSubTotal").html());
    $(".spanTotal").html(total.toFixed(2));
    /* total amount calculations */

  })


}
