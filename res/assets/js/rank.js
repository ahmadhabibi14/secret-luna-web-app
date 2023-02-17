$( document ).ready(function() {		
	$('.ranking-table-guild').hide();
	$(document).on('click','#guild-switch',function(){
		if($('.ranking-table-guild').is(':visible'))
		{
			$('.ranking-table-player').show();
			var switchname = $('#guild-switch').text();

			switchname = switchname.replace("Guild Rank","Player Rank");
			$('#guild-switch').text(switchname);
			$('#guild-switch').prepend('<i class="fas fa-eye">');
			$('.ranking-table-guild').hide();
		}
		else {				
			$('.ranking-table-player').hide();
			var switchname = $('#guild-switch').text();
			switchname = switchname.replace("Player Rank","Guild Rank");
			$('#guild-switch').text(switchname);
			$('#guild-switch').prepend('<i class="fas fa-eye">');
			$('.ranking-table-guild').show();			
		}
	});

	$('.guild').hide();
	$(document).on('click','.switch',function(){
		if($('.player').is(':visible'))
		{
			$('.player').hide();
			$('.switch').text("( Switch to Players )");
			$('.guild').show();
		}
		else {
			$('.guild').hide();
			$('.player').show();
			$('.switch').text("( Switch to Guilds )");					
		}
	});

});