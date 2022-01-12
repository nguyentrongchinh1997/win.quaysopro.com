if (window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}

$('.slot_upload input[type="file"]').change(function() {
    $('.slot_upload > form').submit();
});



$('body').keyup(function(e){
   if (e.keyCode == 13) {
       	spin();
   } else if (e.keyCode == 27) {
		download();
   } else if (e.keyCode == 8) {
		window.location.href = "/plt2";
   }
});

function download() {
	$.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'spin.php',
        data: {
            action: 'download',
        },
        success: function(res) {
        	console.log(res);
        	if (res.status) {
        		var a = document.createElement('a');
		        a.href = res.file; 
		        a.download = res.name;
		        document.body.appendChild(a);
		        a.click();
		        a.remove();
        	}
        },
    });
}

function spin() {
    // if (!$('body').hasClass('spining')) {
    //     $('body').addClass('spining');
    $('.winner_text').addClass('blur');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/spin',
            data: {
                action: 'spin',
            },
            success: function(res) {
            	if (res.status) {
					for (var stt = 0; stt < res.count; stt++) {
						$('.slotwrapper' + stt + ' ul').html('');
						$(res.list['stt' + stt]).each(function(i, value) {
							var chars = value.split('');
							$(chars).each(function(i, char) {
								$('.slotwrapper' + stt + ' ul').eq(i).append('<li>'+char+'</li>');
							});
						});
	
						$('.slotwrapper' + stt + ' ul').playSpin({
							time: 2000,
							stopSeq: 'leftToRight',
							endNum: [11,11,11,11,11,11,11],
							onFinish: function() {
								// $('body').removeClass('spining');
								//$('.winner_text').text(123);
								for (var stt = 0; stt < res.count; stt++) {
									$('.winner_text' + stt).text(res.win_name['stt' + stt]);
									$('.winner_text' + stt).removeClass('blur');
								}
							}
						});
					}
	            } else {
	            	alert(res.message);
	            	//$('body').removeClass('spining');
	            }

            },
        });
    // }
};	