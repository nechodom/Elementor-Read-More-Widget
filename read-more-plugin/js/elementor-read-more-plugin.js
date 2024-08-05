jQuery(document).ready(function($) {
    console.log('Read More Plugin JavaScript Initialized'); // Kontrola, zda je JS soubor načten
    $(document).on('click', '.read-more-button', function() {
        var $button = $(this);
        console.log('Button clicked'); // Kontrola, zda je kliknutí zaregistrováno
        var $wrapper = $button.closest('.read-more-wrapper');
        console.log('Wrapper:', $wrapper); // Kontrola, zda je wrapper nalezen
        var $content = $wrapper.find('.read-more-content');
        console.log('Content:', $content); // Kontrola, zda je obsah nalezen
        var $ellipsis = $wrapper.find('.read-more-ellipsis');
        console.log('Ellipsis:', $ellipsis); // Kontrola, zda je ellipsis nalezen

        var showText = $button.data('show-text');
        var hideText = $button.data('hide-text');

        console.log('showText:', showText); // Kontrola, zda je správný showText
        console.log('hideText:', hideText); // Kontrola, zda je správný hideText

        if ($content.length && $ellipsis.length) {
            $content.toggle();
            $ellipsis.toggle();
            $button.text($content.is(':visible') ? hideText : showText);
        } else {
            console.log('Content or Ellipsis not found');
        }
    });
});
