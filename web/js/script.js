$(document).ready(function () {

    $("a[href='#']").click(function (event) {
        event.preventDefault();
    });

    // Map Tile by tile
    $('.tile-by-tile a').click(function () {

        var form = $('.tile-by-tile form');
        var url = $(form).attr('action');
        var data = {
            id: $('#_map_id').val(),
            x: $(this).attr('data-x'),
            y: $(this).attr('data-y')
        };
        console.log( $(this).attr('data-top') );
        $.post(url, data, function (data) {
            $(".result").html(data);
        });

    });

});
