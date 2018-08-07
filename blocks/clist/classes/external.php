<?php 
namespace block_clist;
require_once("$CFG->libdir/externallib.php");

use external_api;

class external extends external_api {
    public static function get_block_data_parameters() {
        return new external_function_parameters(
        );
    }
    public static function get_block_data($serviceshortnames = array()) {
        global $PAGE;
        $renderer = $PAGE->get_renderer('block_clist');
        $block = new \block_clist\output\main();
        print_object($block);
        die();
        return $block->export_for_template($renderer);
    }
    public static function get_block_data_returns() {

    }
}
