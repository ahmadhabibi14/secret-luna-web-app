$( document ).ready(function() {

		$('#qty-button').click(function()
		{
			var length = $(':radio[name="itemS"]:checked');
			var length2 = $(':radio[name="itemM"]:checked');
			if(length.length == 1 || length2.length == 1)
			{
				$('#value-radio').val($('#radio2').val());
				if(length.length == 1)
				{
					$('#value-radio').attr('name',length.attr('name'))
				}
				else if(length2.length == 1) {
					$('#value-radio').attr('name',length2.attr('name'))
				}		
				$('.modal').css('display','block');
			}
			else {
				alert("Choose item first!");
			}
		});
		
		$('.title').on("click",function()
		{
			$('#value-radio').val("");
			$('#input-qty').val(1);
			$('.modal').css('display','none');
		});
		var count = $(".tab button").length;	
		if(count == 1)
		{
			$('.tablinks').css('float','none');
		}
		$('.moon-list').hide();
		$(document).on('click','#moon',function(){		
			$('.star-list').hide();	
			$('input[name="itemS"]').prop('checked', false);	
			$('.moon-list').show();						
		});
		$(document).on('click','#star',function(){			
			$('.moon-list').hide();	
			$('input[name="itemM"]').prop('checked', false);		
			$('.star-list ').show();				
		});
	});