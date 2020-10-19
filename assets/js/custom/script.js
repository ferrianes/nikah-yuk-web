(function ($) {
	$.sanitize = function (input) {
		return input.replace(/<(|\/|[^>\/bi]|\/[^>bi]|[^\/>][^>]+|\/[^>][^>]+)>/g, '');
	};
})(jQuery);

$(document).ready(function () {
	// $('#sanitize').click(function() {
	// 	let $input = $('#input').val();
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
	$('#modalKonfirmasiHapusSubmenu').on('show.bs.modal', function (e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	$('.alert-message').alert().delay(3000).slideUp('slow');

	$('.navbar-collapse a').click(function () {
		$(".navbar-collapse").collapse('hide');
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			let reader = new FileReader();

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
		altFormat: "l, j F Y",
		dateFormat: "Y-m-d",
		minDate: "today",
		"locale": "id",
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

	let n = $('.input-number');
	let inputNum = [];
	n.each(function() {
		inputNum.push({
			status: true,
			oldVal: $(this).val()
		})
	})

	$('.btn-number').click(function(e){
		e.preventDefault();
		
		fieldName = $(this).attr('data-field');
		type      = $(this).attr('data-type');
		harga	  = $(this).attr('data-harga');
		harga	  = parseInt(harga);
		let input = $("input[name='"+fieldName+"']");
		let currentVal = parseInt(input.val());
		let currentValHarga = parseInt($('#harga').attr('data-value'));

		// Create our number formatter.
		let formatter = new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR',
		
			// These options are needed to round to whole numbers if that's what you want.
			minimumFractionDigits: 0,
			maximumFractionDigits: 0,
		});

		if (!isNaN(currentVal)) {
			if(type == 'minus') {
				
				if(currentVal > input.attr('min')) {
					input.val(currentVal - 1).change();
					newVal = currentVal - 1;
					$('#harga').val(formatter.format(currentValHarga - harga));
					$('#harga').attr('data-value', currentValHarga - harga);
					$('#ht').val(currentValHarga - harga);
				} 
				if(parseInt(input.val()) == input.attr('min')) {
					$(this).attr('disabled', true);
				}
	
			} else if(type == 'plus') {
	
				if(currentVal < input.attr('max')) {
					input.val(currentVal + 1).change();
					newVal = currentVal + 1;
					$('#harga').val(formatter.format(currentValHarga + harga));
					$('#harga').attr('data-value', currentValHarga + harga);
					$('#ht').val(currentValHarga + harga);
				}
				if(parseInt(input.val()) == input.attr('max')) {
					$(this).attr('disabled', true);
				}
	
			}
		} else {
			input.val(0);
		}
	});
	$('.input-number').focusin(function(){
		$(this).data('oldValue', $(this).val());
	});
	
	$('.input-number').change(function() {

		minValue =  parseInt($(this).attr('min'));
		maxValue =  parseInt($(this).attr('max'));
		valueCurrent = parseInt($(this).val());
		key = parseInt($(this).attr('data-key'));
		
		name = $(this).attr('name');
		if(valueCurrent >= minValue) {
			$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
			alert('Sorry, the minimum value was reached');
			$(this).val($(this).data('oldValue'));
		}
		if(valueCurrent <= maxValue) {
			$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
			alert('Sorry, the maximum value was reached');
			$(this).val($(this).data('oldValue'));
		}

		if (valueCurrent != inputNum[key].oldVal) {
			inputNum[key].status = false;
		} else {
			inputNum[key].status = true;
		}

		function statusExists(status) {
			return inputNum.some(function(el) {
				return el.status === status;
			}); 
		}

		if (statusExists(false)) {
			$('#button-booking').html('<div class="col-lg-3"><button class="btn btn-primary" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button></div>');
		} else {
			$('#button-booking').html('<div class="col-lg-4"><a href="#" type="submit" class="btn btn-success"><i class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp(ANDROID)</a></div><div class="col-lg-4"><a href="#" type="submit" class="btn btn-success"><i class="fab fa-fw fa-whatsapp mr-2"></i>Minta Persetujuan Via Whatsapp (PC)</a></div>');
		}

	});
	
	$(".input-number").keydown(function (e) {
		// Allow: backspace, delete, tab, escape, enter and .
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
			 // Allow: Ctrl+A
			(e.keyCode == 65 && e.ctrlKey === true) || 
			 // Allow: home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {
				 // let it happen, don't do anything
				return;
		}
		// Ensure that it is a number and stop the keypress
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});

});