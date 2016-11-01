var ajaxProcessing = false;
$('.subscribe').on('click', function() {
	$.post(
		'/site/subscribe',
		{
			Subscribers: {email: $('#subscribe-email').val()},
			_csrf : $('meta[name="csrf-token"]').attr("content")
		},
		function (response) {
			if (response.success != null) {
				alert(response.success);
			}
			if (response.error != null) {
				alert(response.error);
			}
		},
		'json'		
	);
});


$(document).on("beforeSubmit", "#agency-registration-form", function () {
    // send data to actionSave by ajax request.

    if (ajaxProcessing === true)
        return;

    var form = $(this);
    ajaxProcessing = true;
    $.post(
        form.attr('action'),
        form.serialize(),
        function (response) {
            ajaxProcessing = false;
            form.hide();
            $('.registration-success').removeClass('hidden');
        },
        'json'
    ).fail(function () {
            ajaxProcessing = false;
            alert('Error!');
     });

    console.log('save ajax');
    return false; // Cancel form submitting.
});

$('.request-form').on('submit',
    function (event) {
        event.preventDefault();
        if (ajaxProcessing === true)
            return;

        var form = $(this);
        ajaxProcessing = true;
        $.post(
            form.attr('action'),
            form.serialize(),
            function (response) {
                ajaxProcessing = false;
                $('.error').empty();
                if (response.success == null) {
                    $.each(response, function(i, item) {
                        $('#' + i).closest("div").find('.error').text(item);
                    });
                } else {
                    $('.request').html(response.success);
                }
            },
            'json'
        ).fail(function() {
                ajaxProcessing = false;
                alert('Error!');
            });
    }
);
$('.change-photo-search').on('click', function() {
    var mainPhoto = $(this).closest(".col-md-3").find('.main-photo');
    var thisPhoto = $(this).attr('src');

    $(this).attr('src', mainPhoto.attr('src'));
    mainPhoto.attr('src', thisPhoto);
});

$('[name="from_m"], [name="from_d"]').on('change',
    function() {

        var form = $(this).closest('form'),
            dateFrom = form.find('[name="from_m"]').val() + '.' + form.find('[name="from_d"]').val() + '.' + form.find('[name="from_y"]').val(),
            dateTo = form.find('[name="to_m"]').val() + '.' + form.find('[name="to_d"]').val() + '.' + form.find('[name="to_y"]').val();

        if (isNaN(Date.parse(dateTo)) && !isNaN(Date.parse(dateFrom))) {
            dateTo = parseInt(Date.parse(dateFrom)) + 7 * 24 * 60 * 60 * 1000;
            var date = new Date();
            date.setTime(dateTo);

            var month = (parseInt(date.getMonth() + 1) < 10) ? '0' + parseInt(date.getMonth() + 1) : parseInt(date.getMonth() + 1);
            form.find('[name="to_d"]').val(date.getDate());
            form.find('[name="to_m"]').val(month);
            form.find('[name="to_y"]').val(date.getFullYear());
        }

    }
);

$('[name="to_m"], [name="to_d"]').on('change',
    function() {
        var form = $(this).closest('form'),
            dateFrom = form.find('[name="from_m"]').val() + '.' + form.find('[name="from_d"]').val() + '.' + form.find('[name="from_y"]').val(),
            dateTo = form.find('[name="to_m"]').val() + '.' + form.find('[name="to_d"]').val() + '.' + form.find('[name="to_y"]').val();

        if (isNaN(Date.parse(dateFrom)) && !isNaN(Date.parse(dateTo))) {
            dateFrom = parseInt(Date.parse(dateTo)) - 7 * 24 * 60 * 60 * 1000;
            var date = new Date();
            date.setTime(dateFrom);

            var month = (parseInt(date.getMonth() + 1) < 10) ? '0' + parseInt(date.getMonth() + 1) : parseInt(date.getMonth() + 1);
            form.find('[name="from_d"]').val(date.getDate());
            form.find('[name="from_m"]').val(month);
            form.find('[name="from_y"]').val(date.getFullYear());
        }
    }
);

$('.play-video').on('click',
function () {
    var element = $(this);

    element.closest('.modal-body').find('img').replaceWith('<iframe src="'+element.data('video-url')+'" width="100%" height="512" frameborder="0"></iframe>')
    element.closest('.modal-body').find('a').remove();
});
