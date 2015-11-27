function simple_tooltip(target_items, name){
	$(target_items).each(function(i){
		//$("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
		var my_tooltip = $("#"+name+i);
		
		var distance = 10;
		var time = 100;
		var hideDelay = 250;
		
		var hideDelayTimer = null;
		
		var beingShown = false;
		var shown = false;
		var ontip = false;
		
		//if($(this).attr("title") != "" && $(this).attr("title") != "undefined" )
		{
			//$(this).removeAttr("title");
			$(this).mouseover(function(kmouse){
				if (hideDelayTimer) clearTimeout(hideDelayTimer);
				if (beingShown || shown) {
					return;
				}else{
					beingShown = true;
					
					var border_top = $(window).scrollTop();
					var border_right = $(window).width();
					var left_pos;
					var top_pos;
					var offset = 10;
					if(border_right - (offset *2) >= my_tooltip.width() + kmouse.pageX)
					{
						left_pos = kmouse.pageX+offset;
					}
					else
					{
						left_pos = border_right-my_tooltip.width()-offset;
					}
					if(border_top + (offset *2)>= kmouse.pageY - my_tooltip.height())
					{
						top_pos = border_top +offset;
					}
					else
					{
						top_pos = kmouse.pageY-my_tooltip.height()-offset;
					}
					
					my_tooltip.css({
						left:left_pos,
						top:top_pos,
					}).animate({
						top: '-=' + distance + 'px',
						opacity: 0.8
					}, time, 'swing', function() {
						shown = true;
						beingShown = false;
					});
				}
			}).mouseout(function(){
				if (hideDelayTimer) clearTimeout(hideDelayTimer);
				if (!ontip){
					hideDelayTimer = setTimeout(function () {
						hideDelayTimer = null;
						my_tooltip.animate({
							top: '-=' + distance + 'px',
							opacity: 0
						}, time, 'swing', function () {
							shown = false;
							my_tooltip.css({left:"-9999px"});
						});
					}, hideDelay);
				}
			});
			
			my_tooltip.mouseover(function(kmouse){
				if (hideDelayTimer) clearTimeout(hideDelayTimer);
				ontip = true;
			}).mouseout(function(){
				if (hideDelayTimer) clearTimeout(hideDelayTimer);
				ontip = false;
				hideDelayTimer = setTimeout(function () {
					hideDelayTimer = null;
					my_tooltip.animate({
						top: '-=' + 10 + 'px',
						opacity: 0
					}, time, 'swing', function () {
						shown = false;
						my_tooltip.css({left:"-9999px"});
					});
				}, hideDelay);
			});
		}
	});
}

$(document).ready(function(){
	simple_tooltip(".box a","tooltip");
});
