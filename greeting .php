<?php
/**
 * Plugin Name: Greetings Template
 * Plugin URI:www.wordpress.org login
 * Author: Asmita Nyoupane
 * Author URI:https://www.facebook.com/ashmita.neupane.104/
 * Description: This plugin does wonders and provide beautifull greeting template
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: prefix-plugin-name
*/

add_action('init', 'custom_post_type');
function custom_post_type(){
    register_post_type('greetings', $args=array(
        'label' => 'Greetings Template',
        'public' => true,
        'menu_icon' => 'dashicons-editor-ul',
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'name' => 'Greetings Template',
        'description' => 'This is our custom post type',
        'has_archive'=> true,
        'rewrite'=>null,
     

    ));
}
add_shortcode('greet_temp', 'shortcode_greetings');


function Shortcode_greetings(){
    ob_start();
    ?>
    <div class="greeting-wrapper">
        <h2> My Greetings Card</h2>
        <div class="greeting_temp">
            <?php
            $args=array(
                'post_type' => 'greetings',
                'posts_per_page' => -1,
                'post_status' => 'publish',
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
             echo '<p>';
             
               
while ( $query->have_posts() ) :
                    $query->the_post();
                    $postId=get_the_ID();
echo  '<a href="'.get_permalink($postId).'">  '. get_the_title() . '</a></br>';
                endwhile;
                echo '</p>';
                wp_reset_postdata();
            endif;
?>
        </div>
    </div>
    <?php
    $content = ob_get_clean();

return $content;

}
?>
