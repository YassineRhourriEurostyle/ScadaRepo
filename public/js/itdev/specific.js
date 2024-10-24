$(function () {

    /*
     * Update project datas
     */
    $('input.project_dateprod, input.project_priority').on('change', function () {

        var t = $(this).attr('id').split('_');
        var field = t[0];
        var id = t[1];

        $.ajax({
            type: 'POST',
            url: "/project/update",
            data: {
                id: id,
                field: field,
                value: $(this).val()
            },
            async: false
        });

    });

});