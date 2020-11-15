$(document).ready(function () {

  $(".btnCollapse").on("click",function () {
    var target = $(this).attr("data-target");
    var trimmed = target.substring(1);
    $("#"+trimmed).find("form").submit();
  })

})
