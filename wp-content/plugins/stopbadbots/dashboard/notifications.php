<?php
/**
 * @author William Sergio Minozzi
 * @copyright 2021
 */
if (!defined('ABSPATH'))
   exit; // Exit if accessed directly 
global $stop_bad_bots_active;
global $stop_bad_bots_ip_active;
global $stop_bad_bots_referer_active;
global $stopbadbots_Report_Blocked_Firewall;
global $stopbadbots_notif_level;
global $wpdb;
$stopbadbots_prot_perc = stopbadbots_find_perc();
if (isset($_GET['notif'])) {
   $notif = sanitize_text_field($_GET['notif']);
   if ($notif == 'level') {
      update_option('stopbadbots_notif_level', time());
      $stopbadbots_notif_level = time();
   }
}
$timeout_level = time() > ($stopbadbots_notif_level + 60 * 60 * 24 * 7);
//$timeout_level = time() > ($stopbadbots_notif_level + 10);
$site = STOPBADBOTSHOMEURL . "admin.php?page=stop_bad_bots_plugin&tab=notifications&notif=";
?>
<div id="stopbadbots-notifications-page">
   <div class="stopbadbots-block-title">
      Notifications
   </div>
   <div id="notifications-tab">
      <?php
      $empty_notif = true;
      if ($stop_bad_bots_active != 'yes') {
         $empty_notif = false; ?>
         <b>Plugin Stop Bad Bots It is not active!</b>
         <br>
         Go to Dashboard => Stop Bad Bots => Settings => General Settings (tab) and activate it.
         <br>
         Mark: "Block all Bots included at Bad Bots Table?" with yes.
         <br>
         <hr>
      <?php
      }
      if ($stop_bad_bots_ip_active != 'yes') {
         $empty_notif = false; ?>
         <b>Plugin Stop Bad Bots (Block Ips) It is not active!</b>
         <br>
         Go to Dashboard => Stop Bad Bots => Settings => General Settings (tab) and activate it.
         <br>
         Mark: "Block all IPs included at Bad IPs Table?" with yes.
         <hr>
      <?php
      }
      if ($stop_bad_bots_referer_active != 'yes') {
         $empty_notif = false; ?>
         <b>Plugin Stop Bad Bots (Block Bad Refer Table) It is not active!</b>
         <br>
         Go to Dashboard => Stop Bad Bots => Settings => General Settings (tab) and activate it.
         <br>
         Mark: "Block all bots included at Bad Referer Table?" with yes.
         <hr>
      <?php
      }
      if ($timeout_level and $stopbadbots_prot_perc < 80) {
         $empty_notif = false;
      ?>
         <b>Improve your protection level. </b>
         <br>
         Protection Status level:&nbsp;
         <?php echo esc_attr($stopbadbots_prot_perc); ?>%
         <br>
         To increase, go to
         <br>
         Stop Bad Bots => Setting => General Settings
         <br>
         and mark all with yes.
         <br>
         <a href="<?php echo esc_url($site) ?>level">Dismiss</a>
         <hr>
      <?php }
      if ($empty_notif)
         echo '<b>No notifications at this time!</b>';
      ?>
   </div>
</div>