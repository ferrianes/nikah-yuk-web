(function($) {
	$.sanitize = function(input) {
        return input.replace(/<(|\/|[^>\/bi]|\/[^>bi]|[^\/>][^>]+|\/[^>][^>]+)>/g, '');
	};
})(jQuery);

$(function() {
	// $('#sanitize').click(function() {
	// 	var $input = $('#input').val();
	// 	$('#output').text($.sanitize($input));
    // });
    $('#modalKonfirmasiHapusMenu').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $(this).find('#nama-menu-modal').html($.sanitize($(e.relatedTarget).data('name')));
    });
    $('#modalKonfirmasiHapusAksesMenu').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $(this).find('#nama-menu-modal').html($.sanitize($(e.relatedTarget).data('name')));
    });
});

