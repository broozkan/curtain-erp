$(document).ready(function () {

  var barcodeValue = $("#txtSaleBarcode").val();
  $("#demo").barcode(
    barcodeValue, // Value barcode (dependent on the type of barcode)
    "code128" // type (string)
  );


  /* ASK FOR JOBS */
  if ($(".btnModalFactoryList").length > 0) {
    askForFactory(function callback(result) {

    });
  }

  /* ASK FOR JOBS */


  /* LOAD FACTORY LIST */
  $(".btnModalFactoryList").on("click",function () {
    var saleId = $(this).attr("sale-id");
    $("#modalFactoryList").find(".txtSaleId").val(saleId);

    var table = new Table();
    var tbl = $("#factory-list");
    table.loadCustomTable(tbl);
    table = null;
  })
  /* LOAD FACTORY LIST */


  /* LOAD WORKSHOP LIST */
  $(".btnModalWorkshopList").on("click",function () {
    var saleId = $(this).attr("sale-id");
    $("#modalWorkshopList").find(".txtSaleId").val(saleId);

    var table = new Table();
    var tbl = $("#workshop-list");
    table.loadCustomTable(tbl);
    table = null;
  })
  /* LOAD WORKSHOP LIST */

  /* LOAD SUPPLIER LIST */
  $(".btnModalSupplierList").on("click",function () {
    var table = new Table();
    var tbl = $("#supplier-list");
    table.loadCustomTable(tbl);
    table = null;
  })
  /* LOAD SUPPLIER LIST */
})

/* OVERRIDE FACTORY LIST */
function overrideFactoryList(table,data,additionalData) {
  for (var i = 0; i < data.length; i++) {
    var html = '<tr>';
    html += '<td>'+data[i]["factory_name"]+'</td>';
    html += '<td><button class="btn btn-sm btn-primary btnSendToFactory" factory-unique-id="'+data[i]["factory_unique_id"]+'" factory-id="'+data[i]["factory_id"]+'" >Gönder</button></td>';
    html += '</tr>';
    table.find("tbody").append(html);
  }
}
/* OVERRIDE FACTORY LIST */

/* OVERRIDE WORKSHOP LIST */
function overrideWorkshopList(table,data,additionalData) {
  for (var i = 0; i < data.length; i++) {
    var html = '<tr>';
    html += '<td>'+data[i]["workshop_name"]+'</td>';
    html += '<td><button class="btn btn-sm btn-primary btnSendToWorkshop" workshop-unique-id="'+data[i]["workshop_unique_id"]+'" workshop-id="'+data[i]["workshop_id"]+'" >Gönder</button></td>';
    html += '</tr>';
    table.find("tbody").append(html);
  }
}
/* OVERRIDE WORKSHOP LIST */

/* OVERRIDE SUPPLIER LIST */
function overrideSupplierList(table,data,additionalData) {
  for (var i = 0; i < data.length; i++) {
    var html = '<tr>';
    html += '<td>'+data[i]["supplier_name"]+'</td>';
    html += '<td>'+data[i]["supplier_phone_number"]+'</td>';
    html += '<td>'+data[i]["supplier_address"]+'</td>';
    html += '<td>'+data[i]["supplier_email"]+'</td>';
    html += '<td><button class="btn btn-sm btn-primary btnSendToSupplier" supplier-id="'+data[i]["supplier_id"]+'" >Gönder</button></td>';
    html += '</tr>';
    table.find("tbody").append(html);
  }
}
/* OVERRIDE SUPPLIER LIST */

/* OVERRIDE SALE COLLECTION LIST */
function overrideSaleCollectionList(table,data,additionalData) {
  for (var i = 0; i < data.length; i++) {
    var html = '<tr>';
    html += '<td>'+data[i]["payment_method_name"]+'</td>';
    html += '<td>'+data[i]["sale_collection_amount"]+'</td>';
    html += '<td>'+data[i]["sale_collection_date"]+'</td>';
    html += '<td>'+data[i]["employee_name"]+'</td>';
    html += '<td><button class="btn btn-sm btn-danger btnDeleteObject" object-model="sale-collection" object-id="'+data[i]["sale_collection_id"]+'" >Sil</button></td>';
    html += '</tr>';
    table.find("tbody").append(html);
  }
}
/* OVERRIDE SALE COLLECTION LIST */


/* ask for factory */
function askForFactory(callback) {
  Swal.fire({
    title: 'Fabrikaya gönderilsin mi?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#512DA8',
    cancelButtonColor: '#d33',
    cancelButtonText: 'İptal',
    confirmButtonText: 'Evet'
  }).then((result) => {
    if (result.value) {
      $(".btnModalFactoryList").trigger("click");
      callback(true);
    }
  })
}
/* ask for factory */
