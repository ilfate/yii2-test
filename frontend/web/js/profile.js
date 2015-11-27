/**
 * Created by ilfate on 27.11.15.
 */


$.fn.editUserField = function()
{
    var type = Profile.getTypeForIcon(this);
    var dataContainer =  $('span.user-data.' + type);

    var currentData = dataContainer.html();
    var input = $('<input type="text">')
        .addClass('user-data-input')
        .addClass(type)
        .val(currentData)
    dataContainer.before(input);
    dataContainer.hide();
    var parent = this.parent('.edit-container');
    parent.find('.save-icon').show();
    parent.find('.remove-icon').show();
    this.hide();
    input.focus();
};

$.fn.cancelEditUserField = function()
{
    var type = Profile.getTypeForIcon(this);
    $('span.user-data.' + type).show();
    var parent = this.parent('.edit-container');
    parent.find('input').remove();
    parent.find('.save-icon').hide();
    parent.find('.edit-icon').show();
    this.hide();
};


$.fn.saveFieldChange = function()
{
    var type = Profile.getTypeForIcon(this);
    var value = $('.user-data-input.' + type).val();
    $.ajax({
        method: "POST",
        url: '/profile/edit',
        data: { type: type, value: value }
    })
        .done(function(data) {
            if (data.code == 200) {
                Profile.appendChangesFromAjax(type);
            } else {
                Profile.showAlert(data.error, 'danger');
            }
        })
        .fail(function() {
            Profile.showAlert('Error happened during saving', 'danger');
        }).always(function() {
            Profile.cancelEdit(type);
        });
};

Profile = function() {

    this.getTypeForIcon = function (icon) {
        var parent = icon.parent('.edit-container');
        return parent.data('edit');
    };
    this.appendChangesFromAjax = function (type) {
        var span = $('.user-data.' + type);
        var parent = span.parent('.edit-container');
        span.html(parent.find('input').val());
        this.showAlert(type + ' saved')
    };
    this.cancelEdit = function (type) {
        var span = $('.user-data.' + type);
        var parent = span.parent('.edit-container');
        parent.find('.remove-icon').cancelEditUserField();
    };
    this.showAlert = function (message, type) {
        if (!type) {
            type = 'success';
        }
        var alertZone = $('.alert-zone');
        alertZone.hide().html('');
        alertZone.prepend('<div class="alert alert-' + type + '" role="alert">' + message + '</div>');
        alertZone.fadeIn(400);
    }
};

Profile = new Profile();

$(document).ready(function(){
    $('.edit-icon').on('click', function() {
        $(this).editUserField();
    });
    $('.remove-icon').on('click', function() {
        $(this).cancelEditUserField();
    });
    $('.save-icon').on('click', function() {
        $(this).saveFieldChange();
    })
});