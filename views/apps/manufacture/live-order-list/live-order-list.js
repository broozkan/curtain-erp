$(document).ready(function () {
  var table = new Table();
  var tbl = $("#live-order-list");
  table.loadCustomTable(tbl);

  // table.loadCustomTable(tbl);

  /* ADD STOCK ROW */
  $(document).on("click",".btnAddStockProductRow",function () {
    var html = '<div class="form-inline div-stock-informations">';
    html += $(".div-stock-informations:last").html();
    html += '</div>';
    $(".form-inline-container").append(html);
  })
  /* ADD STOCK ROW */

  /* ADD STOCK ROW */
  $(document).on("click",".btnDeleteStockProductRow",function () {
    var rowLength = $(".div-stock-informations").length;
    if (rowLength < 2) {
      return false;
    }
    $(this).closest(".div-stock-informations").remove();
  })
  /* ADD STOCK ROW */
  initBarcodes();


  /* RENEW TABLE BUTTON */
  $(".btnRefreshOrders").on("click",function () {
    var table = new Table();
    var tbl = $("#live-order-list");
    table.loadCustomTable(tbl);
  })
  /* RENEW TABLE BUTTON */

  /* print order */
  $(".btnPrintOrder").on("click",function () {

  })
  /* print order */

})


function overrideLiveOrderList(table,data,additionalData) {
  for (var i = 0; i < data.length; i++) {
    var html = '<tr>';
    html += '<td>';
    html += '<div class="form-group" style="width:10vw;">';
    html += '<p> <strong>Müşteri :</strong> '+data[i]["customer_name"]+'</p>';
    html += '<p> <strong>Adres :</strong> '+data[i]["customer_address"]+'</p>';
    html += '<p> <strong>Sipariş Giren :</strong> '+data[i]["employee_name"]+'</p>';
    html += '<p> <strong>Sipariş Tarihi :</strong> '+data[i]["sale_query_date"]+'</p>';
    html += '<div class="demo" barcode="'+data[i]["sale_barcode"]+'"></div>';
    html += '</div>';
    // html += '<div class="form-group ml-3">';
    // html += '<div class="demo" barcode="'+data[i]["sale_barcode"]+'"></div>';
    // html += '</div>';
    html += '<div class="form-group ml-5">';
    html += '<p class="font-weight-bold">STOR KODU</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      html += '<p>'+data[i]["sale_informations"][a]["sale_information_stor_code"]+'</p>';
    }
    html += '</div>';
    html += '<div class="form-group ml-1">';
    html += '<p class="font-weight-bold">MİKTAR</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      for (var b = 0; b < data[i]["sale_informations"][a]["sale_information_product_pieces"].length; b++) {
        html += '<p>'+data[i]["sale_informations"][a]["sale_information_product_pieces"][b]+'</p>';
      }
    }
    html += '</div>';
    html += '<div class="form-group ml-1">';
    html += '<p class="font-weight-bold">EN</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      for (var b = 0; b < data[i]["sale_informations"][a]["sale_information_stor_widths"].length; b++) {
        html += '<p>'+data[i]["sale_informations"][a]["sale_information_stor_widths"][b]+'</p>';
      }
    }
    html += '</div>';
    html += '<div class="form-group ml-1">';
    html += '<p class="font-weight-bold">X</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      for (var b = 0; b < data[i]["sale_informations"][a]["sale_information_stor_heights"].length; b++) {
        html += '<p>x</p>';
      }
    }
    html += '</div>';
    html += '<div class="form-group ml-1">';
    html += '<p class="font-weight-bold">BOY</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      for (var b = 0; b < data[i]["sale_informations"][a]["sale_information_stor_heights"].length; b++) {
        html += '<p>'+data[i]["sale_informations"][a]["sale_information_stor_heights"][b]+'</p>';
      }
    }
    html += '</div>';
    html += '<div class="form-group ml-1">';
    html += '<p class="font-weight-bold">MT2</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      for (var b = 0; b < data[i]["sale_informations"][a]["sale_information_stor_heights"].length; b++) {
        var squareMeter = parseFloat(data[i]["sale_informations"][a]["sale_information_stor_heights"][b]) * parseFloat(data[i]["sale_informations"][a]["sale_information_stor_widths"][b]);
        html += '<p>'+squareMeter.toFixed(2)+' Mt2</p>';
      }
    }
    html += '</div>';
    html += '<div class="form-group ml-1">';
    html += '<p class="font-weight-bold">AÇIKLAMA</p>';
    for (var a = 0; a < data[i]["sale_informations"].length; a++) {
      html += '<p>'+data[i]["sale_informations"][a]["sale_information_room_description"]+'</p>';
    }
    html += '</div>';

    html += '<div class="form-group ml-3">';
    html += '<label for="txtSaleProductId">Ürün  <sup>Sipariş olarak girilen ürünün fabrikadaki karşılığı</sup> </label>';
    html += '<input type="text" class="form-control col-12 input-search mb-3" name="txtSaleProductId" table="tbl_sale_products" model="sale_product" property="name" click="true" required>';
    html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html += '<button type="button" class="btn btn-sm btn-success btnAddStockProductRow " name="button"> <span class="fa fa-plus"></span> </button>';
    html += '<div class="form-inline-container">';
    html += '<div class="form-inline div-stock-informations">';
    html += '<input type="text" class="form-control form-control-sm col-6" name="" value="">';
    html += '<input type="text" class="form-control form-control-sm col-4" name="" value="M2">';
    html += '<input type="text" class="form-control form-control-sm col-2" name="" value="3">';
    html += '<button type="button" class="btn btn-sm btn-danger btnDeleteStockProductRow " name="button"> <span class="fa fa-trash"></span> </button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group ml-3">';
    html += '<button type="button" class="btn btn-lg btn-danger btnPrintOrder" name="button"> <span class="fa fa-print"></span> Onayla ve Yazdır</button>';
    html += '</div>';
    html += '</td>';

    table.find("tbody").append(html);
    initBarcodes();
  }
}

function initBarcodes() {
  /* init barcodes */
  $("#live-order-list tbody").find(".demo").each(function () {
    var barcodeValue = $(this).attr("barcode");
    $(this).barcode(
      barcodeValue, // Value barcode (dependent on the type of barcode)
      "code128" // type (string)
    );
  })
  /* init barcodes */
}
