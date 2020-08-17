
$(function () {
    $("#tblEpisodes").on("click", "#btnDelete", function () {
        $("#deletedId").val($(this).data('id'))
    })
})