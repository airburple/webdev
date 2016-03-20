// https://www.youtube.com/watch?v=GrycH6F-ksY
//https://www.youtube.com/watch?v=v8HoVdenZFM

$('form.ajax').on('click', function(){

	var that = $(this),
		url = that.attr('action'),
		type = that.attr('method'),
		data = {};

		that.find('[name]').each(function(index, value){
			var that = $(this),
				name = that.attr('name'),
				value = that.val();

				data[name] = value;
 
		})

	$.ajax({
		url: url,
		type: type,
		data: data,
		success: function(response) {
			console.log(response);

			var jContent = $( "#content" ); // put data here
	    	jContent.html( response );



		}

	});

	return false;

})



