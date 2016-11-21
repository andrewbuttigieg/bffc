jQuery(document).ready(function($) {
	if($('#section_post_special_offer').is(':disabled')) {
		var checkbox = $('#section_post_special_offer');
		
		var table = $(checkbox).parents('table:first');
		var tot_cnt = table.find('tr').length;
		var temp_cnt = $(checkbox).parents('tr:first').index() + 1;
		
		for(i=temp_cnt;i<tot_cnt;i++) {
			var temp_row = table.find('tr:eq(' + i + ')');
			temp_row.remove();
		}
	}
	
	$('.add_item').live('click', function() {
		var cnt = $(this).data('cnt');

		if($('input[name=the_league_' + cnt + ']').val() == '' || $('input[name=the_team_' + cnt + ']').val() == '') {
			alert('To add this event, you will need to assign a league and text');
		} else {			
			var temp_cnt = cnt + 1;
			clone = $(this).parents('tr:first').clone();
			
			clone.find('th').text('');
			
			clone.find('input[name=the_team_' + cnt + ']').val('');
			clone.find('input[name=the_team_' + cnt + ']').attr('name', 'the_team_' + temp_cnt);

			clone.find('input[name=the_league_' + cnt + ']').val('');
			clone.find('input[name=the_league_' + cnt + ']').attr('name', 'the_league_' + temp_cnt);

			clone.find('input[name=the_date_' + cnt + ']').val('');
			clone.find('input[name=the_date_' + cnt + ']').attr('name', 'the_date_' + temp_cnt);

			clone.find('input[name=the_time_' + cnt + ']').val('');
			clone.find('input[name=the_time_' + cnt + ']').attr('name', 'the_time_' + temp_cnt);

			clone.find('input[name=the_stadium_' + cnt + ']').val('');
			clone.find('input[name=the_stadium_' + cnt + ']').attr('name', 'the_stadium_' + temp_cnt);
			
			clone.find('.add_item:first').data('cnt', temp_cnt);
			
			var table = $(this).parents('table:first');
			table.append(clone[0]);
			
			$(this).text('Remove').removeClass('add_item').addClass('remove_item');
			$('#special_offers_cnt').val(temp_cnt);
		}
	});
	
	$('.remove_item').live('click', function() {
		var confirm_remove = confirm("Are you sure you want to remove this event?");
		if(confirm_remove) {
			var row_cnt = $(this).data('cnt');
			
			var table = $(this).parents('table:first');
			var tot_cnt = table.find('tr').length;
			var temp_cnt = $(this).parents('tr:first').index() + 1;
			
			for(i=temp_cnt;i<tot_cnt;i++) {
				var temp_row = table.find('tr:eq(' + i + ')');
				if(row_cnt == 0) {
					temp_row.find('th:first').text('Select Special Offer');
				}

				temp_row.find('input[name=the_text_' + (row_cnt+1) + ']').attr('name', 'the_text_' + row_cnt);
				temp_row.find('input[name=the_league_' + (row_cnt+1) + ']').attr('name', 'the_league_' + row_cnt);
				temp_row.find('.section_link:first').data('cnt', (row_cnt));
				
				row_cnt++;
			}
			
			$(this).parents('tr:first').remove();
			$('#special_offers_cnt').val(table.find('.remove_item').length);
		}
	});
});