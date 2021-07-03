<?php
//Añadir ReCaptcha
function lapizzeria_agregar_recaptcha() {
    //key site
    //6LdHd8UZAAAAACBKCsbBHHihZAplHbh0_f0XENjH
    //secret key
    //6LdHd8UZAAAAAKNFocL80tHLpfrgsySpAhVEeSt1
    ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
}

add_action( 'wp_head', 'lapizzeria_agregar_recaptcha' );

//requerimiento de base de datos.
require( get_template_directory() . '/inc/database.php' );
//requerimiento de funciones para las reservaciones.
require( get_template_directory() . '/inc/reservaciones.php' );
//requerimiento de funciones para las opciones.
require( get_template_directory() . '/inc/opciones.php' );

//Adición de característica para añadir la imagen destacada.
function lapizzeria_setup() {
    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'title-tag' );

    add_image_size( 'nosotros', 437, 291, true );

    add_image_size( 'especialidades', 768, 515, true );

    add_image_size( 'especialidades_portrait', 435, 526, true );

    update_option( 'thumbnail_size_w', 253 );

    update_option( 'thumbnail_size_h', 164 );
}
add_action( 'after_setup_theme', 'lapizzeria_setup' );

function lapizzeria_custom_logo() {

    $logo = array(
        'height' => 220,
        'width'  => 280,
    );

    add_theme_support( 'custom-logo', $logo );

}

add_action( 'after_setup_theme', 'lapizzeria_custom_logo' );

/* Esta funcion registra los style de la pizzeria */

function lapizzeria_styles() {

    //Registro de styles.
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '5.0' );

    wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'normalize' ), '4.7.0' );

    wp_register_style( 'style', get_template_directory_uri() . '/style.css', array( 'normalize' ), '1.0' );

    wp_register_style( 'open-sans', get_template_directory_uri() . '/css/Open-Sans.css', array( 'normalize' ), '1.0.0' );

    wp_register_style( 'raleway', get_template_directory_uri() . '/css/Raleway.css', array( 'normalize' ), '1.0.0' );

    wp_register_style( 'fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array( 'normalize' ), '1.0.0' );

    wp_register_style( 'datetime-local', get_template_directory_uri() . '/css/datetime-local-polyfill.css', array( 'normalize' ), '1.0.0' );

    //Llamada de los styles.
    wp_enqueue_style( 'normalize' );
    
    wp_enqueue_style( 'fontawesome' );

    wp_enqueue_style( 'style' );

    wp_enqueue_style( 'open-sans' );

    wp_enqueue_style( 'raleway' );

    wp_enqueue_style( 'fluidboxcss' );

    wp_enqueue_style( 'datetime-local' );   
}

add_action( 'wp_enqueue_scripts', 'lapizzeria_styles' );

function lapizzeria_scripts() {
    //Registrar JS
    $apikey = esc_html( get_option( 'lapizzeria_gmaps_apikey' ) );

    wp_register_script( 'polyfill', 'https://polyfill.io/v3/polyfill.min.js?features=default', array(), '1.0', true );    

    wp_register_script( 'maps', 'https://maps.googleapis.com/maps/api/js?key=' . $apikey . '&callback=initMap&libraries=&v=weekly', array(), '1.0', true );

    wp_deregister_script( 'jquery' );

    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.5.1.js', array(), '3.5.1', true );

    //wp_register_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.12.1.js', array( 'jquery' ), '1.12.1', true );

    wp_register_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0', true );

    wp_register_script( 'fluidboxjs', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array( 'jquery' ), '1.0.0', true );

    wp_register_script( 'datetime-localjs', get_template_directory_uri() . '/js/datetime-local-polyfill.min.js', array( 'jquery' ), '1.0.0', true );

    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-3.5.0.js', array( 'jquery' ), '3.5.0', true );

    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-3.5.0.js', array( 'jquery' ), '3.5.0', true );

    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'jquery-ui' );

    wp_enqueue_script( 'jquery-ui-core' );

    wp_enqueue_script( 'jquery-ui-datepicker' );

    wp_enqueue_script( 'modernizr' );

    wp_enqueue_script( 'scripts' );

    wp_enqueue_script( 'fluidboxjs' );

    wp_enqueue_script( 'datetime-localjs' );

    wp_enqueue_script( 'polyfill' );

    wp_enqueue_script( 'maps' );

    //Pasar variables de PHP a JavaScripts
    wp_localize_script( 
        'scripts',
        'opciones',
        array(
            'latitud' => get_option( 'lapizzeria_gmaps_latitud' ),
            'longitud' => get_option( 'lapizzeria_gmaps_longitud' ),
            'zoom' => get_option( 'lapizzeria_gmaps_zoom' ),
        )
    );

}

/* Esta función registra la acción de los estilos */

add_action( 'wp_enqueue_scripts', 'lapizzeria_styles' );

function lapizzeria_admin_scripts() {

    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );

    wp_enqueue_style( 'sweetalert2css', get_template_directory_uri() . '/css/sweetalert2.css' );

    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/admin-style.css', array( 'normalize' ) );

    wp_deregister_script( 'jquery' );

    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.5.1.js', array(), '3.5.1', true );

    wp_enqueue_script( 'sweetalert2js', get_template_directory_uri() . '/js/sweetalert2.all.min.js', array( 'jquery' ), '9.17.1', true );

    wp_enqueue_style( 'sweetalert2css', get_template_directory_uri() . '/css/sweetalert2.css', array( 'normalize' ) );

    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array( 'normalize' ), '1.0' );

    wp_enqueue_script( 'adminjs', get_template_directory_uri() . '/js/admin-ajax.js', array( 'jquery' ), '1.0', true );

    //Pasarle la URL de WP Ajax al adminjs
    wp_localize_script( 
        'adminjs',
        'url_eliminar',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        )
    );
};

