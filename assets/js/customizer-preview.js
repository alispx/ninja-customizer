
( function( $ ) {

	$.each( mieStyle, function( index ) {

		var dataType 		= mieStyle[index].type;
		var dataSlug		= mieStyle[index].slug;
		var dataProperty	= mieStyle[index].property;
		var dataProperty2	= mieStyle[index].property2;
		var dataSelector 	= mieStyle[index].selector;
		var dataChoices 	= mieStyle[index].choices;

		switch( dataType ) {

			case 'color' :
			case 'color_rgb' :
				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						$( dataSelector ).css( dataProperty, to ? to : '' );
					});
				});

				break;

			case 'text' :
			case 'textarea' :
			case 'email' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						$( dataSelector ).html( to );
					} );
				} );

				break;

			case 'checkbox' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						false === to ? $( dataSelector ).hide() : $( dataSelector ).show();
					} );
				} );

				break;

			case 'images' :
					
					wp.customize( dataSlug, function( value ) {
						value.bind( function( to ) {
							$( dataSelector ).css( dataProperty, 'url(' + "'" + to + "'" + ')' + dataProperty2 );
						} );
					} );
				
				break;

			case 'google_font' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						$( dataSelector ).css( dataProperty, to ? to : '' );
						// add Google Fonts lib call in <head>
						var font_url = '//fonts.googleapis.com/css?family=';
						var font_link = '<link type="text/css" media="all" href="' + font_url + to.replace( ' ', '+') + '" rel="stylesheet">';
						$( font_link ).appendTo( $( 'head' ) );
					});
				});
				
				break;

			default:
				
				break;
		}

		
	});
	
} )( jQuery );