<?php
ob_start();
class Test extends CI_Controller
{
    public function index()
    {
        $this->output->enable_profiler(true);
    }
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */