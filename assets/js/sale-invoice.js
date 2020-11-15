$(document).ready(function () {

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


  /* delete row */
  $(document).on("click",".btnDeleteRow",function () {
    if($(this).closest("tr").index() == 0){
      return false;
    }
    $(this).closest("tr").remove();
  })
  /* delete row */


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
            row.find(".txtSaleInvoiceItemPurchasePrice").val(ajaxResponse.saleProductInformations["sale_product_unit_purchase_price"]);

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

  /* new sale- submit */
  $("form#frmNewSaleInvoice").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmNewSaleInvoice").serializeJSON();
    $("#frmNewSaleInvoice input").each(function () {
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
    $(".txtSaleInvoiceProductId").each(function () {
      var productId = $(this).attr("data-id");
      product_ids.push(productId);
    });
    formValues["txtSaleInvoiceItemProductId"] = product_ids;

    formValues["txtSaleInvoiceSubTotal"] = $(".spanSubTotal").html();
    var taxTotal = 0;
    $(".spanTaxTotal").each(function () {
      taxTotal = taxTotal + parseFloat($(this).html());
    })
    formValues["txtSaleInvoiceTaxTotal"] = $(".spanTaxTotal").html();
    formValues["txtSaleInvoiceTotal"] = $(".spanTotal").html();


    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/sale-invoice/new-sale-invoice/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingNewSaleInvoice").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingNewSaleInvoice").html("Kaydet");
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
          $("#frmNewSaleInvoice").find("input").val("");
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

})



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
