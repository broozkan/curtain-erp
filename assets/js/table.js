$(document).ready(function () {

  /* Item per page changed */
  $(document).on("change",".txtItemPerPage",function () {
    var tbl = $(this).closest("div.table-responsive").find("table");
    var itemPerPage = $(this).find("option:selected").val();
    tbl.attr("item-per-page",itemPerPage);
    var table = new Table();
    table.loadTable(tbl);
  })
  /* Item per page changed */

  /* Item per page changed */
  $(document).on("change",".txtCustomItemPerPage",function () {
    var tbl = $(this).closest("div.table-responsive").find("table");
    var itemPerPage = $(this).find("option:selected").val();
    tbl.attr("item-per-page",itemPerPage);
    var table = new Table();
    table.loadCustomTable(tbl);
  })
  /* Item per page changed */

  $(document).on("click",".page-link-last",function () {


  })

  /* pagination click function */
  $(document).on("click",".pagination a.page-link",function () {
    var tbl = $(this).closest("div.table-responsive").find("table");
    var clickedPage = $(this).html();
    tbl.attr("page-number",clickedPage);
    var table = new Table();
    table.loadTable(tbl);
  })
  /* pagination click function */


  /* custom-pagination click function */
  $(document).on("click",".custom-pagination a.page-link",function () {
    var tbl = $(this).closest("div.table-responsive").find("table");
    var clickedPage = $(this).html();
    tbl.attr("page-number",clickedPage);
    var table = new Table();
    table.loadCustomTable(tbl);
  })
  /* custom-pagination click function */


  /* filter form submit */
  $(document).on("submit",".frmTableSearch",function (e) {
    e.preventDefault();

    var tbl = $(this).closest("div.table-responsive").find("table");

    var table = new Table();
    table.loadTable(tbl);
  })
  /* filter form submit */


  /* custom table filter form submit */
  $(document).on("submit",".frmCustomTableSearch",function (e) {
    e.preventDefault();

    var tbl = $(this).closest("div.table-responsive").find("table");

    var table = new Table();
    table.loadCustomTable(tbl);
  })
  /* custom table filter form submit */


  /* table row delete */
  $(document).on("click",".btnDeleteObject",function () {

    Swal.fire({
      title: 'Emin misiniz?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#512DA8',
      cancelButtonColor: '#d33',
      cancelButtonText: 'İptal',
      confirmButtonText: 'Evet'
    }).then((result) => {
      if (result.value) {

        var tbl = $(this).closest("table");
        var model = $(this).attr("object-model");
        var id = $(this).attr("object-id");

        var table = new Table();
        table.delete(tbl,model,id);
      }
    })

    /* table row delete */

  })
})



class Table {


