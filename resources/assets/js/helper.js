var helper = {
    confirmDelete: function (el) {
        var action = $(el).data('action');
        var table = $(el).data('table');
        var tableDt = $('#' + table).DataTable();

        bootbox.confirm("Are you sure want to move this to trash?", function (answer) {
            if (answer) {

                $.ajax({
                    url: action,
                    method: 'DELETE',
                    data: {
                        _token: window.Lemon.csrfToken
                    },
                    success: function (response) {
                        if (response == '1' || response == 1) {
                            tableDt.ajax.reload(null, false);
                        }
                    },
                    error: function () {

                    }
                });
            }
        });
    }
}