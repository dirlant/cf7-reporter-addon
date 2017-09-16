<?php

require_once 'functions.php';

if(!function_exists("cf7ks_reporter")){
	
	add_action( 'wpcf7_before_send_mail', 'cf7ks_reporter' );

	function cf7ks_reporter( $contact_form ) {
		global $wpdb;

	  $submission = WPCF7_Submission::get_instance();

	  if ($submission ) {
      // Todos los datos del formulario
		  $posted_data = $submission->get_posted_data();
			
			// Creando formato de la tabla		  
		  $porcion = explode("-", $posted_data['_wpcf7_unit_tag']);
		  $tabla = $porcion[0].'_'.$porcion[1];
		  // Insert all the values of $_POST into the database table `artists`, except
			// for $_POST['submit'].  Remember, field names are determined by array keys!
			$result = mysql_insert_array($wpdb->prefix . 'form_'. $tabla, $posted_data, "submit");
	  }
	}

}

if(!function_exists("wpks_cf7_reporter")){

	add_action( 'admin_menu', 'wpks_cf7_reporter');

	function wpks_cf7_reporter(){
	  add_menu_page($page_title = 'Reportes', $menu_title = 'Reportes', $capability = 'administrator', $menu_slug = 'reportes', $function = 'reporte_general', $icon_url = '', $position = 120);
	}

	function reporte_general(){
	  include('include/reporte.php');
	}

}