$(document).ready(function(){
  if ($.cookie("modalFirst")) {
    return;
  } else {
  $.cookie("modalFirst", '1', {expires:14});
  }
});

if ($.cookie("modalFirst")){
  $("#youtube .auto").remove().attr("src","");;
  $("#youtube").addClass("cookie");
} else {
}