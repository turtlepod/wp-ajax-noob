jQuery(document).ready(function($) {

	$.ajax({
		type: "POST",                 // use $_POST request to submit data
		url: john_cena_ajax_url,      // URL to "wp-admin/admin-ajax.php"
		data: {
			action     : 'john_cena', // wp_ajax_*, wp_ajax_nopriv_*
			first_name : 'John',      // PHP: $_POST['first_name']
			last_name  : 'Cena',      // PHP: $_POST['last_name']
		},
		success:function( data ) {
			$( '#john-cena' ).html( data );
		},
		error: function(){
			console.log(errorThrown); // error
		}
	});

});