add_action( 'admin_enqueue_scripts', 'lapizzeria_admin_scripts' );

//Agregar Async y Defer.
function agregar_async_defer( $tag, $handle ) {

    if( 'maps' !== $handle) {
        return $tag;
    } else {
        return str_replace( ' src', 'async="async" defer="defer" src', $tag );
        //return str_replace( ' src', 'async="async" defer="defer" src', $tag );
    }

}

add_filter( 'script_loader_tag', 'agregar_async_defer', 10, 2 );


/* función para registrar los menus */

function lapizzeria_menus(){

    register_nav_menus( array( 
        'header-menu' => __( 'Header Menu', 'lapizzeria' ),
        'social-menu' => __( 'Social Menu', 'lapizzeria' ),
     ) );

}

/* agregando la accion */
add_action( 'init', 'lapizzeria_menus' );

/*** Custom Post Type lapizzeria_especialidades ***/
function lapizzeria_especialidades() {
    $labels = array(
        'name'                       => _x( 'Especialidades', 'lapizzeria' ),
        'singular_name'              => _x( 'Especialid', 'post type singular name','lapizzeria' ),
        'menu_name'                  => _x( 'Especialidades', 'admin menu','lapizzeria' ),
        'name_admin_bar'             => _x( 'Especialid', 'add new on admin bar','lapizzeria' ),
        'add_new'                    => _x( 'Add New', 'book','lapizzeria' ),
        'add_new_item'               => __( 'Add New Especialidad', 'lapizzeria' ),
        'new_item'                   => __( 'New Especialidad', 'lapizzeria' ),
        'edit_item'                  => __( 'Edit Especialidad', 'lapizzeria' ),
        'view_item'                  => __( 'View Especialidad', 'lapizzeria' ),
        'all_items'                  => __( 'All Especialidades', 'lapizzeria' ),
        'search_items'               => __( 'Search Especialidades', 'lapizzeria' ),
        'parent_item_colon'          => __( 'Parent Especialidades', 'lapizzeria' ),
        'not_found'                  => __( 'No Especialidades found', 'lapizzeria' ),
        'not_found_in_trash'         => __( 'No Especialidades found in Trash', 'lapizzeria' ),
    );

    $args = array(
        'labels'                     => $labels,
        'description'                => __( 'Description.', 'lapizzeria' ),
        'public'                     => true,
        'publicly_quetyable'         => true,
        'show_ui'                    => true,
        'show_in_mene'               => true,
        'query_var'                  => true,
        'rewrite'                    => array( 'slug' => 'especialidades' ),
        'capability_type'            => 'post',
        'has_archive'                => true,
        'hierarchical'               => false,
        'menu_position'              => 6,
        'supports'                   => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'                 => array( 'category' ),
    );

    register_post_type( 'especialidades', $args );

}

add_action( 'init', 'lapizzeria_especialidades' );

/*** WIDGETS ***/
function lapizzeria_widgets() {
    register_sidebar( array(
        'name'          => 'Blog Sidebar',
        'id'            => 'blog_sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}

add_action( 'widgets_init', 'lapizzeria_widgets' );

/*** ADVANCED CUSTOM FIELDS ***/
define( 'ACF_LITE', true );

include_once( 'advanced-custom-fields/acf.php' );

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5f2c48242cd35',
        'title' => 'Especialidades',
        'fields' => array(
            array(
                'key' => 'field_5f2c4858de17f',
                'label' => 'Precio',
                'name' => 'precio',
                'type' => 'text',
                'instructions' => 'Añada el precio de la especilidad aquí',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'especialidades',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
    acf_add_local_field_group(array(
        'key' => 'group_5f456bc860818',
        'title' => 'Inicio',
        'fields' => array(
            array(
                'key' => 'field_5f4570152853f',
                'label' => 'Contenido',
                'name' => 'contenido',
                'type' => 'wysiwyg',
                'instructions' => 'Agrege la descripción',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5f45704c28540',
                'label' => 'Imagen',
                'name' => 'imagen',
                'type' => 'image',
                'instructions' => 'Agrege la imagen',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '5',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
    acf_add_local_field_group(array(
        'key' => 'group_5f2861614f0d4',
        'title' => 'Sobre Nosotros',
        'fields' => array(
            array(
                'key' => 'field_5f2861a3db95a',
                'label' => 'imagen 1',
                'name' => 'imagen_1',
                'type' => 'image',
                'instructions' => 'Suba una imagen',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5f28626b5169c',
                'label' => 'descripcion 1',
                'name' => 'descripcion_1',
                'type' => 'wysiwyg',
                'instructions' => 'Agregar Descripción',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5f28623ddb95c',
                'label' => 'imagen 2',
                'name' => 'imagen_2',
                'type' => 'image',
                'instructions' => 'Suba una imagen',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5f2862d8b6d7e',
                'label' => 'descripcion 2',
                'name' => 'descripcion_2',
                'type' => 'wysiwyg',
                'instructions' => 'Agregar Descripción',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
            array(
                'key' => 'field_5f286245db95d',
                'label' => 'imagen 3',
                'name' => 'imagen_3',
                'type' => 'image',
                'instructions' => 'Suba una imagen',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5f2862dcb6d7f',
                'label' => 'descripcion 3',
                'name' => 'descripcion_3',
                'type' => 'wysiwyg',
                'instructions' => 'Agregar Descripción',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '20',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
    endif;
