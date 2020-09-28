(function ($) {
	$.sanitize = function (input) {
		return input.replace(/<(|\/|[^>\/bi]|\/[^>bi]|[^\/>][^>]+|\/[^>][^>]+)>/g, '');
	};
})(jQuery);

$(document).ready(function () {
	// $('#sanitize').click(function() {
	// 	var $input = $('#input').val();
	// 	$('#output').text($.sanitize($input));
	// });
	$('#modalKonfirmasiHapusMenu').on('show.bs.modal', function (e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		$(this).find('#nama-menu-modal').html($.sanitize($(e.relatedTarget).data('name')));
	});
	$('#modalKonfirmasiHapusAksesMenu').on('show.bs.modal', function (e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		$(this).find('#nama-menu-modal').html($.sanitize($(e.relatedTarget).data('name')));
	});
	$('#modalKonfirmasiHapusGaleri').on('show.bs.modal', function (e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	$('#modalKonfirmasiHapusProduk').on('show.bs.modal', function (e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	$('.alert-message').alert().delay(3000).slideUp('slow');

	$('.navbar-collapse a').click(function () {
		$(".navbar-collapse").collapse('hide');
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#ubah-target').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$("#ubah-gambar").change(function () {
		readURL(this);
	});

	// Datepicker
	flatpickr('.flatpickr', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    onOpen: function() {
      if ($(".tgl-acara").hasClass('has-danger')) {
        $(".input-group-text").removeClass('border border-warning rounded-left border-right-0')
      }
    },
    onClose: function() {
      if ($(".tgl-acara").hasClass('has-danger')) {
        $(".input-group-text").addClass('border border-warning rounded-left border-right-0')
      }
    },
    onChange: function() {
      if ($(".tgl-acara").hasClass('has-danger')) {
        $(".tgl-acara").removeClass('has-danger')
        $(".flatpickr").removeClass('is-invalid')
        $(".ni-calendar-grid-58").removeClass('text-warning')
        $(".input-group-text").removeClass('border border-warning rounded-left border-right-0')
      }
    } 
  });
});