<?php /**
 * @author William Sergio Minozzi
 * @copyright 2017
 * @ Modified time: 2020-02-03 16:00:57
 * */
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="stopbadbots-steps3">
       <div class="stopbadbots-block-title">
           Stop Bad Bots Plugin Activated
       </div>
   <div class="stopbadbots-help-container1">
        <div class="stopbadbots-help-column stopbadbots-help-column-1">
          <h3>Memory Usage</h3>
            <?php
$ds = 256;
$du = 60;
$stopbadbots_memory = sbb_check_memory();
if ($stopbadbots_memory['msg_type'] == 'notok') {
    echo 'Unable to get your Memory Info';
} else {
    $ds = $stopbadbots_memory['wp_limit'];
    $du = $stopbadbots_memory['usage'];
    if ($ds > 0) {
        $perc = number_format(100 * $du / $ds, 2);
    } else {
        $perc = 0;
    }
    if ($perc > 100) {
        $perc = 100;
    }
    $color = '#e87d7d';
    $color = '#029E26';
    if ($perc > 50) {
        $color = '#e8cf7d';
    }
    if ($perc > 70) {
        $color = '#ace97c';
    }
    if ($perc > 50) {
        $color = '#F7D301';
    }
    if ($perc > 70 or trim($stopbadbots_memory['wp_limit']) == '40') {
        $color = '#ff0000';
    }

/*
    echo '<p><li style="max-width:50%;font-weight:bold;padding:5px 15px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background-color:#0073aa;margin-left:13px;color:white;">' .
        'Memory Usage' . '<div style="border:1px solid #ccc;background:white;width:100%;margin:2px 5px 2px 0;padding:1px">' .
        '<div style="width: ' . $perc . '%;background-color:' . $color .
        ';height:6px"></div></div>' . $du . ' of ' . $ds . ' MB Usage' . '</li>';
        
  */
    

 $initValue = $perc;
 require_once "circle_memory.php";

 ?>



           For details, click the Memory Checkup Tab above.
           <br /> <br />
       <?php }?>
       </div>
       <!-- "Column1">  -->
        <div class="stopbadbots-help-column stopbadbots-help-column-2">
            <h3>Protection Status</h3>
            <?php


$perc = stopbadbots_find_perc();

/*
$color = '#ff0000';
if ($perc > 80) {
    $color = '#029E26';
    // verde
}
*/

$nivel = round($perc/10, 0, PHP_ROUND_HALF_UP);

/*
echo '<p><li style="max-width:50%;font-weight:bold;padding:5px 15px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background-color:#0073aa;margin-left:13px;color:white;">' .
    'Protection Level' .
    '<div style="border:1px solid #ccc;width:100%;background:white;margin:2px 5px 2px 0;padding:1px">' .
    '<div style="width: ' . ($perc) . '%;background-color:' . $color .
    ';height:6px"></div></div>' . 'Level: ' . $nivel . ' of 10  Protected' .
    '</li>';
*/
$initValue = stopbadbots_find_perc();
 require_once "circle_status.php";


$msg = '';

if($stopbadbots_block_enumeration == 'no'){
    $ms = "Activate Block User Enumeration in Settings Page.";
}

if ($stopbadbots_checkversion == '') {
    $ms = "Go Premium to get weekly Updates, Firewall Protection and more, consequently protection level 10.";

}


if($stopbadbots_block_pingbackrequest == 'no'){
    $ms = "Activate Block PingBack Requests in Settings Page.";
}



if ($stop_bad_bots_active == 'no') {
    $ms = "Activate Block All Bots in Settings Page.";
}
if ($stop_bad_bots_ip_active == 'no') {
    $ms = "Activate Block All IPs in Settings Page.";
}
if ($stop_bad_bots_referer_active == 'no') {
    $ms = "Activate Block all bots included at Bad Referer Table";
}

if ($stop_bad_bots_firewall != 'yes' and $stopbadbots_checkversion != '') {
    $ms = "Activate Firewall to increase protection.";
}
if (empty($ms)) {
    echo 'Protection from Bots in our database.';
} else {
    echo esc_attr($ms);
}
?>
             <br /> <br />
        </div> <!-- "columns 2">  -->
        <div class="stopbadbots-help-column stopbadbots-help-column-3">
         <?php
