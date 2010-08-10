<?php
/*@var $_form         s6yExifDataManagerForm */
/*@var $_file_path    string */
/*@var $_exif_data    array */
/*@var $_image_width  integer */
/*@var $_image_height integer */

/*
 * @todo Move the CSS code in an appropriate file.
 */
?>

<?php use_helper('s6yExifDataManager'); ?>

<style>
<!--
div#s6yExifDataManagerPlugin {
  width: 960px;
}

div#s6yExifDataManagerPlugin * {
  color: #333;
  font-family: Arial, Helvetica, DejaVu Sans, sans-serif;
  font-size: 12px;
}

div#s6yExifDataManagerPlugin h1 {
  font-size: 20px;
}

div#s6yExifDataManagerPlugin fieldset,
div#s6yExifDataManagerPlugin table {
  border: 1px solid #999;
  margin: 10px 0;
}

div#s6yExifDataManagerPlugin table th,
div#s6yExifDataManagerPlugin table td {
  padding: 10px 5px;
  text-align: left;
  vertical-align: top;
}

div#s6yExifDataManagerPlugin fieldset table,
div#s6yExifDataManagerPlugin table table {
  border: none;
  margin: 0;
}

div#s6yExifDataManagerPlugin table table th,
div#s6yExifDataManagerPlugin table table td {
  padding: 0;
  text-align: left;
  vertical-align: middle;
}

div#s6yExifDataManagerPlugin .error_list {
  float: right;
  margin: 5px 0 0 20px;
  padding: 0;
}

div#s6yExifDataManagerPlugin .error_list li {
  color: #f30;
}

div#s6yExifDataManagerPlugin pre {
  display: inline;
}
-->
</style>

<div id="s6yExifDataManagerPlugin">
  <h1>s6yExifDataManagerPlugin demo</h1>

  <p>This page offers you an overview of the features of the s6yExifDataManager plugin.</p>

  <?php echo $_form->renderFormTag(); ?>
  <fieldset>
    <legend>Wanna try it with another demo image?</legend>
      <table cellpadding="0" cellspacing="0">
        <?php echo $_form; ?>
        <tr>
          <td colspan="2">
            <input type="submit" />
          </td>
        </tr>
      </table>
    </fieldset>
  </form>

  <table cellpadding="0" cellspacing="0">
    <tr>
      <th rowspan="<?php echo count($_exif_data) + 4; ?>">
        <?php
        echo image_tag(str_replace(sfConfig::get('sf_root_dir').'/web', '', $_file_path), array(
          'alt'    => 'Demo image',
          'width'  => $_image_width,
          'height' => $_image_height,
        ));
        ?>
      </th>
      <th colspan="2">If you first write:</th>
    </tr>
    <tr>
      <td colspan="2">
        $exif_data_manager = s6yExifDataManager::getInstance();
        <br /><br />
        $exif_data_manager->supplyImage('<?php echo $_file_path; ?>');
      </td>
    </tr>
    <tr>
      <th>And then call:</th>
      <th>Then you obtain:</th>
    </tr>
    <?php foreach ($_exif_data as $key => $value): ?>
    <tr>
      <td>$exif_data_manager-><?php echo $key; ?>()</td>
      <td><pre><?php echo s6y_format_exif_data($value); ?></pre></td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="2">...</td>
    </tr>
  </table>
</div>
