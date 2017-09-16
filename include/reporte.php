<?php


global $wpdb;

$query = $wpdb->get_results(
  "SELECT *
     FROM wp_posts
    WHERE post_type = 'wpcf7_contact_form'"
  );

?>
<div class="wrap">
  <h1>Reporte General</h1>
  <?php if (!isset($_GET['formID'])): ?>
    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
          <th class="manage-column">ID</th>
          <th class="manage-column">Titulo</th>
          <th class="manage-column">Estatus</th>
          <th class="manage-column">Tipo</th>
          <th class="manage-column">Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($query as $key): ?>
          <tr>
            <th class="manage-column"><?php echo $key->ID ?></th>
            <th class="manage-column"><?php echo $key->post_title ?></th>
            <th class="manage-column"><?php echo $key->post_status ?></th>
            <th class="manage-column"><?php echo $key->post_type ?></th>
            <th class="manage-column"><a href="?page=reportes&formID=<?php echo $key->ID ?>" class="button button-primary">Filtrar</a></th>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <?php if (isset($_GET['formID'])): ?>
      <?php include('reporte-filter.php'); ?>
  <?php endif; ?>

  <?php if (isset($_GET['formTitle']) && isset($_GET['date'])): ?>
      <?php include('reporte-filter.php'); ?>
  <?php endif; ?>

