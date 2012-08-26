<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxs extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	 
	public function __construct()
    {
            parent::__construct();
            // Your own constructor code
			$this->load->helper('url');
			$this->load->library('ajax');
			$this->ajax->ajax_set_panel('datetime', $this->datetime());
			$this->ajax->ajax_timer_event("datetime", '15000', true);
				
			$this->ajax->anwer();
    }
	
	
	public function index()
	{
		$dd['button1']=$this->ajax->ajax_refresh_link('datetime', 'refresh button 1', true);
		$dd['button2']=$this->ajax->ajax_refresh_link('datetime', 'refresh button 2', false);
		$dd['head']=$this->ajax->ajax_head();
		$dd['date_time']=$this->ajax->ajax_get_panel('datetime');
		
		
		$this->load->library('parser');
		$this->parser->parse('ajaxtest', $dd);
	}
	
	public function datetime()
	{
		return 'Сейчас: '.date('d-m-Y H:i:s',time());
	}	
}