if (!empty($stopbadbots_checkversion)) {

             echo '<img src="' . esc_attr(STOPBADBOTSURL) . '/assets/images/lock-xxl.png" style="text-align:center; width: 40px;margin: 10px 0 auto;"  />';
             ?>     

             <h3 style="color:green; margin-top:10px;">Pro Protection Enabled</h3>
             With weekly database updates and Firewall protection.
             <br />
            <?php $site = 'https://stopbadbots.com';?>
            <a href="<?php echo esc_url($site); ?>" class="button button-primary">Learn More</a>
         <?php } else {

   echo '<center>';

   echo '<img src="' . esc_attr(STOPBADBOTSURL) . '/assets/images/unlock-icon-red-small.png" style="text-align:center; max-width: 40px;margin: 10px 0 auto;"  />';
 
   echo '</center>';
?>
            <h3 style="color:red; margin-top:10px;">Only Partial Protection enabled!
            </h3>
            <!-- Get weekly database updates and Firewall Protection. -->
            Bad bots consume bandwidth, slow down and can hack your server, create SPAM, steal your content to sell to your competitors, look for vulnerabilities and ruining the customer experience.
 
            <br />
           <?php $site = 'https://stopbadbots.com/premium/';?>
           <a href="<?php echo esc_url($site); ?>" class="button button-primary">Learn More</a>
    
            <?php
}

            $plugin = 'recaptcha-for-all/recaptcha.php';

              if(!is_plugin_active($plugin)){

                echo '<br>';
                echo '<br>';
                echo 'reCAPTCHA extension disabled!';
               // echo '<br>';

            }

            $plugin = 'antihacker/antihacker.php';

            if(!is_plugin_active($plugin)){

              echo '<br>';
              echo '<br>';
              echo 'Anti Hacker extension disabled!';
             // echo '<br>';

          }
          echo '<br>';
?>

        </div>
        <!-- "Column 3">  -->
    </div> <!-- "Container 1 " -->
</div> <!-- "stopbadbots-steps3"> -->


<div id="stopbadbots-services3">
    <div class="stopbadbots-help-container1">
        <div class="stopbadbots-help-column stopbadbots-help-column-1">
           <img alt="aux" src="<?php echo esc_attr(STOPBADBOTSURL) ?>assets/images/service_configuration.png" />
          <div class="bill-dashboard-titles">Start Up Guide and Settings</div>
          <br /><br />
          Just click Settings in the left menu (Stop Bad Bots).
          <br />
          Dashboard => Stop Bad Bots => Settings
          <br />
          <?php $site = STOPBADBOTSHOMEURL . "admin.php?page=settings-stop-bad-bots";?>
          <a href="<?php echo esc_url($site); ?>" class="button button-primary">Go</a>
          <br /><br />
       </div> <!-- "Column1">  -->
        <div class="stopbadbots-help-column stopbadbots-help-column-2">
            <img alt="aux" src="<?php echo esc_attr(STOPBADBOTSURL) ?>assets/images/support.png" />
          <div class="bill-dashboard-titles">OnLine Guide, Support, Faq...</div>
          <br /><br />
          You will find our complete and updated OnLine guide, faqs page, link to support and more in our site.
          <br />
          <?php $site = 'https://stopbadbots.com';?>
         <a href="<?php echo esc_url($site); ?>" class="button button-primary">Go</a>
        </div> <!-- "columns 2">  -->
       <div class="stopbadbots-help-column stopbadbots-help-column-3">
          <img alt="aux" src="<?php echo esc_attr(STOPBADBOTSURL) ?>assets/images/system_health.png" />
          <div class="bill-dashboard-titles">Troubleshooting Guide</div>
          <br />
          Bots showing in your statistics tool, Use old WP version, Low memory, some plugin with Javascript error are some possible problems.
          <br /><br />
          <a href="https://siterightaway.net/troubleshooting/" class="button button-primary">Troubleshooting Page</a>
       </div> <!-- "Column 3">  -->
    </div> <!-- "Container1 ">  -->
</div> <!-- "services"> -->



<div id="stopbadbots-services3">


  <div class="stopbadbots-help-container1">


       <div class="stopbadbots-help-2column stopbadbots-help-column-2">
         <h3>Total Bots Blocked Last 15 days</h3>
           <br />
           <?php require_once "botsgraph.php";?>
           <center>Days</center>
        </div> <!-- "Column 3">  -->



        <div style="margin-bottom: 20px; min-height: 240px;" class="stopbadbots-help-2column stopbadbots-help-column-2">
         <h3>Bots Blocked By Type</h3>
           <br />
           <?php require_once "botsgraph_pie.php";?>
        </div> <!-- "Column 3">  -->


        <div class="stopbadbots-help-2column stopbadbots-help-column-2">
         <h3>Bots / Human Visits</h3>
           <br />
           <?php require_once "botsgraph_pie2.php";?>
           <br /><br />
        </div> <!-- "Column 3">  -->


  </div> <!-- "Container1"> -->


</div> <!-- "Services"> -->
<div id="stopbadbots-services3">
    <div class="stopbadbots-help-container1">


        <div class="stopbadbots-help-2column stopbadbots-help-column-1">
          <h3>Top Bots Blocked by Name</h3>
           <?php require_once "topbots.php";?>
        </div> <!-- "Column1">  -->

        <div class="stopbadbots-help-2column stopbadbots-help-column-1">
          <h3>Top Bots Blocked By IP</h3>
          <?php require_once "topips.php";?>
        </div>


        <div class="stopbadbots-help-2column stopbadbots-help-column-2">
          <h3>Top Bots Bad Referer Blocked</h3>
          <?php require_once "toprefs.php";?>
        </div>
    </div>
</div>
<center>
    <h4>With our plugin, many blocked bots will give up of attack your site !
    </h4>
</center>
