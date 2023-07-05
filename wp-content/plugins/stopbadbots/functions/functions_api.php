<?php
/**
 * @author Bill Minozzi
 * @copyright 2016-2021
 */
if (!defined('ABSPATH')) {
    exit;
}
add_action('rest_api_init', function () {
  register_rest_route('stopbadbots', '/central/', array(
      'methods' => 'POST',
      'callback' => 'stopbadbots_central_add',
      'permission_callback' => '__return_true'

  ));
});

function stopbadbots_central_add()
{
  global $wpdb;
  $username = sanitize_user($_POST['username']);
  $plain_password = $_POST['password'];
  $table_name = $wpdb->prefix . "users";
  $query = "select * from " . $table_name . " where user_login = '$username'";
  $result = $wpdb->get_row($query);
  if (!$result) {
      $auth = false;
  } else {
      $password_hashed = $result->user_pass;
      if (wp_check_password($plain_password, $password_hashed)) {
          $auth = true;
      } else {
          $auth = false;
      }
  }
  $mykey = base64_encode(substr(AUTH_KEY, 0, 9));
  if (!$auth)
      $r = array("result" => '', "plugin_path" => '');
  else
      $r = array("path" => ABSPATH, "plugin_path" => STOPBADBOTSURL, "mykey" => $mykey);
  return json_encode($r);
}

add_action('rest_api_init', function () {
  register_rest_route('stopbadbots', '/push/', array(
      'methods' => 'POST',
      'callback' => 'stopbadbots_central_push',
      'permission_callback' => '__return_true'

  ));
});
function stopbadbots_central_push()
{
  $key = trim(base64_encode(substr(AUTH_KEY, 0, 9)));
  $mykey = trim(sanitize_text_field($_POST['mykey']));
  if ($key != $mykey)
      return json_encode('Key Fail');
  $settings = sanitize_text_field($_POST['settings']);
  $a_settings = explode("\n", $settings);
  $ctd = 0;
  for ($i = 0; $i < count($a_settings); $i++) {
      $a_row = explode(",", $a_settings[$i]);
      if (empty($a_row[0]) or empty($a_row[1]))
          continue;
      if ($a_row[0] == 'stopbadbots_string_whitelist' or $a_row[0] == 'stopbadbots_ip_whitelist'  or $a_row[0] ==  'stopbadbots_http_tools') {
          update_option($a_row[0], base64_decode($a_row[1]));
      } else
          update_option($a_row[0], $a_row[1]);
      // return json_encode($a_row[1]);
      $ctd++;
  }
  return json_encode($ctd);
}