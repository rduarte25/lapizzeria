<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Soporte como web app -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="La Pizzeria">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/apple-touch-icon.jpg">
    <!-- Soporte para web apps android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#a61206">
    <meta name="application-name" content="La Pizzeria">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri();?>/icono.jpg" sizes="192x192">

    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
    <header class="site-header encabezado-sitio">
        <div class="contenedor">
            <div class="logo">
                <a href="<?php echo esc_url( home_url('/') );?>">

                    <?php
                        if( function_exists( 'the_custom_logo' ) ) {
                            the_custom_logo();
                        }
                    ?>
                    <img src="<?php echo get_template_directory_uri();?>/img/logo.svg" alt="" class="logotipo">
                </a>
            </div>

            <!-- Esta es la información que muestra el menu social -->
            <div class="informacion-encabezado">
                <div class="redes-sociales">
                    <?php $args = array(
                        'theme_location' => 'social-menu',
                        'container' => 'nav',
                        'container_class' => 'sociales',
                        'container_id' => 'sociales',
                        'link_before' => '<span class="sr-text">',
                        'link_after' => '</span>',          
                    ); 
                    
                    /* Esta función es la que imprime el menu de las redes sociales */
                    wp_nav_menu( $args );
                    ?>
                </div>

                <div class="direccion">
                    <p><?php echo esc_html( get_option( 'lapizzeria_direccion' ) );?></p>
                    <p>Teléfono: <?php echo esc_html( get_option( 'lapizzeria_telefono' ) );?></p>
                </div>
            </div>

        </div>
    </header>

    <!-- Creación del menu de navegación -->
    <div class="menu-principal">
        <div class="mobile-menu">
            <a href="#" class="mobile-menu"><i class="fa fa-bars" aria-hiden="true"> </i> Menu </a>      
        </div>

        <div class="contenedor navegacion">
            <?php
                
                /* Estos son los argumentos que se les pasan a la función */
                $args = array(
                    'theme_location' => 'header-menu',
                    'container' => 'nav',
                    'container_class' => 'menu-sitio'
                );

                /* Esta es la función que realiza la acción */

                wp_nav_menu( $args );

            ?>
        </div>
    </div>