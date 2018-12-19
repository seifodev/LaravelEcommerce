$(function () {
    $('.deleteAdmins').click(function () {


        let checkboxes = $('.check:checked').length;

        if(checkboxes < 1) {
            $('.modal').find('.no-records-msg').removeClass('hidden');
            $('.modal').find('.records-msg').addClass('hidden');
            $('.modal').find('.records-btn').addClass('hidden');
        } else
        {
            $('.modal').find('.records-msg').removeClass('hidden');
            $('.modal').find('.records-msg').find('span').text(checkboxes);
            $('.modal').find('.records-btn').removeClass('hidden');
            $('.modal').find('.no-records-msg').addClass('hidden');

            $('#confirmDelete').on('click', function () {
                $('#adminsForm').submit();
            });
        }

        $('#delete-modal').modal();

    });
});


function checkToggle(source) {
    let checkboxes = $('.check');
    if(source.checked === true)
    {
        checkboxes.each(function () {
            $(this).prop('checked', true);
        });
    } else
    {
        checkboxes.each(function () {
            $(this).prop('checked', false);
        });
    }
}