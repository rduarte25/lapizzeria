//$ = JQuery.noConflict(true);
$(document).ready( function(){
	//Obtener la URL de adminajax.php
	//console.log( url_eliminar.ajaxurl );
	$( '.borrar_registro' ).on( 'click', function(e){
		e.preventDefault();

		var id = $( this ).attr( 'data-reservaciones' );
		//console.log( id );
		Swal.fire({
		  title: 'Estas seguri?',
		  text: "No se puede revertir!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Sí, eliminar!',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.value) {
			$.ajax( {
				type: 'post',
				data: {
					'action' : 'lapizzeria_eliminar',
					'id': id,
					'tipo': 'eliminar'
				},
				url: url_eliminar.ajaxurl,
				success: function( data ) {
					var resultado = JSON.parse( data );
					//console.log( resultado );
					if ( resultado.respuesta == 1 ) {
						$( "[data-reservaciones='"+ resultado.id +"']" ).parent().parent().remove();
						
						Swal.fire(
						  	'Eliminado!',
						  	'El mesaje se ha eliminado!',
						  	'success'
						)
					}
				}
			} );
		  }
		});
	} )
} );