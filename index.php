<?php get_header() ?>

      <?php
         $pagina_blog = get_option( 'page_for_posts' );
         $imagen = get_post_thumbnail_id( $pagina_blog );
         $imagen = wp_get_attachment_image_src( $imagen, 'full' );
      ?>
      <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);">
         <div class="contenido-hero">
            <div class="text-hero">
               <?php echo '<h1>' . get_the_title( $pagina_blog ) . '</h1>'?>
            </div>
         </div>
      </div>
      <?php /*the_post_thumbnail( 'large' );*/ ?>
      <div class="principal contenedor">
         <div class="contenedor-grid">         
            <main class="columnas2-3 contenido-paginas enlinea">
               <?php while( have_posts() ): the_post(); ?>
                  <article class="entrada-blog">
                     <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'especialidades' ); ?>
                     </a>
                     <header class="informacion-entrada clear">
                        <div class="fecha">
                           <time>
                              <?php echo the_time( 'd' ); ?>
                              <span><?php the_time( 'M' ) ?></span>
                           </time>
                        </div>
                        <div class="titulo-entrada">
                           <?php the_title( '<h2>', '</h2>' ); ?>
                           <p class="autor">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <?php the_author(); ?>
                           </p>
                        </div>

                        <?php the_category(); ?>
                        <?php the_tags(); ?>
                     </header>
                     <div class="contenido-entgrada">
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="button rojo">Leer más</a>
                     </div>
                  </article>
               <?php endwhile;?>
               <!--Paginación-->
               <div class="paginacion">
                  <?php //echo paginate_links();?>
                  <div class="anteriores">
                     <?php next_posts_link( 'Anteriores' ); ?>
                  </div>
                  <div class="siguientes">
                     <?php previous_posts_link( 'Siguientes' ); ?>
                  </div>
               </div>               
            </main>
            <?php get_sidebar();?>
         </div><!--- contenedor-grid --->
      </div><!--- contenedor-principal --->
   
<?php get_footer(); ?>
