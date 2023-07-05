<?php
namespace bill_banners;
/**
 * @author William Sergio Minossi
 * @copyright 26/11/2021
 */
$termina = get_transient('termina');
// $termina = false;



$stopbadbots_checkversion = '';








  
if (!$termina) {
    ob_start();
    $myarray = array();
    $url = "https://billminozzi.com/API/bill-api.php";
    $response = wp_remote_post($url, array(
        'method' => 'POST',
        'timeout' => 5,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => $myarray,
        'cookies' => array()
    ));
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        // echo "Something went wrong: $error_message";
        set_transient('termina', DAY_IN_SECONDS, DAY_IN_SECONDS);
        ob_end_clean();
        return;
    }
    $r = trim($response['body']);
    ob_end_clean();
    $r = json_decode($r, true);
    /*
    array(5) { ["title"]=> string(12) "Black Friday" 
    ["termina"]=> string(10) "2021/12/25" 
    ["code"]=> string(9) "2021-Test" 
    ["type"]=> string(6) "coupon" 
    ["image"]=> string(10) "coupon.png" } 
    */
    if($r == NULL or count($r) < 5){

        /*
        set_transient('termina', DAY_IN_SECONDS, DAY_IN_SECONDS);

        $wtime = strtotime('-01 days');
        $r['termina'] = date('Y/m/d', $wtime);
        */

        set_transient('termina', time(), DAY_IN_SECONDS);
          



        $title = '';
        $image = '';
    }
    else {
        $type = $r['type'];
        if ($type == 'news')
            $message = $r['message'];
        else
            $code = $r['code'];
        $title = $r['title'];
        $termina = $r['termina'];
        set_transient('termina', $termina, DAY_IN_SECONDS);
        $image = $r['image'];
        set_transient('title', $title, DAY_IN_SECONDS);
        $x = set_transient('type', $type, DAY_IN_SECONDS);
        set_transient('image', $image, DAY_IN_SECONDS);
        if ($type == 'news')
            set_transient('message', $message, DAY_IN_SECONDS);
        else
            set_transient('code', $code, DAY_IN_SECONDS);
    }
} else {
    $type = get_transient('type');
    if ($type == 'news')
        $message = get_transient('message');
    else
        $code = get_transient('code');
    $title = get_transient('title');
    $termina = get_transient('termina');
    $image = get_transient('image');
}




if (!empty($stopbadbots_checkversion) and $type != 'news' )
   return;


if ((strtotime($termina) > time()) and !empty($title) and  !empty($image)) {
    // show block...
    echo '<ul>';
    echo '<h2>' . $title . '</h2>';
    //  echo '<li><a href="http://stopbadbotsPlugin.com/help">OnLine Guide</a></li>';
    // echo '<li><a href="http://billminozzi.com/dove/">Support</a></li>';
    //  echo '<li><a href="http://siterightaway.net/troubleshooting/">Troubleshooting</a></li>';
    echo '<img src="' . STOPBADBOTSIMAGES . '/' . $image . '" width="250" />';
    if ($type == 'news')
        echo '<BIG>' . $message . '</BIG>';
    else
        echo '<center><BIG>CODE: ' . $code . '</BIG></center>';
    //echo '<br>';
    echo '</ul>';
} // if termina...


if (!empty($stopbadbots_checkversion))
   return;



    echo '<ul>';
/*        
       //        $banner_image = CARDEALERIMAGES.'/keys_from_left.png';
        if($x == 1){
            echo '<h2>Make Your Website<br />Look More Professional</h2>';           
            echo '<img src="'.stopbadbotsIMAGES.'/apple.jpg" width="250" />';
        }
        if($x == 2){
            echo '<h2>Make Your Website<br />Look More Professional</h2>';
            // Chave
            echo '<img src="'.stopbadbotsIMAGES.'/keys.jpg" width="250" />';
        }
        if($x == 3){
            echo '<h2>Power for Your site: <br />Pro Version + Top Features.</h2>';
            // Leao
            echo '<img src="'.STOPBADBOTSIMAGES.'/lion.jpg" width="250" />';
        }
        if($x == 4){
            echo '<h2>Get Premium Performance: <br />Pro Version + Top Features.</h2>';
            // Corrida
            echo '<img src="'.STOPBADBOTSIMAGES.'/racing.jpg" width="250" />';
        }
        */

        $x = rand(1, 3);
        if($x == 1)
         $url = STOPBADBOTSURL."assets/videos/security11.mp4";
        if($x == 2)
         $url = STOPBADBOTSURL."assets/videos/security12.mp4";
        if($x == 3)
         $url = STOPBADBOTSURL."assets/videos/security13.mp4";
         

?>

    <video id="bill-banner-2" style="margin:-20px 0px -15px -12px; padding:0px;" width="400" height="230" muted>
        <source src="<?php echo $url;?>" type="video/mp4">
    </video>




    <li>Go Premium and receive automatically weekly updates</li>
    <li>Limit Bots Visits</li>
    <li>Firewall Protection</li>   
    <li>Dedicated Premium Support</li>
    <li>More...</li>
    <br />
    <a href="https://stopbadbots.com/premium/" class="button button-medium button-primary"><?php _e('Learn More', 'stopbadbots'); ?></a>
<?php
    echo '</ul>';
    //  echo '</div>'; //containerright


echo '<ul>';

if ($x < 2) {
    echo '<h2>Like This Plugin?</h2>';
    _e('If you like this product, please write a few words about it. It will help other people find this useful plugin more quickly.<br><b>Thank you!</b>', 'stopbadbots');
?>
    <br /><br />
    <a href="http://stopbadbots.com/share/" class="button button-medium button-primary"><?php _e('Rate or Share', 'stopbadbots'); ?></a>
<?php
} else {
    echo '<h2>Please help us keep the plugin free & up-to-date</h2>';
    _e('If you use & enjoy Stop Bad Bots Plugin, please rate it on WordPress.org. It only takes a second and helps us keep the plugin free and maintained. Thank you!', 'stopbadbots');
?>
    <br /><br />
    <a href="https://wordpress.org/support/plugin/stopbadbots/reviews/#new-post" class="button button-medium button-primary"><?php _e('Rate', 'stopbadbots'); ?></a>
<?php
}

echo '</ul>';
?>