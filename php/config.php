<?php
 
error_reporting(E_ALL);
ini_set('display_errors', 'On');
 
$username = "s95517";                
$password = "s95517";             
$database = "217.173.198.135:1522/orcltp.iaii.local";   
 
$query = "select * from dual";
 
$c = oci_connect($username, $password, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}
 
$s = oci_parse($c, $query);
if (!$s) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r = oci_execute($s);
if (!$r) {
    $m = oci_error($s);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}
 
?>
