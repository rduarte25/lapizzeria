let map;
function initMap() {
    var latLng = {
        lat: parseFloat( opciones.latitud ),
        lng: parseFloat( opciones.longitud )
    } 
    map = new google.maps.Map(document.getElementById("map"), {
        center: latLng,
        zoom: parseInt( opciones.zoom )
    });

    var marker = new google.maps.Marker({
        position:latLng,
        map: map,
        title: 'La Pizzeria',
    });

}

//alert('funciona');
//$ = JQuery.noConflict(true);
$( document ).ready( function() {
    //alert( 'Documento Listo' );
    //Ocultar y Mostrar menu.
    $( '.mobile-menu a' ).on( 'click', function() {
        //alert( "Haz hecho click!!" );
        $( 'nav.menu-sitio' ).toggle( 'slow' );
    } );

    var breakpoint = 768;

    $( window ).resize( function() {
        if ( document.width <= breakpoint ) {
            $( 'nav.menu-sitio' ).show();
        } else {
            $( 'nav.menu-sitio' ).hide();
        }
    } );

    

    ajustarCajas();

    //Ajustar mapa
    var mapa = $('#map');
    if( mapa.length > 0 ){
        if( $(document).width() >= breakpoint ) {
            ajustarMapa(0);
        } else {
            ajustarMapa(300);
        }
        
    }

    $(window).resize(function() {
        if( $(document).width() >= breakpoint ) {
            ajustarMapa(0);
        } else {
            ajustarMapa(300);
        }
    });

    //Fluidbox
    $( '.gallery a' ).each( function() {
        $( this ).attr( { 'data-fluidbox' : ''} );
    } );

    if ( $( '[data-fluidbox]' ).length > 0 ){
        $( '[data-fluidbox]' ).fluidbox();
    }

} );

function ajustarCajas() {
    var imagenes = $( '.imagen-caja' );
    if ( imagenes.length > 0 ) {
        var altura = imagenes[0].heigth;
        var cajas = $( 'div.contenido-caja' );
        $( cajas ).each( function( i, elemento ) {
            $( elemento ).css( { 'heigth' : altura + 'px' } );
        } );
    }
}

function ajustarMapa( altura ) { 
    if( altura == 0) {
        var ubicacionSection = $( '.ubicacion-reservacion' );
        var ubicacionAltura = ubicacionSection.height();
        $('#map').css({'height' : ubicacionAltura + 100 + 'px'});
    } else {
        $('#map').css({'height' : altura + 'px'});
    }
   
}
