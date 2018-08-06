<?php 

namespace block_clist\output;

use renderable;
use templatable;
use renderer_base;
use stdClass;

class main implements renderable, templatable {
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        
        return $data;
    }
}
