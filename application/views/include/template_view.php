<?
	$this->load->view('include/header_view');
	$this->load->view('include/css_view');
	$this->load->view('include/js_view');
	
	?>
	<?php 
		$this->load->view($main_content);
	?>
	<? $this->load->view('include/footer_view'); ?>