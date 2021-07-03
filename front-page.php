<?php get_header() ?>
   <?php while( have_posts() ): the_post(); ?>
        <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);">
            <div class="contenido-hero">
                <div class="text-hero">
                    <h1><?php echo esc_html( get_option( 'blogdescription' ) );?></h1>
                    <?php the_content(); ?>
                    <?php $url = get_page_by_title( 'Sobre Nosotros' )?>
                    <a class="button naranja" href="<?php echo get_permalink( $url->ID )?>">Leer más</a>
                </div>
            </div>
        </div>
        <?php /*the_post_thumbnail( 'large' );*/ ?>
    <?php endwhile;?>
      <div class="principal contenedor">
         <main class="text-centrado contenido-paginas">
            <h2 class="rojo texto-centrado">Nuestras especialidades</h2>
                <?php $args = array(
                    'post_type'         => 'especialidades',
                    'posts_per_page'     => 3,
                    'orderby'           => 'rand',
                    'category_name'     => 'pizzas',
                );
                $especialidades = new WP_Query( $args );
                while( $especialidades->have_posts() ): $especialidades->the_post();?>
                <div class="especialidad columnas1-3">
                    <div class="contenido-especialidad">
                        <?php the_post_thumbnail( 'especialidades_portrait' ); ?>
                        <div class="informacion-platillo">
                            <h3><?php the_title();?></h3>
                            <?php the_content();?>
                            <p class="precio">$<?php the_field( 'precio' );?></p>
                            <a href="<?php the_permalink();?>" class="button">Leer más</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <div class="contenedor-grid">
            </div>
            
         </main>
         
      </div>

        <section class="ingredientes">
            <div class="contenedor">
                <div class="contenedor-grid">
                    <?php while( have_posts() ): the_post();?>
                        <div class="columnas2-4 enlinea">
                            <?php the_field( 'contenido' ); ?>
                            <?php $url = get_page_by_title( 'Sobre Nosotros' )?>
                        <a class="button naranja" href="<?php echo get_permalink( $url->ID )?>">Leer más</a>
                        </div>
                        <div class="columnas2-4 imagen enlinea">
                            <img class="img-fluid" src="<?php the_field( 'imagen' ); ?>" alt="">
                        </div>
                    <?php endwhile;?>
                </div>
            </div>
          
        </section>

        <section class="contenedor">
            <h2 class="texto-rojo texto-centrado">Galería de Imagenes</h2>
            <?php $url = get_page_by_title( 'Galería' ) ?>
            <?php echo get_post_gallery( $url->ID );?>
        </section>

        <section class="ubicacion-reservacion">
            <div class="contenedor-grid">
                <div class="columnas2-4 enlinea">
                    <div id="map">

                    </div>
                </div>
                <div class="columnas2-4 enlinea">
                    <?php get_template_part( 'templates/formulario', 'reservacion' ) ?>
                </div>
            </div>
        </section>

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="" defer>
        </script>

<?php get_footer()?>
