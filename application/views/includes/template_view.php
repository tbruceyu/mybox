<?
	$this->load->view('includes/header_view');
	$this->load->view('includes/css_view');
	$this->load->view('includes/js_view');
	
	?>
	<?php 
		$this->load->view($main_content);
	?>
	<? $this->load->view('includes/footer_view'); ?>