jQuery(function($) {
    $('.delete').click(function(event) {
        if (!confirm('Are you sure you want to delete?')) {
            event.preventDefault();
        }
    });
});