$(function(){
    $('.tlt').textillate({

        in: {
            effect: 'flipInX'

        },
        out: {
            effect: 'flipOutY'

        },
        loop: true
    });
});


/* skill animations */

jQuery('.skillbar').each(function () {
    jQuery(this).find('.skillbar-bar').animate({
        width: jQuery(this).attr('data-percent')
    }, 2000);
});