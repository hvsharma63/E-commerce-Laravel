$(document).ready(function() {
    $("#btn-add").click(function() {
        $("#btn-save").val("add");
        $("#modalFormData").trigger("reset");
        $("#create").modal("show");
    });

    $("body").on("click", ".open-modal", function() {
        var category_id = $(this).val();
        $.get("categories/" + category_id, function(data) {
            $("#category_id").val(data.id);
            $("#name").val(data.name);
            $("#image").val(data.image);
            $("#btn-save").val("update");
            $("#create").modal("show");
        });
    });
});
