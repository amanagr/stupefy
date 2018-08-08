<?php 

namespace block_clist\output;
require_once($CFG->dirroot.'/blocks/clist/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;

class main implements renderable, templatable {
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->courses = get_all_courses();
        $data->categories = get_all_categories();
        return $data;
    }
}
