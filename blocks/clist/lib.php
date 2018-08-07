<?php 
require_once($CFG->libdir . '/enrollib.php');
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
                .format_string($course->fullname, true). "</a>"."<br>");
    }
        if (empty($courses)) {
            return get_string("noclist", "block_clist");
        } else {
            return $courses;
        }
}
