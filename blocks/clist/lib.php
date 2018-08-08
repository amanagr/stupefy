<?php 
require_once($CFG->libdir . '/enrollib.php');
include_once($CFG->libdir . '/coursecatlib.php');

function get_all_courses() {
    global $DB, $CFG;
    // $query = "SELECT id, fullname, shortname, summary from {course};";
    // $courselist = $DB->get_records_sql($query);
    $courselist = enrol_get_my_courses("*");
    $courses = array();

    // print_object($courses);
    // die();
    foreach ($courselist as $course) {
        array_push($courses, "<a title=\"" . format_string($course->shortname, true) . "\" ".
                "href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">"
                .format_string($course->fullname, true). "</a>");
    }
        if (empty($courses)) {
            return get_string("noclist", "block_clist");
        } else {
            return $courses;
        }
}

function get_all_categories() {

    global $DB, $CFG;
    // $query = "SELECT id, fullname, shortname, summary from {course};";
    // $courselist = $DB->get_records_sql($query);
    $categories = coursecat::get(0)->get_children();

    // print_object($categories);
    // die();
    $courses = array();
    foreach ($categories as $course) {
        array_push($courses, "<a title=\"" . format_string($course->name, true) . "\" ".
                "href=\"{$CFG->wwwroot}/course/index.php?categoryid={$course->id}\">"
                .format_string($course->name, true). "</a>");
    }
        if (empty($courses)) {
            return get_string("noclist", "block_clist");
        } else {
            return $courses;
        }
}
