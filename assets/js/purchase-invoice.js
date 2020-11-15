$(document).ready(function () {

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

    // var html = '<tr>';
    // html += '<td><button type="button" class="btn btn-danger btn-sm btnDeleteRow" name="button"> <span class="fa fa-minus"></span> </button> </td>';
    // html += '<td><input type="text" class="form-control form-control-sm" name="" value=""> </td>';
    // html += '<td><input type="text" class="form-control form-control-sm" name="" value=""> </td>';
    // html += '<td><input type="text" class="form-control form-control-sm" name="" value=""> </td>';
    // html += '<td><input type="text" class="form-control form-control-sm" name="" value=""> </td>';
    // html += '<td><input type="text" class="form-control form-control-sm" name="" value=""> </td>';
    // html += '<td><input type="text" class="form-control form-control-sm" name="" value=""> </td>';
    // html += '<td><span class="lead">0.00 ₺</span> </td>';
    // html += '</tr>';

    $(".tbl-purchase-invoice-products tbody").append(html);
  })
  /* add new row */


  /* delete row */
  $(document).on("click",".btnDeleteRow",function () {
    if($(this).closest("tr").index() == 0){
      return false;
    }
    $(this).closest("tr").remove();
  })
  /* delete row */


  /* clicking product suggestion and getting product data */
  $(document).on("input",".txtPurchaseInvoiceProductId",function () {
    var stockProductId = $(this).attr("data-id");
    var row = $(this).closest("tr");
    /* if it has product id get product informations */
    if (stockProductId) {
      jQuery.ajax({
        type: "POST",
        url: "/stock-product/get-stock-product-informations/"+stockProductId,
        data: {post:stockProductId},
        cache: false,
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          var ajaxResponse = $.parseJSON(response);
          if (ajaxResponse.stockProductInformations) {
            row.find(".txtPurchaseInvoiceItemPurchasePrice").val(ajaxResponse.stockProductInformations["stock_product_unit_purchase_price"]);

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

  /* new purchase- submit */
  $("form#frmNewPurchaseInvoice").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewPurchaseInvoice").serializeJSON();
    $("#frmNewPurchaseInvoice input").each(function () {
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
    var product_ids = new Array();
    $(".txtPurchaseInvoiceProductId").each(function () {
      var productId = $(this).attr("data-id");
      product_ids.push(productId);
    });
    formValues["txtPurchaseInvoiceItemProductId"] = product_ids;

    formValues["txtPurchaseInvoiceSubTotal"] = $(".spanSubTotal").html();
    var taxTotal = 0;
    $(".spanTaxTotal").each(function () {
      taxTotal = taxTotal + parseFloat($(this).html());
    })
    formValues["txtPurchaseInvoiceTaxTotal"] = $(".spanTaxTotal").html();
    formValues["txtPurchaseInvoiceTotal"] = $(".spanTotal").html();


    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/purchase-invoice/new-purchase-invoice/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewPurchaseInvoice").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewPurchaseInvoice").html("Kaydet");
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
          $("#frmNewPurchaseInvoice").find("input").val("");
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

})



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
