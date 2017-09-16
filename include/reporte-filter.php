

<?php
  global $wpdb;

  $table = $wpdb->prefix.'form_wpcf7_f'.$_GET['formID'];
  $query = $wpdb->get_results(
    "	SELECT *
	      FROM $table"
    );  
  //print_r($query);
?>  

<?php
  /*
  $arreglo = [];
  $i = 0;
  foreach ($query as $key) {
    if ($key->field_name == 'nombre') {
      // Aumenta el contador siempre que el campo sea distinto
      $i++;
      $arreglo[$i][$key->field_name] = $key->field_value;
    }else{
      $arreglo[$i][$key->field_name] = $key->field_value;
    }
  }
  */
?>
<style media="screen">
table {
  display: block;
  overflow-x: auto;
  white-space: nowrap;
}
</style>
<h2 align="center">Registro del formulario:  </h2>
<table class="wp-list-table widefat striped">
  <thead>
    <form action="?page=reportes" method="get">
      <tr>
        <th width="5%">
          <a href="admin.php?page=reportes" class="button button-primary">Atras</a>
        </th>
        <th width="5%">Fecha:</th>
        <th width="10%">

          <input type="hidden" name="formTitle" value="<?php echo $nameForm ?>">
          <input type="date" name="date">
        </th>
        <th width="10%">
          <input type="submit" class="button button-primary" value="Buscar">
        </th>
        <th width="70%"></th>
      </tr>
    </form>
  </thead>

<table class="wp-list-table widefat striped" width="100%">
  <thead>
    <tr>
      <th>#</th>
      <?php $arreglo = json_decode(json_encode($query),true); ?>
      <?php
        // se extraen las key del arreglo
        $columns = (array_keys($arreglo[0]));
      ?>
      <?php for ($i=0; $i < count($columns); $i++): ?>
      <th class="manage-column"><?php echo $columns[$i] ?></th>
      <?php endfor; ?>      
    </tr>
  </thead>

  <tbody>

    <?php for ($i=0; $i < count($arreglo); $i++): ?>
      <tr>
        <td><?php echo $i; ?></td>
        <?php for ($j=0; $j < count($columns); $j++): ?>
          <td><?php echo $arreglo[$i][$columns[$j]] ?></td>
        <?php endfor; ?>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>
