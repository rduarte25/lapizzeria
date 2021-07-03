<?php

function lapizzeria_database() {

    global $wpdb;
    global $lapizzeria_dbversion;
    $lapizzeria_dbversion = '1.0';

    $tabla = $wpdb->prefix . 'reservaciones';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tabla (
        id mediumint(20) NOT NULL AUTO_INCREMENT,
        nombre varchar(50) NOT NULL,
        fecha datetime NOT NULL,
        correo varchar(50) DEFAULT '' NOT NULL,
        telefono varchar(10) NOT NULL,
        mensaje longtext NOT NULL,
        PRIMARY KEY(id)
    ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    if ( get_site_option( 'lapizzeria_dbversion' ) != $lapizzeria_dbversion ) {
        dbDelta( $sql );
    }
    add_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );

    /*** ACTUALIZAR EN CASO DE SER NECESARIO ***/
    
    $version_actual = get_option( 'lapizzeria_version' );

    if ( $lapizzeria_dbversion != $version_actual ) {

        $tabla = $wpdb->prefix . 'reservaciones';

        $sql = "ALTER TABLE $tabla (
            id mediumint(20) NOT NULL AUTO_INCREMENT,
            nombre varchar(50) NOT NULL,
            fecha datetime NOT NULL,
            correo varchar(50) DEFAULT '' NOT NULL,
            telefono varchar(10) NOT NULL,
            telefono2 varchar(10) NOT NULL,
            mensaje longtext NOT NULL,
            PRIMARY KEY(id)
        ) $charset_collate; ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta( $sql );
        
        update_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );

    }
}

add_action( 'after_setup_theme', 'lapizzeria_database' );

function lapizzeria_dbrevisar() {
    global $lapizzeria_dbversion;

    if ( get_site_option( 'lapizzeria_dbversion' ) != $lapizzeria_dbversion ) {

        lapizzeria_database();

    }
}

add_action( 'plugins_loaded', 'lapizzeria_dbrevisar' )



?>