<?php
/**
 * The main template file
 *
 * @package Automobile Hub
 * @subpackage automobile_hub
 */

get_header(); ?>

<div class="container">

<?php echo do_shortcode('[smartslider3 slider="1"]'); ?>
	<main id="tp_content" role="main">
		<div id="primary" class="content-area">
                                 <?php echo do_shortcode('[show_form]'); ?>
                    <hr>
			<?php
	        $automobile_hub_sidebar_layout = get_theme_mod( 'automobile_hub_sidebar_post_layout','right');
?>  
		    	<div class="row m-0">
                        <div id="ourPluses" class="clients-why">
                            <h2 class="title">Причины выбрать нас</h2>
                            <div class="wrapper-1">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <div class="reasons-why pl pl-1">
                                        <p>Огромный опыт работы с Японскими автомобилями</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <div class="reasons-why pl pl-2">
                                        <p>100% контроль качества обслуживания клиентов</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <div class="reasons-why pl pl-3">
                                        <p>Мы готовим запчасти к Вашему приезду</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <div class="reasons-why pl pl-4">
                                        <p>СТО сертифицированы</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <div class="reasons-why pl pl-5">
                                        <p>Нас выбрали более 80&nbsp;000 клиентов</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-12">
                                        <div class="reasons-why pl pl-6">
                                        <p>Гарантия на работы до 2 лет</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
		        <div class="col-lg-8 col-md-8">
			            <?php
                                    if ( have_posts() ) : ?>
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							//get_template_part( 'template-parts/post/content', get_post_format() );

						endwhile;

						else :

							get_template_part( 'template-parts/post/content', 'none' );

						endif; ?>

			            <div class="navigation">
			              <?php
			                  // Previous/next page navigation.
			                  the_posts_pagination( array(
			                      'prev_text'          => __( 'Previous page', 'automobile-hub' ),
			                      'next_text'          => __( 'Next page', 'automobile-hub' ),
			                      'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'automobile-hub' ) . ' </span>',
			                  ) );
			              ?>
			                <div class="clearfix"></div>
			            </div>
		          	</div>
		          	<!--<div class="col-lg-4 col-md-4" id="theme-sidebar">
                                    <?php //dynamic_sidebar('sidebar-1');?></div>-->
		        </div>
		</div>
            <hr>
              <?php echo do_shortcode('[smartslider3 slider="3"]'); ?>
	</main>
</div>
<hr>
    <?php echo do_shortcode('[yamap center="60.0031,30.2779" height="22rem" controls="" zoom="13" type="yandex#map" mobiledrag="0"][yaplacemark  name="TLS" coord="59.9986,30.2683" icon="islands#dotIcon" color="#1e98ff"][/yamap]'); ?>
    <?php get_footer();