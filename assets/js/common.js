$(document).ready(function () {

  changeSelect();
})
function changeSelect() {
  /* init select values */
  $("select").each(function () {
    var val = $(this).attr("data-value");
    $(this).find("option[value="+val+"]").prop("selected",true);
  })
  /* init select values */
}
