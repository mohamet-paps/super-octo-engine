<?php

/**
 * @package GaniusPlugin
 */

if (!defined("WP_UNINSTALL_PLUGIN")) {
   die;
}

// clean up 
//1
// $books = get_post(array("post_typ" => "livres", "numberposts" => -1));

// foreach ($books as $book) {
//    wp_delete_post($book->ID, true);
// }


//2 SQL

global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type='livres'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
