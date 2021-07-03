<?php get_header() ?>
   <?php while( have_posts() ): the_post(); ?>
      <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);">
         <div class="contenido-hero">
            <div class="text-hero">
               <?php the_title( '<h1>', '</h1>' );?>
            </div>
         </div>
      </div>
      <?php /*the_post_thumbnail( 'large' );*/ ?>
      <div class="principal contenedor contacto">
         <main class="text-centrado contenido-paginas">
            <?php get_template_part( 'templates/formulario', 'reservacion' );?>
         </main>
      </div>

   <?php endwhile;?>

<?php get_footer()?>
