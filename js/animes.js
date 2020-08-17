
$(function () {
    $("#tblAnimes").on("click", "#btnEdit", function () {
        var tableData = $(this).closest('tr')
            .find('td')
            .map(function () {
                return $(this).text();
            });
        $("#animesId").val($(this).data('id'));
        $('#txtName1').val(tableData[1]);
        $('#txtName2').val(tableData[2]);
        $('#txtName3').val(tableData[3]);
        $('#txtSeason').val(tableData[5]);
        $('#txtGenre').val(tableData[7]);
        $('#txtDescription').val(tableData[10]);
        $("#animesForm").attr('action', 'animes_update.php');
        $("#btnSave").val('Update');
    })

    $("#tblAnimes").on("click", "#btnDelete", function () {
        $("#deletedId").val($(this).data('id'))
    })
})