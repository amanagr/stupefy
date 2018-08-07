<?php
namespace block_clist;

defined('MOODLE_INTERNAL') || die();
require_once $CFG->libdir . "/externallib.php";
use external_api;
use external_function_parameters;
use external_value;
use context_user;


class block_clist_external extends external_api
{
    public static function get_block_data_parameters()
    {
        return new external_function_parameters(
            array()
        );
    }
    public static function get_block_data($serviceshortnames = array())
    {
        global $USER, $PAGE;

        $context = context_user::instance($USER->id);
        self::validate_context($context);

        $renderer = $PAGE->get_renderer('block_clist');
        $block    = new \block_clist\output\main();
        return $block->export_for_template($renderer);
    }
    public static function get_block_data_returns()
    {
        return null;
    }
}
