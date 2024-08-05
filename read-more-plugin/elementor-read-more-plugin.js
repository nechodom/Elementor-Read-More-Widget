jQuery(document).ready(function($) {
    console.log('Read More Plugin Initialized');
    $(document).on('click', '.read-more-button', function() {
        var $button = $(this);
        console.log('Button clicked');
        var $wrapper = $button.closest('.read-more-wrapper');
        console.log('Wrapper:', $wrapper);
        var $content = $wrapper.find('.read-more-content');
        console.log('Content:', $content);
        var $ellipsis = $wrapper.find('.read-more-ellipsis');
        console.log('Ellipsis:', $ellipsis);

        if ($content.length && $ellipsis.length) {
            $content.toggle();
            $ellipsis.toggle();
            $button.text($button.text() == 'Číst více' ? 'Skrýt' : 'Číst více');
        } else {
            console.log('Content or Ellipsis not found');
        }
    });
});
