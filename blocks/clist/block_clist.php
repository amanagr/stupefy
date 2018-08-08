<?php

require_once($CFG->dirroot. '/blocks/clist/lib.php');

class block_clist extends block_base {
    public function init() {
        $this->title = get_string('clist', 'block_clist');
    }

    public function get_content() {
        if ($this->content != null) {
            return $this->content;
        }
        $cssfilename = '/blocks/clist/styles.css';
        $this->page->requires->css($cssfilename);
        $renderable = new \block_clist\output\main();
        $renderer = $this->page->get_renderer('block_clist');
        $this->content = new stdClass();
        $this->content->text = $renderer->render($renderable);
        $this->content->footer = '';
        return $this->content;
    }
}
