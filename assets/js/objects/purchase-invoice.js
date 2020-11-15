$(document).ready(function () {


  /* new purchase- submit */
  $("form#frmUpdatePurchaseInvoice").on("submit",function (e) {
    e.preventDefault();

    var permission = true;
    var formValues = $("form#frmUpdatePurchaseInvoice").serializeJSON();
    $("#frmUpdatePurchaseInvoice input").each(function () {
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
    $(".txtPurchaseInvoiceProductId").each(function () {
      var productId = $(this).attr("data-id");
      product_ids.push(productId);
    });
    formValues["txtUpdatePurchaseInvoiceItemProductId"] = product_ids;

    formValues["txtUpdatePurchaseInvoiceSubTotal"] = $(".spanSubTotal").html();
    var taxTotal = 0;
    $(".spanTaxTotal").each(function () {
      taxTotal = taxTotal + parseFloat($(this).html());
    })
    formValues["txtUpdatePurchaseInvoiceTaxTotal"] = $(".spanTaxTotal").html();
    formValues["txtUpdatePurchaseInvoiceTotal"] = $(".spanTotal").html();


    var json = JSON.stringify(formValues);

    jQuery.ajax({
      type: "POST",
      url: "/purchase-invoice/update-purchase-invoice/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingUpdatePurchaseInvoice").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingUpdatePurchaseInvoice").html("Kaydet");
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
          $("#frmUpdatePurchaseInvoice").find("input").val("");
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
  /* new purchase-invoice submit */

  $(document).on("change",".txtPurchaseInvoiceItemTaxId",function () {
    makeInvoiceCalculations();
  })

  $(document).on("input",".tbl-purchase-invoice-products tbody input",function () {
    makeInvoiceCalculations();
  })

  /* add new row */
  $(".btnAddRow").on("click",function () {
    var innerHtml = $(".tbl-purchase-invoice-products tbody tr:first").html();

    var html = '<tr>';
    html += innerHtml;
    html += '</tr>';

    $(".tbl-purchase-invoice-products tbody").append(html);
  })
  /* add new row */


  /* clicking product suggestion and getting product data */
  $(document).on("input",".txtPurchaseInvoiceProductId",function () {
    var purchaseProductId = $(this).attr("data-id");
    var row = $(this).closest("tr");
    /* if it has product id get product informations */
    if (purchaseProductId) {
      jQuery.ajax({
        type: "POST",
        url: "/purchase-product/get-purchase-product-informations/"+purchaseProductId,
        data: {post:purchaseProductId},
        cache: false,
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          var ajaxResponse = $.parseJSON(response);
          if (ajaxResponse.purchaseProductInformations) {
            row.find(".txtPurchaseInvoiceItemPurchasePrice").val(ajaxResponse.purchaseProductInformations["purchase_product_unit_selling_price"]);

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


function loadPurchaseInvoiceInformations(purchaseInvoiceId) {

  var json = {
    "txtPurchaseInvoiceId":purchaseInvoiceId
  };
  json = JSON.stringify(json);

  jQuery.ajax({
    type: "POST",
    url: "/purchase-invoice/get-purchase-invoice-informations/",
    data: {post:json},
    cache: false,
    error:function(err){
      alert(err.responseText);
    },
    success: function(response)
    {
      var ajaxResponse = $.parseJSON(response);
      if (ajaxResponse.purchaseInvoiceInformations) {
        $(".txtUpdatePurchaseInvoiceSupplierId").val(ajaxResponse.purchaseInvoiceInformations[0]["supplier_name"]);
        $(".txtUpdatePurchaseInvoiceSupplierId").attr("data-id",ajaxResponse.purchaseInvoiceInformations[0]["purchase_invoice_supplier_id"]);

        $(".txtUpdatePurchaseInvoiceCategoryId").val(ajaxResponse.purchaseInvoiceInformations[0]["category_name"]);
        $(".txtUpdatePurchaseInvoiceCategoryId").attr("data-id",ajaxResponse.purchaseInvoiceInformations[0]["purchase_invoice_category_id"]);

        $(".txtUpdatePurchaseInvoiceMaturityDate").val(ajaxResponse.purchaseInvoiceInformations[0]["purchase_invoice_maturity_date"]);

        $(".txtUpdatePurchaseInvoiceCashId").val(ajaxResponse.purchaseInvoiceInformations[0]["purchase_invoice_cash_id"]);
        $(".txtUpdatePurchaseInvoiceCashId").select();

        $(".txtUpdatePurchaseInvoiceNote").val(ajaxResponse.purchaseInvoiceInformations[0]["purchase_invoice_note"]);

        $("#txtUpdatePurchaseInvoiceStockAddition[value="+ajaxResponse.purchaseInvoiceInformations[0]["purchase_invoice_stock_addition"]+"]").prop("checked",true);


        for (var i = 0; i < ajaxResponse.purchaseInvoiceInformations.length; i++) {


          var html = '<tr>';
          html += '<td><button type="button" class="btn btn-danger btn-sm btnDeleteRow" name="button"> <span class="fa fa-minus"></span> </button> </td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input type="text" class="form-control form-control-sm input-search txtPurchaseInvoiceProductId" name="txtPurchaseInvoiceItemProductId[]" table="tbl_stock_products" data-id="'+ajaxResponse.purchaseInvoiceInformations[i]["purchase_invoice_product_product_id"]+'" model="stock_product" property="name" click="true" value="'+ajaxResponse.purchaseInvoiceInformations[i]["stock_product_name"]+'" required>';
          html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<select class="form-control form-control-sm txtUpdatePurchaseInvoiceItemUnitId" data-value="'+ajaxResponse.purchaseInvoiceInformations[i]["purchase_invoice_product_product_unit_id"]+'" name="txtPurchaseInvoiceItemUnitId[]">';
          html += '<option value="" disabled selected>-Seçiniz-</option>';
          for (var a = 0; a < ajaxResponse.units.length; a++) {
            html += '<option value="'+ajaxResponse.units[a]["unit_id"]+'">'+ajaxResponse.units[a]["unit_name"]+'</option>';
          }
          html += '</select>';
          html += '<button type="button" class="btn btn-xs btn-default btnInsideInput btnNewStockProduct" data-toggle="modal" data-target="#modalNewUnit" name="button"> <span class="fa fa-plus"></span> </button>';
          html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
          html += '</div>';
          html += '</td>';
          html += '<td><input type="text" class="form-control form-control-sm txtPurchaseInvoiceItemPiece" name="txtUpdatePurchaseInvoiceItemPiece[]" value="'+ajaxResponse.purchaseInvoiceInformations[i]["purchase_invoice_product_product_piece"]+'"> </td>';
          html += '<td><input type="text" class="form-control form-control-sm txtPurchaseInvoiceItemPurchasePrice" name="txtUpdatePurchaseInvoiceItemPurchasePrice[]" value="'+ajaxResponse.purchaseInvoiceInformations[i]["purchase_invoice_product_product_unit_purchase_price"]+'"> </td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<select class="form-control form-control-sm txtPurchaseInvoiceItemTaxId" name="txtPurchaseInvoiceItemTaxId[]" data-value="'+ajaxResponse.purchaseInvoiceInformations[i]["purchase_invoice_product_product_tax_id"]+'">';
          html += '<option value="" disabled selected>-Seçiniz-</option>';
          for (var a = 0; a < ajaxResponse.taxes.length; a++) {
            html += '<option tax_percentage="'+ajaxResponse.taxes[a]["tax_percentage"]+'" value="'+ajaxResponse.taxes[a]["tax_id"]+'">'+ajaxResponse.taxes[a]["tax_name"]+'</option>';
          }
          html += '</select>';
          html += '<button type="button" class="btn btn-xs btn-default btnInsideInput btnNewTax" data-toggle="modal" data-target="#modalNewTax" name="button"> <span class="fa fa-plus"></span> </button>';
          html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
          html += '</div>';
          html += '</td>';
          html += '<td><span class="lead spanRowTotal">'+ajaxResponse.purchaseInvoiceInformations[i]["row_total"]+' ₺</span> </td>';
          html += '</tr>';

          $(".tbl-purchase-invoice-products tbody").append(html);


        }
        changeSelect();
        makeInvoiceCalculations();
      }
    }
  });


}


function makeInvoiceCalculations() {
  var total = 0;
  $(".tbl-purchase-invoice-products tbody tr").each(function () {
    var taxInformations = $(this).find(".txtPurchaseInvoiceItemTaxId").val();
    var rowItemPiece = parseFloat($(this).find(".txtPurchaseInvoiceItemPiece").val());
    var rowItemUnitPurchasePrice = parseFloat($(this).find(".txtPurchaseInvoiceItemPurchasePrice").val());
    var rowAmount = rowItemPiece * rowItemUnitPurchasePrice;
    $(this).find(".spanRowTotal").html(rowAmount.toFixed(2)+" ₺");
    total = total + rowAmount;



    /* tax calculations */
    var tax_informations = new Array();
    $(".txtPurchaseInvoiceItemTaxId").each(function () {
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
