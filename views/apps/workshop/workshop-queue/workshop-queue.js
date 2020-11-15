$(document).ready(function () {
  var table = new Table();
  var tbl = $("#workshop-queue");
  table.loadCustomTable(tbl);
  table = null;



  /* open verify modal */
  $(document).on("click",".btnVerifySaleWorkshop",function () {
    var saleId = $(this).attr("sale-id");
    $("#modalVerifySaleWorkShop .txtSaleId").val(saleId);
  });
  /* open verify modal */


  /* verify sale workshop form */
  $("#frmVerifySaleWorkshop").on("submit",function (e) {
    e.preventDefault();


    var formValues = $("form#frmVerifySaleWorkshop").serializeJSON();
    var json = JSON.stringify(formValues);


    jQuery.ajax({
      type: "POST",
      url: "/workshop/verify-sale-workshop/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(this).find("button[type=submit]").html("<span class='fa fa-spinner fa-spin fa-2x fa-fw'></span>");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(response)
      {
        $(this).find("button[type=submit]").html("<span class='fa fa-spinner fa-spin fa-2x fa-fw'></span>");
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
          var table = new Table();
          var tbl = $("#workshop-queue");
          table.loadCustomTable(tbl);
          table = null;
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
  /* verify sale workshop form */

});



function overrideWorkshopQueue(table,data,additionalData) {
  $(".tbl-todays-works").find("tbody").html("");
  $(".tbl-tomorrows-works").find("tbody").html("");
  $(".tbl-other-works").find("tbody").html("");


  for (var i = 0; i < data.length; i++) {



    if (data[i]["todaysWorks"]) {
      var html = '<tr>';
      html += '<td>'+data[i]["todaysWorks"]["sale_id"]+'</td>';
      html += '<td>'+data[i]["todaysWorks"]["customer_name"]+'</td>';
      html += '<td>'+data[i]["todaysWorks"]["sale_barcode"]+'</td>';
      html += '<td>'+data[i]["todaysWorks"]["sale_delivery_date"]+'</td>';
      html += '<td>'
      html += '<button class="btn btn-sm btn-success btnVerifySaleWorkshop" sale-id="'+data[i]["todaysWorks"]["sale_id"]+'" data-toggle="modal" data-target="#modalVerifySaleWorkShop" > <span class="fa fa-check"></span> Onayla</button>'
      html += '</td>';
      html += '</tr>';


      $(".tbl-todays-works").find("tbody").append(html);
    }else if (data[i]["tomorrowsWorks"]) {
      var html = '<tr>';
      html += '<td>'+data[i]["tomorrowsWorks"]["sale_id"]+'</td>';
      html += '<td>'+data[i]["tomorrowsWorks"]["customer_name"]+'</td>';
      html += '<td>'+data[i]["tomorrowsWorks"]["sale_barcode"]+'</td>';
      html += '<td>'+data[i]["tomorrowsWorks"]["sale_delivery_date"]+'</td>';
      html += '<td>'
      html += '<button class="btn btn-sm btn-success btnVerifySaleWorkshop" sale-id="'+data[i]["tomorrowsWorks"]["sale_id"]+'" data-toggle="modal" data-target="#modalVerifySaleWorkShop" > <span class="fa fa-check"></span> Onayla</button>'
      html += '</td>';
      html += '</tr>';


      $(".tbl-tomorrows-works").find("tbody").append(html);
    }else {
      var html = '<tr>';
      html += '<td>'+data[i]["otherWorks"]["sale_id"]+'</td>';
      html += '<td>'+data[i]["otherWorks"]["customer_name"]+'</td>';
      html += '<td>'+data[i]["otherWorks"]["sale_barcode"]+'</td>';
      html += '<td>'+data[i]["otherWorks"]["sale_delivery_date"]+'</td>';
      html += '<td>'
      html += '<button class="btn btn-sm btn-success btnVerifySaleWorkshop" sale-id="'+data[i]["otherWorks"]["sale_id"]+'" data-toggle="modal" data-target="#modalVerifySaleWorkShop" > <span class="fa fa-check"></span> Onayla</button>'
      html += '</td>';
      html += '</tr>';


      $(".tbl-other-works").find("tbody").append(html);
    }
  }
}
