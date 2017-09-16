<?php 



function mysql_insert_array($table, $data, $exclude = array()) {
	
	global $wpdb;
	
	$charset_collate = $wpdb->get_charset_collate();

	// Creando la base de datos si no existe
	$query = 
		"CREATE TABLE IF NOT EXISTS `$table` 
		(
		  id INT AUTO_INCREMENT,
		  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,";		  
		  
		  $fields = $values = array();
	  	
	  	if( !is_array($exclude) ) $exclude = array($exclude);
		  
		  foreach(array_keys($data) as $key ) {
	      $query .= " `$key` TEXT, ";	     
	  	}

	$query .= 
		"PRIMARY KEY (`id`)
		) $charset_collate;";


	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $query );



	// Insertando datos en la base de datos.
  $fields = $values = array();
  if( !is_array($exclude) ) $exclude = array($exclude);
  foreach( array_keys($data) as $key ) {
    if( !in_array($key, $exclude) ) {
      $fields[] = "`$key`";
      $values[] = "'" . $data[$key] . "'";
    }
  }

  $fields = implode(",", $fields);
  $values = implode(",", $values);
  
  if( $wpdb->get_results("INSERT INTO `$table` ($fields) VALUES ($values)") ) {
    return array( "mysql_error" => false,
                  "mysql_insert_id" => mysql_insert_id(),
                  "mysql_affected_rows" => mysql_affected_rows(),
                  "mysql_info" => mysql_info()
                );
  } else {
    return array( "mysql_error" => mysql_error() );
  }
}


