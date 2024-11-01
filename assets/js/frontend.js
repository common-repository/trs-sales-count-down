jQuery(document).ready(function ($){
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $($this).find('.days').html();
        //console.log(finalDate);

        $this.countdown(finalDate, function(event) {
            $(this).find('.days').html(event.strftime('%D'));
            $(this).find('.hours').html(event.strftime('%H'));
            $(this).find('.minutes').html(event.strftime('%M'));
            $(this).find('.seconds').html(event.strftime('%S'));
        });
    });
});