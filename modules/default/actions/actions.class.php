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
   * @todo Improve the presentation of the corresponding view.
   * @todo Find a better way to list the methods available.
   * @todo Add the management of a form that would allow demo with other images.
   */
  public function executeIndex(sfWebRequest $request)
  {
    $methods = array(
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

    $this->_file_path = $request->getParameter('_file_path', dirname(__FILE__).'/../../../web/images/jpierre.jpg');

    $exif_data_manager = s6yExifDataManager::getInstance()->supplyImage($this->_file_path);

    $this->_exif_data = array();

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
  }

}
