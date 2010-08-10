<?php

/**
 * defaultActions
 *
 * @package    s6yExifDataManagerPlugin
 * @subpackage actions
 * @author     Jérôme Pierre <contact@susokary.com>
 * @version    V1 - August 4th 2010
 */
class defaultActions extends sfActions
{

  /**
   * Performs a demo of this plugin functionnalities.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - August 4th 2010
   *
   * @param sfWebRequest $request The current web request.
   *
   * @return sfView The appropriate view.
   *
   * @todo Find a better way to list the available methods.
   */
  public function executeIndex(sfWebRequest $request)
  {
    // Defines the available methods.
    $this->_methods = array(
      'getFileName',
      'getFileDateTime',
      'getFileSize',
      'getFileType',
      'getMimeType',
      'getSectionsFound',
      'getCOMPUTED',
      'getImageDescription',
      'getOrientation',
      'getYCbCrPositioning',
      'getXResolution',
      'getYResolution',
      'getResolutionUnit',
      'getDateTime',
      'getDateTimeOriginal',
      'getDateTimeDigitized',
      'getMake',
      'getModel',
      'getSoftware',
      'getExif_IFD_Pointer',
      'getExifVersion',
      'getFlashPixVersion',
      'getColorSpace',
      'getFNumber',
      'getExposureTime',
      'getExposureProgram',
      'getISOSpeedRatings',
      'getComponentsConfiguration',
      'getShutterSpeedValue',
      'getApertureValue',
      'getExposureBiasValue',
      'getMeteringMode',
      'getFlash',
      'getFlashPixVersion',
      'getFocalLength',
      'getUserComment',
      'getExifImageWidth',
      'getExifImageLength',
      'getFocalPlaneXResolution',
      'getFocalPlaneYResolution',
      'getFocalPlaneResolutionUnit',
      'getCustomRendered',
      'getExposureMode',
      'getWhiteBalance',
      'getSceneCaptureType',
    );
    //

    // Defines the upload directory and the default file path.
    $upload_directory  = sfConfig::get('sf_upload_dir').'/s6yExifDataManagerPlugin';
    $default_file_path = "{$upload_directory}/jpierre.jpg";
    //

    // Manage the default demo image.
    if (!is_file($default_file_path))
    {
      $file_system = new sfFilesystem();

      $file_system->copy(
        sfConfig::get('sf_plugins_dir').'/s6yExifDataManagerPlugin/web/images/jpierre.jpg',
        $default_file_path,
        array('override' => true)
      );
    }
    //

    // Manage the upload of other demo images.
    $this->_form = new s6yExifDataManagerForm();

    if ($request->isMethod('POST'))
    {
      $this->_form->bind(
        $request->getPostParameter($this->_form->getName()),
        $request->getFiles($this->_form->getName())
      );

      if ($this->_form->isValid())
      {
        $validated_file = $this->_form->getValue('_file_path');

        $validated_file->save("{$upload_directory}/{$validated_file->getOriginalName()}");

        $this->getUser()->setAttribute('_file_path', $validated_file->getSavedName());
      }
    }
    //

    // Defines the current file path.
    $this->_file_path = $this->getUser()->getAttribute('_file_path', $default_file_path);
    //

    // Defines the current exif data.
    $exif_data_manager = s6yExifDataManager::getInstance()->supplyImage($this->_file_path);

    $this->_exif_data = array();

    $methods = array_unique($this->_methods + array_keys($exif_data_manager->getExifData()));

    foreach ($methods as $method)
    {
      try
      {
        $this->_exif_data[$method] = $exif_data_manager->$method();
      }
      catch (sfException $e)
      {
        $this->_exif_data[$method] = $e;
      }
    }
    //

    // Define the size of the demo image.
    $max = 300;

    try
    {
      $width  = $exif_data_manager->getExifImageWidth();
      $height = $exif_data_manager->getExifImageLength();
    }
    catch (sfException $e)
    {
      try
      {
        $computed = $exif_data_manager->getCOMPUTED();

        $width  = $computed['Width'];
        $height = $computed['Height'];
      }
      catch (sfException $e)
      {
        $width  = $max;
        $height = $max;
      }
    }

    if ($width > $max || $height > $max)
    {
      if ($width > $height)
      {
        $height = $height * $max / $width;
        $width  = $max;
      }
      else
      {
        $width = $width * $max / $height;
        $height  = $max;
      }
    }

    $this->_image_width  = $width;
    $this->_image_height = $height;
    //
  }

}
