$(document).ready(function () {
    if ($("#car").is(':checked')) {
        $('#photographer_section').css('display', 'none');
        $('#car_section').css('display', 'block');
    }
    if ($("#photographer").is(':checked')) {
        $('#car_section').css('display', 'none');
        $('#photographer_section').css('display', 'block');
    }
    $("#car").click(function () {
        if ($(this).is(':checked')) {
            $('#photographer_section').css('display', 'none');
            $('#car_section').css('display', 'block');
        }
    });
    $("#photographer").click(function () {
        if ($(this).is(':checked')) {
            $('#car_section').css('display', 'none');
            $('#photographer_section').css('display', 'block');
        }
    });
});
