<?php

function lapizzeria_eliminar() {
    //echo "functiona!";
    if ( isset( $_POST['tipo'] ) ) {
        if( $_POST['tipo'] == 'eliminar' ) {
            //echo "Sí se envió";
            global $wpdb;
            $tabla = $wpdb->prefix . 'reservaciones';
            $id_registro = $_POST['id'];
            $resultado = $wpdb->delete( $tabla, array( 'id' => $id_registro), array( '%d' ) );
            
            if ( $resultado == 1 ) {
                $respuesta = array( 
                    'respuesta' => 1,
                    'id'        => $id_registro,
                );
            } else {
                $respuesta = array( 
                    'respuesta' => 'error',
                );
            }

        }
    }
    //die(json_encode( $id_registro ));
    die( json_encode( $respuesta ) );
    //die(json_encode( $_POST ));
}

add_action( 'wp_ajax_lapizzeria_eliminar', 'lapizzeria_eliminar' );

function lapizzeria_guardar() {
    if ( isset( $_POST['enviar'] )  && $_POST['oculto'] == "1" ) {
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            $captcha = $_POST['g-recaptcha-response'];

            $campos = array(
                'secret'    => '6LdHd8UZAAAAAKNFocL80tHLpfrgsySpAhVEeSt1',
                'response'  => $captcha,
                'remoteip'  => $_SERVER['REMOTE_ADDR'],
            );

            //Iniciar sesión en CURL
            //CURL es utilizado para acceder a servidores remotos.
            $ch = curl_init( 'https://www.google.com/recaptcha/api/siteverify' );

            //configura opciones de curl
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            curl_setopt( $ch, CURLOPT_TIMEOUT, 15 );

            //genera una cadena codificada para la url
            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $campos ) );

            $respuesta = json_decode( curl_exec( $ch ) );

            if ( $respuesta->success ) {
                global $wpdb;                

                $tabla = $wpdb->prefix . 'reservaciones';
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $correo = $_POST['correo'];
                $telefono = $_POST['telefono'];
                $mensaje = $_POST['mensaje'];

                sanitize_text_field( $nombre );
                sanitize_text_field( $fecha );
                sanitize_text_field( $correo );
                sanitize_text_field( $telefono );
                sanitize_text_field( $mensaje );

                $datos = array(

                    'nombre' => $nombre,
                    'fecha' => $fecha,
                    'correo' => $correo,
                    'telefono' => $telefono,
                    'mensaje' => $mensaje,
            
                );
            
                $formato = array(
            
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
            
                );
            
                $wpdb->insert( $tabla, $datos, $formato );

                $url = get_page_by_title( 'Gracias por su reservación' );

                wp_redirect( get_permalink( $url->ID ) );
                
                exit();

            }
            
        }

   }

}

add_action( 'init', 'lapizzeria_guardar' );

?>