ROOT = '';
$('document').ready(function(){

    // initialize all tooltips
    $(function () {
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    })
  });
// initialize all popovers
$(function () {
    $('[data-toggle="popover"]').popover({
        html: true
    })
  });

  $('select').select2(); //use the select2 for all selects

})
