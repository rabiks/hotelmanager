// skrypt rezerwacja
$(document).ready(function() {
    $('.reserve-btn').click(function() {
        var roomId = $(this).data('room-id');
        $('#room-id').val(roomId);
        $('#reservation-popup').css('display', 'block');
    });

    $('.close').click(function() {
        $('#reservation-popup').css('display', 'none');
    });
});