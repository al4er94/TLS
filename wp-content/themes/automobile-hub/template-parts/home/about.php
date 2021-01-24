<?php
/**
 * Template part for displaying About section
 *
 * @package Automobile Hub
 * @subpackage automobile_hub
 */
?>

<section id="about">  
  <div class="container">
    <?php if( get_theme_mod('automobile_hub_about_tittle') != ''){ ?>
      <h3><?php echo esc_html(get_theme_mod('automobile_hub_about_tittle','')); ?></h3>
    <?php }?>
    <div class="row">
      <?php $automobile_hub_about_page = array();
        $mod = absint( get_theme_mod( 'automobile_hub_about_page' ));
        if ( 'page-none-selected' != $mod ) {
          $automobile_hub_about_page[] = $mod;
        }
      if( !empty($automobile_hub_about_page) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $automobile_hub_about_page,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-lg-5 col-md-5">
              <h4><?php the_title(); ?></h4>
              <p><?php the_excerpt(); ?></p>
              <div class="more-btn">
                <i class="fas fa-hand-point-right"></i><a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','automobile-hub'); ?></a>
                </a>
              </div>
            </div>
            <div class="col-lg-7 col-md-7">            
              <?php the_post_thumbnail(); ?>
            </div>          
          <?php endwhile; ?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
      endif;
      wp_reset_postdata()?>
      <div class="clearfix"></div> 
    </div>
  </div>
</section>