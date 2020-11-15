$(document).ready(function () {


  /* SEND SMS TO CUSTOMER*/
  $(".btnSendSmsToCustomer").on("click",function () {
    var customerId = $(this).attr("customer-id");
    var customerName = $(".txtCustomerName").val();
    $("#modalSendSmsToCustomer").find("#txtSmsCustomerId").val(customerName);
    $("#modalSendSmsToCustomer").find("#txtSmsCustomerId").attr("data-id",customerId);
  });
  /* SEND SMS TO CUSTOMER*/


  /* GET SALE PRODUCT PURCHASE PRICE */
  $(document).on("select",".txtSaleItemSaleProductId",function () {

    var saleProductId = $(this).attr("data-id");
    var row = $(this).closest("tr");
    var json = {
      "txtSaleProductId":saleProductId
    };
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: "/sale-product/get-sale-product-informations/"+saleProductId,
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(this).closest(".spanInputSearchLoading").removeClass("d-none");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(this).closest(".spanInputSearchLoading").addClass("d-none");
        var ajaxResponse = $.parseJSON(response);
        if (ajaxResponse.saleProductInformations) {
          row.find(".txtSaleItemPurchasePrice").val(ajaxResponse.saleProductInformations["sale_product_unit_purchase_price"]);
          row.find(".txtSaleItemPrice").val(ajaxResponse.saleProductInformations["sale_product_unit_selling_price"]);
          makeSaleCalculations();
        }
      }
    });
  })
  /* GET SALE PRODUCT PURCHASE PRICE */


  /* CANCEL SENDING SALE TO FACTORY */
  $(document).on("click",".btnCancelSendingSaleToFactory",function () {
    var saleId = $(this).attr("sale-id");
    var json = {
      "txtSaleId":saleId
    };
    json = JSON.stringify(json);


    jQuery.ajax({
      type: "POST",
      url: "/sale/cancel-sending-sale-to-factory/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingSendToFactory").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingSendToFactory").html("Kaydet");
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

  });
  /* CANCEL SENDING SALE TO FACTORY */

  /* SEND TO FACTORY */
  $(document).on("click",".btnSendToFactory",function () {
    var factoryId = $(this).attr("factory-id");
    var factoryUniqueId = $(this).attr("factory-unique-id");
    var saleId = $(this).closest(".modal").find(".txtSaleId").val();
    var json = {
      "txtSaleId":saleId,
      "txtFactoryId":factoryId,
      "txtFactoryUniqueId":factoryUniqueId
    };
    json = JSON.stringify(json);

    var informations = new Array();
    $(".span-stor-codes").each(function () {
      var storCodes = new Array();
      var storCodesHeights = new Array();
      var storCodesWidths = new Array();
      if ($(this).html() != "") {
        storCodes.push($(this).html());
      }
      $(this).closest(".div-rooms").find(".stor-widths").each(function functionName() {
        if ($(this).val() != "") {
          storCodesWidths.push($(this).val());
        }
      });
      $(this).closest(".div-rooms").find(".stor-heigts").each(function functionName() {
        if ($(this).val() != "") {
          storCodesHeights.push($(this).val());
        }
      });
      informationsJson = {
        "storCodes":storCodes,
        "storCodesWidths":storCodesWidths,
        "storCodesHeights":storCodesHeights
      };
      informations.push(informationsJson);
    })
    console.log(informations);

    var html = '<table>';
    html += '<tbody>';
    for (var i = 0; i < informations.length; i++) {
      for (var a = 0; a < informations[i]["storCodesWidths"].length; a++) {
        html += '<tr>';
        html += '<td>'+informations[i]["storCodes"][0]+' -----> </td>';
        html += '<td>'+informations[i]["storCodesWidths"][a]+'</td>';
        html += '<td> X </td>';
        html += '<td>'+informations[i]["storCodesHeights"][a]+'</td>';
        html += '</tr>';
      }
    }
    html += '</tbody>';
    html += '</table>';

    Swal.fire({
      title: 'Kontrol Ediniz!',
      html: html,
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#512DA8',
      cancelButtonColor: '#d33',
      cancelButtonText: 'İptal',
      confirmButtonText: 'Onaylıyorum'
    }).then((result) => {
      if (result.value) {
        jQuery.ajax({
          type: "POST",
          url: "/sale/send-sale-to-factory/",
          data: {post:json},
          cache: false,
          beforeSend: function() {
            $(".btnLoadingSendToFactory").html("fa fa-spinner fa-spin fa-2x fa-fw");
          },
          error:function(err){
            alert(err.responseText);
          },
          success: function(response)
          {
            $(".btnLoadingSendToFactory").html("Kaydet");
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
              $("#modalFactoryList").modal("hide");
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
      }
    });



  });
  /* SEND TO FACTORY */

  /* SEND TO WORKSHOP */
  $(document).on("click",".btnSendToWorkshop",function () {
    var workshopId = $(this).attr("workshop-id");
    var saleId = $(this).closest(".modal").find(".txtSaleId").val();
    var json = {
      "txtSaleId":saleId,
      "txtWorkshopId":workshopId
    };
    json = JSON.stringify(json);


    jQuery.ajax({
      type: "POST",
      url: "/sale/send-sale-to-workshop/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".btnLoadingSendToWorkshop").html("fa fa-spinner fa-spin fa-2x fa-fw");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(".btnLoadingSendToWorkshop").html("Kaydet");
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
          $("#modalWorkshopList").modal("hide");
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

  });
  /* SEND TO WORKSHOP */



    /* CANCEL SENDING SALE TO FACTORY */
    $(document).on("click",".btnCancelSendingSaleToWorkshop",function () {
      var saleId = $(this).attr("sale-id");
      var json = {
        "txtSaleId":saleId
      };
      json = JSON.stringify(json);


      jQuery.ajax({
        type: "POST",
        url: "/sale/cancel-sending-sale-to-workshop/",
        data: {post:json},
        cache: false,
        beforeSend: function() {
          $(".btnLoadingSendToWorkshop").html("fa fa-spinner fa-spin fa-2x fa-fw");
        },
        error:function(err){
          alert(err.responseText);
        },
        success: function(response)
        {
          $(".btnLoadingSendToWorkshop").html("Kaydet");
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

    });
    /* CANCEL SENDING SALE TO FACTORY */


  /* PRINT BUTTON */

  /* sevkiyat şablonu yazdırma */
  $(".btnPrintSale").on("click",function () {

    $(".no-print").addClass("d-none");
    $(".printScale").removeClass("col-md-12");
    $(".printScale").addClass("col-sm-6");
    $(".column2").removeClass("col-md-2");
    $(".column2").addClass("col-sm-12");
    $(".column2").addClass("col-md-12");

    var divToPrint=document.getElementById('divPrint');

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    var html = '<html style="font-size:1.5em;">';
    html += '<head>';
    html += '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    html += '<link rel="stylesheet" href="/assets/css/common.css">';
    html += '<style>';
    html += '.divRoomDescription{font-size:0.7em!important;}';
    html += '.form-group{margin-bottom:0.2rem!important;}';
    html += '.divStorCodes{font-size:0.7em!important;}';
    html += '.table{margin-bottom:0;}';
    html += '.tblTotalInformations{font-size:1.2em;float:right;}';
    html += '.table td, .table th{padding:0;}';
    html += 'h3{font-size:1em!important;}';
    html += '.form-control-sm {';
    html += 'height: calc(1.5em + 0px);';
    html += 'padding: 0;';
    html += 'font-size: 1.2rem;';
    html += 'line-height: 1;';
    html += 'border-radius: .2rem;';
    html += '}';

    html += '</style>';

    html += '</head>';
    html += '<body onload="window.print()">';
    html += '<div class="row">';
    html += divToPrint.innerHTML;
    html += '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>';
    html += '</div>';
    html += '</body>';
    html += '</html>';


    newWin.document.write(html);

    newWin.document.close();

    setTimeout(function(){
      newWin.close();
      location.reload();
    }, 100);
  })
  /* sevkiyat şablonu yazdırma */
  // $(".btnPrintSale").on("click",function () {
  //   $(".no-print").addClass("d-none");
  //   $(".printScale").removeClass("col-md-12");
  //   $(".printScale").addClass("col-md-6");
  //   $(".column2").removeClass("col-md-2");
  //   $(".column2").addClass("col-md-4");
  //   window.print();
  //   setTimeout(function () {
  //     $(".column2").removeClass("col-md-4");
  //     $(".column2").addClass("col-md-2");
  //     $(".no-print").removeClass("d-none");
  //     $(".printScale").removeClass("col-md-6");
  //     $(".printScale").addClass("col-md-12");
  //   }, 100);
  // })
  /* PRINT BUTTON */

  /* SALE INPUT CHANGE EVENT */
  $(document).on("input",".frmSale input",function () {
    makeSaleCalculations();
  })
  $(document).on("change",".frmSale select",function () {
    makeSaleCalculations();
  })
  /* SALE INPUT CHANGE EVENT */

  /* SALE LIST MODAL BUTTON */
  $(".btnModalSaleCollections").on("click",function () {
    var table = new Table();
    var tbl = $("#sale-collection-list");
    var saleId = $(this).attr("sale-id");
    tbl.closest("div.table-responsive").find("#txtSearchSaleId").val(saleId);
    tbl.closest("div.table-responsive").find("form").submit();
    table = null;
  })
  /* SALE LIST MODAL BUTTON */

  /* TAKE SALE COLLECTION */
  $("#frmTakeSaleCollection").on("submit",function (e) {
    e.preventDefault();

    var formValues = $("form#frmTakeSaleCollection").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/sale-collection/take-sale-collection/",
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
          $("#modalTakeSaleCollection").modal("hide");
          if (formValues["txtSaleCollectionSendSmsToCustomer"]) {
            $("#modalSendSmsToCustomer").modal("show");
            $("#modalSendSmsToCustomer #txtSmsText").val("Sn. müşterimiz, ödeme yaptığınız için teşekkür eder, iyi günlerde kullanmanızı dileriz.");
            var customerId = $(".txtSaleCustomerId").val();
            var customerName = $(".txtCustomerName").val();
            $("#modalSendSmsToCustomer #txtSmsCustomerId").attr("data-id",customerId);
            $("#modalSendSmsToCustomer #txtSmsCustomerId").val(customerName);
          }else {
            location.reload();
          }
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
  /* TAKE SALE COLLECTION */



  /* BRILLANT MEASUREMENT CODES */
  /* add new brillant measure */
  $(document).on("click",".btnAddBrillantMeasure",function () {
    var index = parseInt($(".brillant-measurements .form-inline:last").index());
    index = index + 2;

    var html = '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" required="" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" required="" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">';
    html += '</div>';


    $(this).closest(".div-brillant-container").find(".brillant-measurements").append(html);
  })
  /* add new brillant measure */

  /* delete brillant measure */
  $(document).on("click",".btnDeleteBrillantMeasure",function () {
    $(this).closest(".rowRoom").find(".brillant-measurements .form-group:last").remove();
  })
  /* delete brillant measure */
  /* BRILLANT MEASUREMENT CODES */


  /* STOR MEASUREMENT CODES */
  /* add new stor measure */
  $(document).on("click",".btnAddStorMeasure",function () {
    var index = parseInt($(".stor-measurements .form-inline:last").index());
    index = index + 2;

    var html = '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" required="" class="txtSaleItemStorWidth form-control col-12" placeholder="STOR EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" required="" class="txtSaleItemStorHeight form-control col-12" placeholder="STOR BOY">';
    html += '</div>';


    $(this).closest(".div-stor-container").find(".stor-measurements").append(html);
  })
  /* add new stor measure */

  /* delete stor measure */
  $(document).on("click",".btnDeleteStorMeasure",function () {
    $(this).closest(".rowRoom").find(".stor-measurements .form-group:last").remove();

  })
  /* delete stor measure */
  /* STOR MEASUREMENT CODES */

  /* GET DISCOUNTS */
  $(".txtSaleDiscountId").on("click",function () {
    jQuery.ajax({
      type: "POST",
      url: "/discount/get-discounts/",
      data: {post:1},
      cache: false,
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        var ajaxResponse = $.parseJSON(response);
        if (ajaxResponse.data) {
          $(".txtSaleDiscountId").html("");

          for (var i = 0; i < ajaxResponse.data.length; i++) {
            var html = '<option value="'+ajaxResponse.data[i]["discount_id"]+'" discount_type="'+ajaxResponse.data[i]["discount_type"]+'" discount_amount="'+ajaxResponse.data[i]["discount_amount"]+'">'+ajaxResponse.data[i]["discount_name"]+'</option>';
            $(".txtSaleDiscountId").append(html);
            $(".txtSaleDiscountId").select();
          }
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
  /* GET DISCOUNTS */

  /* ITEM COLUMN FUNCTIONS */
  $(document).on("click",".btnAddSaleItem",function () {
    var html = '<tr>';
    html += '<td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>';
    html += '<td>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" class="form-control form-control-sm input-search txtSaleItemProductCategoryId" name="txtSaleItemProductCategoryId" table="tbl_categories" model="category" property="name" click="true" required placeholder="Kategori">';
    html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html += '</div>';
    html += '</td>';
    html += '<td>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" class="form-control form-control-sm input-search txtSaleItemSaleProductId" name="txtSaleItemSaleProductId" table="tbl_sale_products" model="sale_product" property="name" click="true" required placeholder="Ürün">';
    html += '<span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html += '</div>';
    html += '</td>';
    html += '<td>';
    html += '<div class="form-group">';
    html += '<input type="number" step=".01" name="txtSaleItemPurchasePrice[]" required class="form-control form-control-sm txtSaleItemPurchasePrice" value="0" min="0">';
    html += '</div>';
    html += '</td>';
    html += '<td>';
    html += '<div class="form-group">';
    html += '<input type="number" step=".01" name="txtSaleItemPiece[]" required class="form-control form-control-sm txtSaleItemPiece" value="1" min="1">';
    html += '</div>';
    html += '</td>';
    html += '<td>';
    html += '<div class="form-group">';
    html += '<input type="number" step=".01" name="txtSaleItemPrice[]" required class="form-control form-control-sm txtSaleItemPrice" value="0" min="0">';
    html += '</div>';
    html += '</td>';
    html += '<td>';
    html += '<div class="form-group">';
    html += '<input type="number" step=".01" name="txtSaleItemTotal[]" required class="form-control form-control-sm txtSaleItemTotal" value="0" min="0">';
    html += '</div>';
    html += '</td>';
    html += '</tr>';


    $(this).closest(".tbl-sale-items").find("tbody").append(html);
  });

  $(document).on("click",".btnDeleteSaleItem",function () {
    $(this).closest("tr").remove();
  })
  /* ITEM COLUMN FUNCTIONS */



  /* ROOM NAME EDIT  */
  $(document).on("click",".spanEditRoomName",function () {
    var container = $(this).closest("h3");
    var roomName = container.find(".txtSaleItemRoomName").html();
    container.find("input").removeClass("d-none");
    container.find("input").val(roomName);
    container.find(".txtSaleItemRoomName").addClass("d-none");
  })
  /* ROOM NAME EDIT  */

  /* ADD ROOM */
  $(".btnAddRoom").on("click",function () {
    var html = '';
    html += '<div class="row rowRoom">';
    html += '<div class="col-lg-12">';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" class="form-control form-control-lg txtSaleItemRoomName" name="txtSaleItemRoomName[]" value="SALON" required>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-lg-6">';
    html += '<div class="div-brillant-container">';
    html += '<div class="form-group form-sale-group">';
    html += '<label for="" class="mr-3">TÜL :';
    html += '<button type="button" class="btn btn-sm btn-primary btnAddBrillantMeasure" name="button"> <span class="fa fa-plus"></span> </button>';
    html += '<button type="button" class="btn btn-sm btn-danger btnDeleteBrillantMeasure" name="button"> <span class="fa fa-trash"></span> </button>';
    html += '</label>';
    html += '</div>';
    html += '<div class="brillant-measurements">';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantWidth[]" class="form-control col-12 txtSaleItemBrillantWidth" placeholder="TÜL EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemBrillantHeight[]" class="form-control col-12 txtSaleItemBrillantHeight" placeholder="TÜL BOY">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="div-stor-container mt-3">';
    html += '<div class="form-group form-sale-group">';
    html += '<label for="" class="mr-3">STOR :';
    html += '<button type="button" class="btn btn-sm btn-primary btnAddStorMeasure" name="button"> <span class="fa fa-plus"></span> </button>';
    html += '<button type="button" class="btn btn-sm btn-danger btnDeleteStorMeasure" name="button"> <span class="fa fa-trash"></span> </button>';
    html += '</label>';
    html += '</div>';
    html += '<div class="stor-measurements">';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="txtSaleItemStorWidth form-control col-12" placeholder="STOR EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="txtSaleItemStorHeight form-control col-12" placeholder="STOR BOY">';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="txtSaleItemStorWidth form-control col-12" placeholder="STOR EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="txtSaleItemStorHeight form-control col-12" placeholder="STOR BOY">';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="txtSaleItemStorWidth form-control col-12" placeholder="STOR EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="txtSaleItemStorHeight form-control col-12" placeholder="STOR BOY">';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorWidth[]" class="txtSaleItemStorWidth form-control col-12" placeholder="STOR EN">';
    html += '<input type="text" autocomplete="off" name="txtSaleItemStorHeight[]" class="txtSaleItemStorHeight form-control col-12" placeholder="STOR BOY">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    // html += '<div class="col-lg-3">';
    // html +='  <div class="form-group form-sale-group">';
    // html +='    <label for="">STOR KODU :</label>';
    // html +='    <input type="text" autocomplete="off" name="txtSaleItemStorCode[]" class="txtSaleItemStorCode form-control col-6" placeholder="STOR KODU">';
    // html +='  </div>';
    // html +='  <div class="form-group form-sale-group mt-2">';
    // html +='    <label for="">PİLE SIKLIĞI :</label>';
    // html +='    <input type="text" autocomplete="off" name="txtSaleItemPileDensity[]" class="txtSaleItemPileDensity form-control col-6" placeholder="PİLE SIKLIĞI">';
    // html +='  </div>';
    // html +='  <div class="form-group form-sale-group mt-2">';
    // html +='    <label for="">ODA DOSYASI :</label>';
    // html +='    <input type="file" name="txtSaleItemFile[]" class="txtSaleItemFile form-control col-6" >';
    // html +='  </div>';
    // html +='  <div class="form-group form-sale-group mt-2">';
    // html +='    <label for="">ODA AÇIKLAMASI :</label>';
    // html +='    <input type="text" autocomplete="off" name="txtSaleItemDescription[]" class="txtSaleItemDescription form-control col-12" placeholder="ODA AÇIKLAMASI">';
    // html +='</div>';
    //
    // html +='</div>';
    html +='<div class="col-lg-6">';
    html +='  <div class="table-responsive tbl-sale-items-container">';
    html +='    <table class="table tbl-sale-items">';
    html +='      <thead>';
    html +='        <tr>';
    html +='          <th><button type="button" class="btn btn-sm btn-success btnAddSaleItem" name="button"><span class="fa fa-plus"></span> </button></th>';
    html +='          <th>KATEGORİ</th>';
    html +='          <th class="width50">ÜRÜN</th>';
    html +='          <th class="width20">ALIŞ FİYATI</th>';
    html +='          <th>MİKTAR</th>';
    html +='          <th class="width20">FİYAT </th>';
    html +='          <th>TOPLAM</th>';
    html +='        </tr>';
    html +='      </thead>';
    html +='      <tbody>';
    html +='        <tr>';
    html +='          <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>';
    html +='          <td>';
    html +='            <!-- form group -->';
    html +='              <div class="form-group">';
    html +='              <input';
    html +='              type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"';
    html +='              name="txtSaleItemProductCategoryId"';
    html +='              table="tbl_categories"';
    html +='              model="category"';
    html +='              property="name"';
    html +='              click="true"';
    html +='              value="FON"';
    html +='              data-id="6"';
    html +='              required';
    html +='                placeholder="Kategori"';
    html +='              >';
    html +='              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='              </div>';
    html +='          </td>';
    html +='            <td>';
    html +='          <div class="form-group">';
    html +='            <input';
    html +='            type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemSaleProductId"';
    html +='            name="txtSaleItemSaleProductId"';
    html +='            table="tbl_sale_products"';
    html +='            model="sale_product"';
    html +='            property="name"';
    html +='            click="true"';
    html +='            value=""';
    html +='            required';
    html +='            placeholder="Ürün"';
    html +='            >';
    html +='            <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='          </div>';
    html +='      </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" required class="form-control form-control-sm txtSaleItemPurchasePrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPiece[]" required class="form-control form-control-sm txtSaleItemPiece" value="1" min="1">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPrice[]" required class="form-control form-control-sm txtSaleItemPrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemTotal[]" required class="form-control form-control-sm txtSaleItemTotal" value="0" min="0">';
    html +='          </div>';
    html +='          </td>';
    html +='        </tr>';
    html +='        <tr>';
    html +='          <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>';
    html +='          <td>';
    html +='            <!-- form group -->';
    html +='              <div class="form-group">';
    html +='              <input';
    html +='              type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"';
    html +='              name="txtSaleItemProductCategoryId"';
    html +='              table="tbl_categories"';
    html +='              model="category"';
    html +='              property="name"';
    html +='              click="true"';
    html +='              value="TÜL"';
    html +='              data-id="5"';
    html +='              required';
    html +='                placeholder="Kategori"';
    html +='              >';
    html +='              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='              </div>';
    html +='          </td>';
    html +='            <td>';
    html +='          <div class="form-group">';
    html +='            <input';
    html +='            type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemSaleProductId"';
    html +='            name="txtSaleItemSaleProductId"';
    html +='            table="tbl_sale_products"';
    html +='            model="sale_product"';
    html +='            property="name"';
    html +='            click="true"';
    html +='            value=""';
    html +='            required';
    html +='            placeholder="Ürün"';
    html +='            >';
    html +='            <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='          </div>';
    html +='      </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" required class="form-control form-control-sm txtSaleItemPurchasePrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPiece[]" required class="form-control form-control-sm txtSaleItemPiece" value="1" min="1">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPrice[]" required class="form-control form-control-sm txtSaleItemPrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemTotal[]" required class="form-control form-control-sm txtSaleItemTotal" value="0" min="0">';
    html +='          </div>';
    html +='          </td>';
    html +='        </tr>';
    html +='        <tr>';
    html +='          <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>';
    html +='          <td>';
    html +='            <!-- form group -->';
    html +='              <div class="form-group">';
    html +='              <input';
    html +='              type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"';
    html +='              name="txtSaleItemProductCategoryId"';
    html +='              table="tbl_categories"';
    html +='              model="category"';
    html +='              property="name"';
    html +='              click="true"';
    html +='              value="STOR-ZEBRA"';
    html +='              data-id="10"';
    html +='              required';
    html +='                placeholder="Kategori"';
    html +='              >';
    html +='              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='              </div>';
    html +='          </td>';
    html +='            <td>';
    html +='          <div class="form-group">';
    html +='            <input';
    html +='            type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemSaleProductId"';
    html +='            name="txtSaleItemSaleProductId"';
    html +='            table="tbl_sale_products"';
    html +='            model="sale_product"';
    html +='            property="name"';
    html +='            click="true"';
    html +='            value=""';
    html +='            required';
    html +='            placeholder="Ürün"';
    html +='            >';
    html +='            <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='          </div>';
    html +='      </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" required class="form-control form-control-sm txtSaleItemPurchasePrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPiece[]" required class="form-control form-control-sm txtSaleItemPiece" value="1" min="1">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPrice[]" required class="form-control form-control-sm txtSaleItemPrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemTotal[]" required class="form-control form-control-sm txtSaleItemTotal" value="0" min="0">';
    html +='          </div>';
    html +='          </td>';
    html +='        </tr>';
    html +='        <tr>';
    html +='          <td> <button type="button" class="btn btn-sm btn-danger btnDeleteSaleItem" name="button"><span class="fa fa-trash"></span> </button> </td>';
    html +='          <td>';
    html +='            <!-- form group -->';
    html +='              <div class="form-group">';
    html +='              <input';
    html +='              type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemProductCategoryId pointer-events-none"';
    html +='              name="txtSaleItemProductCategoryId"';
    html +='              table="tbl_categories"';
    html +='              model="category"';
    html +='              property="name"';
    html +='              click="true"';
    html +='              value="DİĞER"';
    html +='              data-id="11"';
    html +='              required';
    html +='                placeholder="Kategori"';
    html +='              >';
    html +='              <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='              </div>';
    html +='          </td>';
    html +='            <td>';
    html +='          <div class="form-group">';
    html +='            <input';
    html +='            type="text" autocomplete="off"';
    html +='              class="form-control form-control-sm input-search txtSaleItemSaleProductId"';
    html +='            name="txtSaleItemSaleProductId"';
    html +='            table="tbl_sale_products"';
    html +='            model="sale_product"';
    html +='            property="name"';
    html +='            click="true"';
    html +='            value=""';
    html +='            required';
    html +='            placeholder="Ürün"';
    html +='            >';
    html +='            <span class="fa fa-spinner fa-spin fa-fw d-none spanInputSearchLoading"></span>';
    html +='          </div>';
    html +='      </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPurchasePrice[]" required class="form-control form-control-sm txtSaleItemPurchasePrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPiece[]" required class="form-control form-control-sm txtSaleItemPiece" value="1" min="1">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemPrice[]" required class="form-control form-control-sm txtSaleItemPrice" value="0" min="0">';
    html +='          </div>';
    html +='        </td>';
    html +='        <td>';
    html +='          <div class="form-group">';
    html +='            <input type="number" step=".01" name="txtSaleItemTotal[]" required class="form-control form-control-sm txtSaleItemTotal" value="0" min="0">';
    html +='          </div>';
    html +='          </td>';
    html +='        </tr>';
    html +='      </tbody>';
    html +='      </table>';
    html +='    </div>';

    html +='  </div>';


    html +='<div class="row inline-flex">';
    html +='<div class="col-lg-12">';
    html +='<div class="form-inline inline-block form-sale-group">';
    html +='<input type="text" autocomplete="off" name="txtSaleItemStorCode[]" class="form-control col-12 txtSaleItemStorCode" placeholder="STOR KODU">';
    html +='</div>';
    html +='<div class="form-inline inline-block form-sale-group mt-2">';
    html +='<input type="text" autocomplete="off" name="txtSaleItemPileDensity[]" class="form-control col-12 txtSaleItemPileDensity" placeholder="PİLE SIKLIĞI">';
    html +='</div>';
    html +='<div class="form-inline inline-block form-sale-group mt-2">';
    html +='<input type="file" name="txtSaleItemFile[]" class="form-control col-12 txtSaleItemFile">';
    html +='</div>';
    html +='<div class="form-inline inline-block form-sale-group mt-2">';
    html +='<input type="text" autocomplete="off" name="txtSaleItemDescription[]" class="form-control col-12 txtSaleItemDescription" placeholder="ODA AÇIKLAMASI">';
    html +='</div>';
    html +='</div>';
    html +='</div>';

    html +='  <div class="col-lg-12">';
    html +='    <button type="button" class="btn btn-danger btn-lg float-right btnDeleteRoom" name="button"> <span class="fa fa-trash"></span> Odayı Sil</button>';
    html +='  </div>';
    html +='  </div>';
    html +='  <hr class="room-seperator">';


    $(".rooms-container").append(html);

  })
  /* ADD ROOM */

  /* DELETE ROOM */
  $(document).on("click",".btnDeleteRoom",function () {
    $(".room-seperator:last").remove();
    $(this).closest(".rowRoom").remove();
  })
  /* DELETE ROOM */



})


function makeSaleCalculations() {
  var saleItemTotal = 0;

  $(".tbl-sale-items tbody tr").each(function () {
    var productPurchasePrice = parseFloat($(this).find(".txtSaleItemPurchasePrice").val());
    var productPiece = parseFloat($(this).find(".txtSaleItemPiece").val());
    var productPrice = parseFloat($(this).find(".txtSaleItemPrice").val());
    var productTotal = productPiece * productPrice;

    $(this).find(".txtSaleItemTotal").val(productTotal.toFixed(2));

  })

  $(".txtSaleItemTotal").each(function () {
    saleItemTotal = saleItemTotal + parseFloat($(this).val());
  });

  $(".txtSaleSubTotal").val(saleItemTotal.toFixed(2));

  var discountAmount = $(".txtSaleDiscountAmount").val();

  saleItemTotal = saleItemTotal - discountAmount;

  $(".txtSaleTotal").val(saleItemTotal.toFixed(2));

}
