<?php
/**
 * Plugin Name: Solar IPS News Filter
 * Plugin URI: 
 * Description: The plugin is used to filter news based on category and archives via AJAX.
 * Version: 1.0
 * Author: Independent Power
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('wp_ajax_get_news','get_news_callback');
add_action('wp_ajax_nopriv_get_news','get_news_callback');
function get_news_callback(){
/*
<pre>Array
(
    [action] => get_news
    [category] => 3
    [archiveyear] =>  2023 
    [searchtext] => sdfsdf
    [pageno] => 1
)
*/
    $category    = sanitize_text_field($_POST['category']);
    $archiveyear = sanitize_text_field($_POST['archiveyear']);
    $searchtext  = sanitize_text_field($_POST['searchtext']);
    $paged       = sanitize_text_field($_POST['pageno']);

    $tax_query = array();
    $date_query= array();

    if($category){
        array_push($tax_query, 
                array(
                'taxonomy'  => 'category',
                'terms'     =>  $category,
                'field'     => 'term_id',
                )
            );
        
    }

    if($archiveyear){
        array_push($date_query, 
            array(
                'year' => trim($archiveyear),
            )
        );
    }


    $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 10,
            'post_status'       => 'publish',
            'paged'             => $paged,
            'tax_query'         => $tax_query,
            'date_query'        => $date_query,
            's'                 => $searchtext      
    );  

    if( empty($category) ) {
        unset($args['tax_query']);
    }

    if( trim($archiveyear) =='' ) {
        unset($args['date_query']);
    }

    if( $searchtext =='' ) {
        unset($args['s']);
    }


    $loop = new WP_Query( array_filter($args) );
    if($loop->have_posts()){
        while ($loop->have_posts()){
            $loop->the_post();

            $totalpost = $loop->found_posts; 
    
          
            if ( has_post_thumbnail() ) {
                $thumb_id  = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
                $thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
                
                $image = '<img src="'.esc_url( $thumb_url[0] ).'" alt="'.esc_attr( $thumb_alt ).'" class="img-full" />';
                
            }else{ 

                $image = '<img src="https://dummyimage.com/678x533/000/fff.jpg&text=No+Image" alt="Dummy Image" class="img-full" />';

            } 

    $posts.=
    '<a href="'.get_the_permalink().'" class="gl-content-card-comp text-white" data-aos="fade-up">
        <div class="card-img">'.$image.'</div>
        <div class="card-text">
            <div class="meta-box">
                <p class="date fw-b body-xs">'.get_the_date( "j F Y" ).'</p>
                <h5>'.get_the_title().'</h5>
            </div>
            <ul class="cat-box">'.getcategorynameallinpost(get_the_ID()).'</ul>
        </div>
    </a>';
    

        }
    }else{

        $posts.=
    '<div class="notfoundmatter" data-aos="fade-up">
        <p>Sorry, there are no matching blogs at this time. If you would like more information, you can contact us at <a href="tel:303-443-0115">303-443-0115</a>. Thank you!</p>
    </div>';
    

    }

    echo json_encode( array( 'posts'=>base64_encode($posts), 'total' => $totalpost ) ) ; 
    wp_die();
}



function news_filter_js() {

    wp_register_script('newsfilter-js',plugin_dir_url( __FILE__ ) . '/js/solarips-news.js',['jquery'],'',true);
    $solarips = array(
        'siteurl'     => site_url(),
        'adminurl'    => admin_url(),
        'ajaxurl'     => admin_url('admin-ajax.php'),
        'templateurl' => get_template_directory_uri()
    );
    wp_localize_script( 'newsfilter-js', 'solarips', $solarips );
    wp_enqueue_script( 'newsfilter-js');
}
add_action( 'wp_enqueue_scripts', 'news_filter_js' );