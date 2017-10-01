jQuery(document).ready(function($) {
	if ($('#refreshTelegram').length) {
		console.log('#refreshTelegram found');
		$('#refreshTelegram').click(function(){
			api_key = $('body').find('#telKey').val();
			if(api_key) {
				$.ajax({
				  url: 'https://api.telegram.org/bot'+api_key+'/getUpdates',
				  success: function(data){
					$('.telegram-field').html(JSON.stringify(data));
					console.log(data);
				  }
				});
			} else {
				alert('Не введен ключ для проверки');
			}
		});
		
	}
});