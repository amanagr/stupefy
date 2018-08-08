<?php
namespace block_clist;

defined('MOODLE_INTERNAL') || die();
require_once $CFG->libdir . "/externallib.php";
require_once($CFG->dirroot. '/blocks/clist/lib.php');
use external_api;
use external_function_parameters;
use external_value;
use context_user;


class block_clist_external extends external_api
{
    public static function get_block_data_parameters()
    {
        return new external_function_parameters([
            'search_text' => new external_value(
                PARAM_RAW, 'Item text describing what is to be done'),
        ]);
    }

    public static function get_block_data($search_text = array())
    {
        global $USER, $PAGE;

        $search_text = strip_tags($search_text);
        $params = self::validate_parameters(
            self::get_block_data_parameters(), compact('search_text'));
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        $data = array(); 
        $data['courses'] = get_all_courses($params['search_text']);
        $data['categories'] = get_all_categories();
        return $data;
        // return get_all_courses($params['search_text']);
    }
    public static function get_block_data_returns()
    {
        return null;
    }
}