  /* loading data */
  loadTable(table) {

    var model = table.attr("model");
    var itemPerPage = table.closest("div.table-responsive").find(".txtItemPerPage").find("option:selected").val();
    var pageNumber = parseInt(table.attr("page-number"));
    var filters = table.closest("div.table-responsive").find(".frmTableSearch").serializeJSON();
    var isOverride = table.attr("is-override");
    var modelUrl = model.replace("_", "-");
    var overrideFunctionName = table.attr("override-function");

    var json = {
      "model":model,
      "itemPerPage":itemPerPage,
      "pageNumber":pageNumber,
      "filters":filters
    }
    json = JSON.stringify(json);


    jQuery.ajax({
      type: "POST",
      url: "/"+modelUrl+"/"+modelUrl+"-list/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".loading").removeClass("d-none");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(ajaxResponse)
      {
        $(".loading").addClass("d-none");
        table.find("tbody").html("");

        var ajaxResponse = $.parseJSON(ajaxResponse);
        if (ajaxResponse.data) {

          if (isOverride == "true") {
            if (!ajaxResponse.additionalData) {
              ajaxResponse.additionalData = null;
            }
            window[overrideFunctionName](table,ajaxResponse.data,ajaxResponse.additionalData);
          }

          for (var i = 0; i < ajaxResponse.data.length; i++) {
            if (isOverride == "true") {
              continue;
            }

            var html = '<tr id="'+ajaxResponse.data[i][""+model+"_id"]+'">';
            for (var key in ajaxResponse.data[i]) {
              if (ajaxResponse.data[i][key] == null) {
                ajaxResponse.data[i][key] = "-";
              }
              html += '<td>'+ajaxResponse.data[i][key]+'</td>';
            }

            html += '<td>';
            if (ajaxResponse.doesHaveProfile == true) {
              html += '<a class="btn btn-primary btn-sm" href="/'+modelUrl+'/'+modelUrl+'-profile/'+ajaxResponse.data[i][""+model+"_id"]+'" >Profil</a>'
            }
            html += '<a class="btn btn-primary btn-sm ml-3 btnUpdate" href="/'+modelUrl+'/update-'+modelUrl+'/'+ajaxResponse.data[i][""+model+"_id"]+'" >Düzenle</a>'
            html += '<button class="btn btn-danger btn-sm ml-3 btnDeleteObject" object-model="'+model+'" object-id="'+ajaxResponse.data[i][""+model+"_id"]+'" >Sil</button>'
            html += '</td>';
            html += '<td></td>';
            html += '</tr>';
            table.find("tbody").append(html);
          }


          ajaxResponse.totalPageNumber = Math.ceil(ajaxResponse.totalPageNumber);


          table.closest("div.table-responsive").find("div.pagination").html("");
          if (ajaxResponse.totalPageNumber > 5) {
            var customPaginationHtml = '<a href="javascript:;" class="page-link page-link" value="1">1</a>';
            customPaginationHtml += '<a href="javascript:;" class="page-seperator" value="...">...</a>';
            table.closest("div.table-responsive").find("div.pagination").append(customPaginationHtml);



            $(".middle-pagination").html("");



            var divMiddlePagination = '<div class="middle-pagination" ></div>';
            table.closest("div.table-responsive").find("div.pagination").append(divMiddlePagination);


            var divMiddlePagination = '';

            var addition = 5;


            for (var i = (pageNumber+1); i < (pageNumber+addition); i++) {

              if (i > parseInt(ajaxResponse.totalPageNumber)) {
                continue;
              }

              if (i == (pageNumber+4)) {
                divMiddlePagination += '<a href="javascript:;" class="page-link page-link-last" value="'+i+'">'+i+'</a>';
              }else {
                if (i == pageNumber) {
                  divMiddlePagination += '<a href="javascript:;" class="page-link active" value="'+i+'">'+i+'</a>';
                }else {
                  divMiddlePagination += '<a href="javascript:;" class="page-link" value="'+i+'">'+i+'</a>';
                }
              }
            }
            table.closest("div.table-responsive").find("div.middle-pagination").html(divMiddlePagination);


            var customPaginationHtml = '<a href="javascript:;" class="page-seperator" value="...">...</a>';
            customPaginationHtml += '<a href="javascript:;" class="page-link" value="'+ajaxResponse.totalPageNumber+'">'+ajaxResponse.totalPageNumber+'</a>';
            table.closest("div.table-responsive").find("div.pagination").append(customPaginationHtml);

          }else {
            for (var i = 1; i < (ajaxResponse.totalPageNumber)+1; i++) {
              var customPaginationHtml = '<a href="#" class="page-link" value="'+i+'">'+i+'</a>';
              table.closest("div.table-responsive").find("div.pagination").append(customPaginationHtml);
            }
          }

          table.closest("div.table-responsive").find(".pagination a").removeClass("active");
          table.closest("div.table-responsive").find(".pagination a[value="+pageNumber+"]").addClass("active");
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
  /* loading data */


  /* deleting row */
  delete(table,model,id){

    var modelUrl = model.replace("_", "-");


    var json = {
      "model":model,
      "id":id
    }
    json = JSON.stringify(json);

    jQuery.ajax({
      type: "POST",
      url: "/"+modelUrl+"/delete-"+modelUrl+"/"+id,
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".loading").removeClass("d-none");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(ajaxResponse)
      {
        $(".loading").addClass("d-none");

        var ajaxResponse = $.parseJSON(ajaxResponse);
        if (ajaxResponse.response == true) {

          $.notify({
            // options
            icon: 'fa fa-danger fa-2x',
            message: "Silme işlemi başarılı!"
          },{
            // settings
            type: 'success'
          });
          table.find("tbody tr#"+id+"").fadeOut();
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
  /* deleting row */



  /* loading custom data */
  loadCustomTable(table) {

    var model = table.attr("model");
    var functionName = table.attr("function");
    var itemPerPage = table.closest("div.table-responsive").find(".txtCustomItemPerPage").find("option:selected").val();
    var pageNumber = parseInt(table.attr("page-number"));
    var filters = table.closest("div.table-responsive").find(".frmCustomTableSearch").serializeJSON();
    var modelUrl = model.replace("_", "-");
    var overrideFunctionName = table.attr("override-function");

    var json = {
      "model":model,
      "itemPerPage":itemPerPage,
      "pageNumber":pageNumber,
      "filters":filters
    }
    json = JSON.stringify(json);


    jQuery.ajax({
      type: "POST",
      url: "/"+modelUrl+"/"+functionName+"/",
      data: {post:json},
      cache: false,
      beforeSend: function() {
        $(".loading").removeClass("d-none");
      },
      error:function(err){
        alert(err.responseText);
      },
      success: function(ajaxResponse)
      {
        $(".loading").addClass("d-none");
        table.find("tbody").html("");

        var ajaxResponse = $.parseJSON(ajaxResponse);
        if (ajaxResponse.data) {
          window[overrideFunctionName](table,ajaxResponse.data,ajaxResponse.additionalData);

          ajaxResponse.totalPageNumber = Math.ceil(ajaxResponse.totalPageNumber);


          table.closest("div.table-responsive").find("div.custom-pagination").html("");
          if (ajaxResponse.totalPageNumber > 5) {
            var customPaginationHtml = '<a href="javascript:;" class="page-link page-link" value="1">1</a>';
            customPaginationHtml += '<a href="javascript:;" class="page-seperator" value="...">...</a>';
            table.closest("div.table-responsive").find("div.custom-pagination").append(customPaginationHtml);



            $(".middle-pagination").html("");

            //
            //
            // var divMiddlePagination = '<div class="middle-pagination" >';
            // for (var i = 2; i < 6; i++) {
            //   if (i == 5) {
            //     divMiddlePagination += '<a href="javascript:;" class="page-link page-link-last" value="'+i+'">'+i+'</a>';
            //   }else {
            //     divMiddlePagination += '<a href="javascript:;" class="page-link" value="'+i+'">'+i+'</a>';
            //   }
            // }
            // divMiddlePagination += '</div>';
            // table.closest("div.table-responsive").find("div.custom-pagination").append(divMiddlePagination);
            //

            var divMiddlePagination = '<div class="middle-pagination" ></div>';
            table.closest("div.table-responsive").find("div.custom-pagination").append(divMiddlePagination);


            var divMiddlePagination = '';

            var addition = 5;


            for (var i = (pageNumber+1); i < (pageNumber+addition); i++) {

              if (i > parseInt(ajaxResponse.totalPageNumber)) {
                continue;
              }

              if (i == (pageNumber+4)) {
                divMiddlePagination += '<a href="javascript:;" class="page-link page-link-last" value="'+i+'">'+i+'</a>';
              }else {
                if (i == pageNumber) {
                  divMiddlePagination += '<a href="javascript:;" class="page-link active" value="'+i+'">'+i+'</a>';
                }else {
                  divMiddlePagination += '<a href="javascript:;" class="page-link" value="'+i+'">'+i+'</a>';
                }
              }
            }
            table.closest("div.table-responsive").find("div.middle-pagination").html(divMiddlePagination);


            var customPaginationHtml = '<a href="javascript:;" class="page-seperator" value="...">...</a>';
            customPaginationHtml += '<a href="javascript:;" class="page-link" value="'+ajaxResponse.totalPageNumber+'">'+ajaxResponse.totalPageNumber+'</a>';
            table.closest("div.table-responsive").find("div.custom-pagination").append(customPaginationHtml);

          }else {
            for (var i = 1; i < (ajaxResponse.totalPageNumber)+1; i++) {
              var customPaginationHtml = '<a href="#" class="page-link" value="'+i+'">'+i+'</a>';
              table.closest("div.table-responsive").find("div.custom-pagination").append(customPaginationHtml);
            }
          }

          table.closest("div.table-responsive").find(".custom-pagination a").removeClass("active");
          table.closest("div.table-responsive").find(".custom-pagination a[value="+pageNumber+"]").addClass("active");
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
  /* loading custom data */

}
