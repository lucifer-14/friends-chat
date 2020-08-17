$(function () {
  $('.select2').select2({
    theme: 'bootstrap4'
  })
  bsCustomFileInput.init();

  var today = new Date();
  var dd = today.getDate() + 2;
  var mm = today.getMonth() + 1;
  var yyyy = today.getFullYear();

   $('.date-picker').datepicker({
    uiLibrary: 'bootstrap4',
    icons: {
      rightIcon: '<i class="fa fa-calendar"></i>'
    },
    format: 'yyyy-mm-dd',
    minDate: yyyy + '-' + mm + '-' + dd,
  });
  $('.time-picker').mask('00:00');
  $('.money').mask("##000", { reverse: true });

  $(".dt-table").dataTable({
    "columnDefs": [{
        "targets": 'no-sort',
        "orderable": false,
    }]
});
})
