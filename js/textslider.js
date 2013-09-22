$(document).ready( function() {
		var textArray = [
			'Yesterday is history. Tomorrow is a mystery. Today is a gift. That\'s why we call it present.',
			'The best way to get a man to do something is to suggest they are too old for it.',
			'A successful man is one who makes more money than his wife can spend. A successful woman is one who can find such a man.',
			'To be happy with a man you must understand him a lot and love him a little. To be happy with a woman you must love her a lot and not try to understand her at all.',
			'My wife suggested a book for me to read to enhance our relationship. It\'s titled, "Women are from Venus, Men are Wrong."',
			'You can tell more about a person by what he says about others than you can by what others say about him.',
			'The quickest way to double your money is to fold it in half and put it back in your pocket.',
			'An optimist is someone who falls off the Empire State Building, and after 50 floors says, "So far so good!"',
			'If you wish to live wisely, ignore sayings, including this one.',
			'A consultant is someone who takes a subject you understand and makes it sound confusing.',
			'You have the right to remain silent. Anything you say will be misquoted, then used against you.'
		];
		$('#text-content').loadText( textArray, 10000 ); // ( array, interval )
	});
	// custom jquery plugin loadText()
	$.fn.loadText = function( textArray, interval ) {
		return this.each( function() {
			var obj = $(this);
			obj.fadeOut( 'slow', function() {
				obj.empty().html( random_array( textArray ) );
				obj.fadeIn( 'slow' );
			});
			timeOut = setTimeout( function(){ obj.loadText( textArray, interval )}, interval );
			// reload random text (if not animated) -- entirely optional, can be removed, along with the reload link above (<a id="text-reload" href="javascript:;"><em>randomize</em></a>)
			$("#text-reload").click( function(){
				if( !obj.is(':animated') ) { clearTimeout( timeOut ); obj.loadText( textArray, interval );} // animation check prevents "too much recursion" error in jQuery
			});
		});
	}
	//public function
	function random_array( aArray ) {
		var rand = Math.floor( Math.random() * aArray.length + aArray.length );
		var randArray = aArray[ rand - aArray.length ];
		return randArray;
	}