<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ajax library
 * By phh
 */
class Ajax
{
	private $_body;
	private $_ajaxload;
	private $_head;
	
	public function __construct()
	{
		$this->_ajaxload=base_url('ajax-loader.gif');
		$this->_head='
	<script>
		function ajaxPlace(ss, img)
		{
			if(img)
			$(\'#\'+ss).html("<img src=\"'.$this->_ajaxload.'\" alt=\"load\" />");
			
			$.post(\''.current_url().'\', { ajax_request: ss }, function(data) {
			  $(\'#\'+ss).html(data);
			});
		}
	</script>
';
	}
	
	public function ajax_timer_event($id, $time, $s=false)
	{
		if($s)
			$s='true';
		else
			$s='false';
	
		$_h=<<<HTML
	<script>
	function Timer{$id}()
	{
		setTimeout("ajaxPlace('{$id}', {$s});Timer{$id}()", {$time});
	}
	Timer{$id}();
	</script>

HTML;
		$this->_head.=$_h;
	}
	
	public function ajax_get_panel($id)
	{
		return	'<ajax id="'.$id.'">'.$this->_body[$id].'</ajax>';
	}
	
	public function anwer()
	{
		if(isset($_POST['ajax_request']))
		{
			echo $this->_body[$_POST['ajax_request']];
			die();
		}
	}
	
	public function ajax_head()
	{
		return $this->_head;
	}
	
	public function ajax_set_panel($id, $body)
	{
		return	$this->_body[$id]=$body;
	}
	
	public function ajax_refresh_link($id, $html, $load=false)
	{
		if($load)
			return '<a href="javascript:ajaxPlace(\''.$id.'\', true)">'.$html.'</a>';
		else
			return '<a href="javascript:ajaxPlace(\''.$id.'\', false)">'.$html.'</a>';
	}
	
}
?>