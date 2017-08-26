var editAction = "";
var editFields = [
    'title',
    'author',
    'publicationType',
    'genre',
    'rating',
    'description',
    'worth',
    'language',
    'publisher',
    'edition',
    'yearOfPublication',
    'origin',
    'acquisitionDate',
    'originSource',
    'created',
    'modified'
];

$(document).ready(function ()
{
    $('#addButton').on('click', function () {
        // Voorkomt overschrijven bij per ongeluk op Escape drukken
        if (editAction !== "add")
        {
            editAction = "add";

            editFields.forEach(function(item, index) {
                $('#' + item).val('');
            });

            $('#publicationType').val('Boek');
            $('#language').val('Nederlands');

            $('input:radio[name=rating]').each(function () {
                $(this).prop('checked', false);
            });

            $('input:radio[name=origin]').each(function () {
                $(this).prop('checked', false);
            });

            $('#bookPopupTitle').html('Nieuw boek invoeren');

            $('#saveConfirm').off();
            $('#saveConfirm').on('click', function () {
                var formData = $('#editBookPopupForm').serialize();
                formData += '&action=addBook';

                $.post('ajax', formData).done(function (json)
                {
                    var data = JSON.parse(json);

                    editAction = "";
                    $('#editBookPopup').modal('hide');

                    var buttons = '<div class="btn-group"><button type="button" class="editButton btn btn-default btn-warning" data-book-id="' + data.id + '" data-toggle="modal" data-target="#editBookPopup"><span class="glyphicon glyphicon-pencil"></span></button>' +
                        '<button type="button" class="deleteButton btn btn-default btn-danger" data-book-id="' + data.id + '" data-toggle="modal" data-target="#deleteBookPopup"><span class="glyphicon glyphicon-trash"></span></button></div>';

                    $('#bookListBody').prepend(
                         '<tr id="bookRow-' + data.id + '"><td>' + $('#author').val() + '</td><td>' + $('#title').val() + '</td><td>' + $('#genre').val() + '</td><td>' + $('#yearOfPublication').val() + '</td><td>' + buttons + '</td></tr>'
                    );

                    addEditFunctions();
                    addDeleteFunctions();
                });
            });
        }
    });

    addEditFunctions();

    addDeleteFunctions();


    $.datepicker.setDefaults($.datepicker.regional["nl"]);

    $("#acquisitionDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: new Date(1946, 0, 1), // Min selectable date
        maxDate: new Date(), // Max selectable date
        yearRange: '-100:+0' // Years shown in the dropdown
    });

    var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    try{
        $confModal.on('hidden', function() {
            $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
        });
        $confModal.modal({ backdrop : false });
    }
    catch (error) {
        if(error.name != 'ReferenceError')
            throw error;
    }
});

/* Adds event listeners to the edit functions */
function addEditFunctions()
{
    $('.editButton').on('click', function() {
        editAction = "edit";
        var id = $(this).attr('data-book-id');

        $.post('ajax', {action: 'getBookData', bookId: id}).done(function (json)
        {
            var data = JSON.parse(json);

            editFields.forEach(function(item, index) {
                $('#' + item).val(data[item]);
            });

            $('input:radio[name=rating][value=' + data.rating + ']').each(function () {
                $(this).prop('checked', true);
            });

            $('input:radio[name=origin][value=' + data.origin + ']').each(function () {
                $(this).prop('checked', true);
            });
        });

        $('#bookPopupTitle').html('Boek bewerken');

        $('#saveConfirm').off();
        $('#saveConfirm').on('click', function () {
            var formData = $('#editBookPopupForm').serialize();
            formData += '&action=editBook&id=' + id;

            $.post('ajax', formData).done(function (json)
            {
                editAction = "";
                $('#editBookPopup').modal('hide');

                $('#bookRow-' + id + ' td:nth-child(1)').html($('#author').val());
                $('#bookRow-' + id + ' td:nth-child(2)').html($('#title').val());
                $('#bookRow-' + id + ' td:nth-child(3)').html($('#genre').val());
                $('#bookRow-' + id + ' td:nth-child(4)').html($('#yearOfPublication').val());
            });
        });
    });
}

/* Adds event listeners to the delete buttons */
function addDeleteFunctions()
{
    $('.deleteButton').on('click', function() {
        var id = $(this).attr('data-book-id');

        $('#deleteConfirm').off();
        $('#deleteConfirm').on('click', function() {
            $.post('ajax', {action: 'deleteBook', bookId: id}).done(function (json)
            {
                $('#deleteBookPopup').modal('hide');
                $('#bookRow-' + id).fadeOut('slow', function () {});
                id = null;
            });
        })
    });
}

