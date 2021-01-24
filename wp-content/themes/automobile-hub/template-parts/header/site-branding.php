<?php 
/*
* Display Logo and contact details
*/
?>

<div class="headerbox">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <?php $automobile_hub_logo_settings = get_theme_mod( 'automobile_hub_logo_settings','Different Line');
        if($automobile_hub_logo_settings == 'Different Line'){ ?>
        <!--  <div class="logo">
            <?php// if( has_custom_logo() ) automobile_hub_the_custom_logo(); ?>
            <?php// if(get_theme_mod('automobile_hub_site_title',true) != ''){ ?>
              <h1><a href="<?php// echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php //}?>
            <?php// $description = get_bloginfo( 'description', 'display' );
           // if ( $description || is_customize_preview() ) : ?>
              <?php //if(get_theme_mod('automobile_hub_site_tagline',true) != ''){ ?>
                <p class="site-description"><?php //echo esc_html($description); ?></p>
              <?php// }?>
            <?php// endif; ?>
          </div> -->
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home"><img width="240" height="55" src="http://localhost/tls/wp-content/uploads/2021/01/logo_test.png" class="custom-logo" alt="Automobile Hub Pro"></a>
        </div>
        <?php }else if($automobile_hub_logo_settings == 'Same Line'){ ?>
          <div class="logo logo-same-line">
            <div class="row">
              <div class="col-lg-5 col-md-5">
                <?php if( has_custom_logo() ) automobile_hub_the_custom_logo(); ?>                
              </div>
              <div class="col-lg-7 col-md-7">
                <?php if(get_theme_mod('automobile_hub_site_title',true) != ''){ ?>
                  <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php }?>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                  <?php if(get_theme_mod('automobile_hub_site_tagline',true) != ''){ ?>
                    <p class="site-description"><?php echo esc_html($description); ?></p>
                  <?php }?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="contact-div col-lg-8 col-md-8">  
        <div class="call contact-div-item col-lg-3 col-md-3">
          <?php //if( get_theme_mod( 'automobile_hub_call_text' ) != '' || get_theme_mod( 'automobile_hub_call' ) != '') { ?>
            <div class="row">
              <div class="col-lg-4 col-md-4"><i class="fa fa-phone"></i></div>
              <div class="col-lg-8 col-md-8">
                <p class="infotext"><?php echo esc_html( get_theme_mod('automobile_hub_call_text','Телефор') ); ?></p>
                <p class="simplep"><?php echo esc_html( get_theme_mod('automobile_hub_call','89215831653') ); ?></p>
              </div>            
            </div>
          <?php //} ?>
        </div>
        <div class="email contact-div-item col-lg-3 col-md-3">
          <?php // if( get_theme_mod( 'automobile_hub_mail_text' ) != '' || get_theme_mod( 'automobile_hub_mail' ) != '') { ?>
            <div class="row">
              <div class="col-lg-4 col-md-4"><i class="fa fa-envelope-open"></i></div>
              <div class="col-lg-8 col-md-8">
                <p class="infotext"><?php echo esc_html( get_theme_mod('automobile_hub_mail_text','Почта')); ?></p>
                <p class="simplep"><?php echo esc_html( get_theme_mod('automobile_hub_mail','info@tls.ru') ); ?></p>
              </div>
            </div>
          <?php // } ?>
        </div>
        <div class="adres contact-div-item col-lg-3 col-md-3">
          <?php // if( get_theme_mod( 'automobile_hub_mail_text' ) != '' || get_theme_mod( 'automobile_hub_mail' ) != '') { ?>
            <div class="row">
              <div class="col-lg-4 col-md-4"><i class="fa fa-map-marker"></i></div>
              <div class="col-lg-8 col-md-8">
                <p class="infotext"><?php echo esc_html( get_theme_mod('automobile_hub_mail_text','Адрес')); ?></p>
                <p class="simplep"><?php echo esc_html( get_theme_mod('automobile_hub_mail','Богатырский д.14 к.2') ); ?></p>
              </div>
            </div>
          <?php // } ?>
        </div>
       </div>   
        <!--
      <div class="col-lg-2 col-md-2">
        <?php if(class_exists('woocommerce')){ ?>
          <div class="row">
            <div class="col-lg-4 col-md-4"><i class="fas fa-shopping-basket"></i></div>
            <div class="col-lg-8 col-md-8">
              <p class="cart_no infotext">
                <?php global $woocommerce; ?>
                <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','automobile-hub' ); ?>"><?php esc_html_e('CART ITEM','automobile-hub'); ?></a>
              </p>
              <p class="cart-value simplep"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?> - <?php echo esc_sql( $woocommerce->cart->get_cart_total() ); ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
        <div class="clear">
            
        </div> -->
    </div>
  </div> 
</div>