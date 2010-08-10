<?php

/**
 * s6yExifDataManagerHelper
 *
 * A helper dedicated to the management of Exif data from JPEG/TIFF image files.
 *
 * @package    s6yExifDataManagerPlugin
 * @subpackage helper
 * @author     Jérôme Pierre <contact@susokary.com>
 * @version    V1 - August 9th 2010
 */

/**
 * Formats a given Exif data in order to improve its presentation.
 *
 * @author  Jérôme Pierre <contact@susokary.com>
 * @version V1 - August 9th 2010
 *
 * @param mixed $data The given Exif data.
 *
 * @return mixed The formatted Exif data.
 */
function s6y_format_exif_data($exif_data = null)
{
  if ($exif_data instanceof sfOutputEscaper)
  {
    $exif_data = $exif_data->getRawValue();
  }

  $type = gettype($exif_data);

  switch ($type)
  {
    case 'array':
      $temp = '('.$type.')<table cellpadding="0" cellspacing="0">';

      foreach ($exif_data as $key => $sub_value)
      {
        $temp .= '<tr><td>'.$key.'</td><td> => </td><td>'.s6y_format_exif_data($sub_value).'</td></tr>';
      }

      $temp .= '</table>';

      return $temp;
      break;

    case 'NULL':
      return 'NULL';
      break;

    case 'object':
      return '('.$type.')'."\n".ucfirst($exif_data);
      break;

    default:
      return '('.$type.') '.$exif_data;
      break;
  }
}
