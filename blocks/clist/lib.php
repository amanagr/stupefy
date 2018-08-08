<?php 
require_once($CFG->libdir . '/enrollib.php');
include_once($CFG->libdir . '/coursecatlib.php');

function get_all_courses($search_text = '') {
    global $DB, $CFG;
    if ($search_text != '') {
        $query = "SELECT id, fullname, shortname, summary from {course} WHERE fullname LIKE '%".$search_text."%';";
        $courselist = $DB->get_records_sql($query);
    } else {
        $courselist = enrol_get_my_courses("*");
    }
    $courses = array();
    foreach ($courselist as $course) {
        array_push($courses, "<a title=\"" . format_string($course->shortname, true) . "\" ".
                "href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">"
                .format_string($course->fullname, true). "</a>");
    }
        if (empty($courses)) {
            return get_string('nocourse', "block_clist");
        } else {
            return $courses;
        }
}

function get_all_categories($search_text = '') {

    global $DB, $CFG;
    $query = "SELECT id, name from {course_categories} WHERE name LIKE '%".$search_text."%';";
    $categorylist = $DB->get_records_sql($query);
    //$categories = coursecat::get(0)->get_children();

    // print_object($categories);
    // die();
    $category = array();
    foreach ($categorylist as $single_category) {
        array_push($category, "<a title=\"" . format_string($single_category->name, true) . "\" ".
                "href=\"{$CFG->wwwroot}/course/index.php?categoryid={$single_category->id}\">"
                .format_string($single_category->name, true). "</a>");
    }
        if (empty($category)) {
            return get_string('nocategory', "block_clist");
        } else {
            return $category;
        }
}
