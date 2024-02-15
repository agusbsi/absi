<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
	
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			$role = $this->CI->session->userdata('role');
			if ($role == 1) {
				$sidebar = "template/sidebar";
			} elseif ($role == 2) {
				$sidebar = "template/sidebar_spv";
			} elseif ($role == 3) {
				$sidebar = "template/sidebar_tl";
			} elseif ($role == 4) {
				$sidebar = "template/sidebar_spg";
			} elseif ($role == 5) {
				$sidebar = "template/sidebar_admg";
			} elseif ($role == 6) {
				$sidebar = "template/sidebar_adms";
			} elseif ($role == 7) {
				$sidebar = "template/sidebar_hrd";
			} elseif ($role == 8) {
				$sidebar = "template/sidebar_admmv";
			} elseif ($role == 9) {
				$sidebar = "template/sidebar_mngmkt";
			} elseif ($role == 10) {
				$sidebar = "template/sidebar_audit";
			} elseif ($role == 11) {
				$sidebar = "template/sidebar_staffhrd";
			} elseif ($role == 12) {
				$sidebar = "template/sidebar_staffga";
			} elseif ($role == 13) {
				$sidebar = "template/sidebar_finance";
			} elseif ($role == 14) {
			    $sidebar = "template/sidebar_mo";
			} elseif ($role == 15) {
			$sidebar = "template/sidebar_accounting";
		    } elseif ($role == 16) {
				$sidebar = "template/sidebar_admg";
			}
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			$this->set('sidebar', $sidebar);			
			return $this->CI->load->view($template, $this->template_data, $return);
		}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */