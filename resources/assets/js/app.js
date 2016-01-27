var App = function () {
}

App.prototype.initHandlers = function () {
    $('#upload-form').on('submit', function (event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url : form.attr('action'),
            type: 'post',
            data: form.serialize()
        }).done( function () {

        }).error( function () {

        });

        return false;
    });

}
