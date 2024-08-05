jQuery(document).ready(function($) {
    $(document).on('click', '.read-more-button', function() {
        var $button = $(this);
        var $wrapper = $button.closest('.read-more-wrapper');
        var $content = $wrapper.find('.read-more-content');
        var $ellipsis = $wrapper.find('.read-more-ellipsis');
        
        var showText = $button.data('show-text');
        var hideText = $button.data('hide-text');

        if ($content.length && $ellipsis.length) {
            $content.toggle();
            $ellipsis.toggle();
            $button.text($content.is(':visible') ? hideText : showText);
        }
    });
});
