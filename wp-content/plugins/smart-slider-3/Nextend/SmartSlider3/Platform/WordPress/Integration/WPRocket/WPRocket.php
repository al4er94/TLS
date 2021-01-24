<?php

namespace Nextend\SmartSlider3\Platform\WordPress\Integration\WPRocket;

use Nextend\Framework\Plugin;

class WPRocket {

    public function __construct() {

        if (defined('WP_ROCKET_VERSION')) {
            $this->init();

            if (function_exists('get_rocket_cdn_url') && function_exists("get_rocket_option")) {
                if (get_rocket_option('cdn', 0)) {
                    add_action('init', array(
                        $this,
                        'initCDN'
                    ));
                }
            }
        }
    }

    public function init() {

        if (version_compare(WP_ROCKET_VERSION, '3.7.1.1', '<=')) {
            /**
             * @see https://nextendweb.atlassian.net/browse/SSDEV-2335
             */
            add_filter('rocket_excluded_inline_js_content', array(
                $this,
                'remove_rocket_excluded_inline_js_content'
            ));
        }

        /**
         * @see https://nextendweb.atlassian.net/browse/SSDEV-2434
         */
        add_filter('rocket_defer_inline_exclusions', array(
            $this,
            'rocket_defer_inline_exclusions'
        ));
    }

    public function remove_rocket_excluded_inline_js_content($excluded_inline) {

        if (($index = array_search('SmartSliderSimple', $excluded_inline)) !== false) {
            array_splice($excluded_inline, $index, 1);
        }

        return $excluded_inline;
    }

    public function rocket_defer_inline_exclusions($regexp) {

        if (!empty($regexp)) {
            $regexp .= '|';
        }

        $regexp .= 'N2R';

        return $regexp;
    }

    public function initCDN() {
        Plugin::addFilter('n2_style_loader_src', array(
            $this,
            'filterSrcCDN'
        ));

        Plugin::addFilter('n2_script_loader_src', array(
            $this,
            'filterSrcCDN'
        ));
    }

    public function filterSrcCDN($src) {
        return get_rocket_cdn_url($src);
    }
}