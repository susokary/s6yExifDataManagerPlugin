<?php
/*@var $_file_path string */
/*@var $_exif_data array */
?>

<table>
  <tr>
    <th rowspan="<?php echo count($_exif_data) + 2; ?>">
      <?php echo image_tag("file://$_file_path", array('alt' => 'Demo image')); ?>
    </th>
    <th>Method</th>
    <th>Result</th>
  </tr>
  <?php foreach ($_exif_data as $key => $value): ?>
  <tr>
    <td><?php echo $key; ?>()</td>
    <td><?php echo $value; ?></td>
  </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="2">...</td>
  </tr>
</table>
