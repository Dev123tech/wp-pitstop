<?php
/**
 * @author William Sergio Minossi
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $wpdb;


$table_name = $wpdb->prefix . "sbb_visitorslog";

$query = "SELECT COUNT(*) FROM ".$table_name. "
WHERE `bot` = '1'";

$quantos_bots = $wpdb->get_var($query);

$query = "SELECT COUNT(*) FROM ".$table_name. "
WHERE `bot` = '0'";


$quantos_humanos = $wpdb->get_var($query);

if($quantos_bots < 1 or $quantos_humanos < 1)
{

    echo 'Sorry, no info available. Please, try again tomorrow.';
    return;

}



$total = $quantos_bots +  $quantos_humanos;


$stopbadbots_results10[0]['Bots'] = $quantos_bots/$total;
$stopbadbots_results10[0]['Humans'] = $quantos_humanos/$total; 



