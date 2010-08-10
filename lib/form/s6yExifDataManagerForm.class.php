<?php

/**
 * s6yExifDataManagerForm
 *
 * A form dedicated to the management of the upload of demo images.
 *
 * @package    s6yExifDataManagerPlugin
 * @subpackage form
 * @author     Jérôme Pierre <contact@susokary.com>
 * @version    V1 - August 9th 2010
 */
class s6yExifDataManagerForm extends sfForm
{

  /**
   * Configures the current form.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - August 9th 2010
   *
   * @param n/a
   *
   * @return n/a
   *
   */
  public function configure()
  {
    parent::configure();

    $this->setWidget('_file_path', new sfWidgetFormInputFile(array(
      'label'      => 'Demo image',
    )));

    $this->setValidator('_file_path', new sfValidatorFile(array(
      'required'   => true,
      'mime_types' => array(
        'image/jpeg',
        'image/pjpeg',
        'image/tiff',
      ),
    )));

    $this->widgetSchema->setNameFormat('s6yExifDataManagerForm[%s]');
  }

}
