/*
 * © 2012 by Noël Bossart – sagenja.ch
 */
;
(function($){
	$(document).ready(function(){
		var $mod = $('.tx-nbowishlist');
		
		if($mod.length < 1){
			return;
		}

		// Slider
		$('.slider', $mod).each(function(){
		
			var $t = $(this);
			var $input = $($t.data('target'));
			var $b = $($t.data('bar'));
			var $p = $b.parent();
			
			var p = $t.data('price'); // total price
			var pc = p/100; // percent
			var shares = $t.data('shares'); // total payed already
			var participationshare = ($t.data('participationshare') || 0); // exisiting share
			var step = $t.data('step'); // minimal steps
			var v =  (participationshare || step); // current position
			var max = $t.data('max'); // minimal steps
			console.log(v);
			var options = {
				min: step/pc, 
				max: max/pc,
				step: step/pc,
				value: v/pc,
				change: function(event, ui) {
					updateBar(ui.value);
				}
			};
			
			$t.slider(options);
			
			var updateBar = function(v){
				$input.val((v*pc).toFixed(2));
				var proz = v + (shares-participationshare)/pc;
				$b.width(proz + "%");
				$p.removeClass('progress-danger').removeClass('progress-warning').removeClass('progress-success');
				if(proz < 20){
					$p.addClass('progress-danger');
				} else if(proz < 70){
					$p.addClass('progress-warning');
				} 
				if(proz > 99){
					$p.addClass('progress-success');
				}
			}
			updateBar(v/pc);
		});
		
		$('.error input:eq(0)',$mod).focus();

		// Gallery
		$('.nivoSlider',$mod).nivoSlider();
		
	});
})(jQuery);
