<?php

/**
 * s6yExifDataManager
 *
 * A class dedicated to the management of Exif data from JPEG/TIFF image files.
 *
 * @package    s6yExifDataManagerPlugin
 * @subpackage lib
 * @author     Jérôme Pierre <contact@susokary.com>
 * @version    V1 - July 28th 2010
 *
 * @method string  getFileName()                 Provides the name of the current image file (e.g.: 'jpierre.jpg').
 * @method integer getFileDateTime()             Provides the date/time of the current image file (e.g.: 1234545715).
 * @method integer getFileSize()                 Provides the size of the current image file (e.g.: 1049407).
 * @method integer getFileType()                 Provides the type of the current image file (e.g.: 2).
 * @method string  getMimeType()                 Provides the MIME type of the current image (e.g.: 'image/jpeg').
 * @method string  getSectionsFound()            Provides the list of the sections found in the Exif data of the current image (e.g.: 'ANY_TAG, IFD0, EXIF').
 * @method array   getCOMPUTED()                 Provides various informations about the current image (e.g.: array('html' => 'width="1331" height="1997"', 'Height' => 1997, 'Width' => 1331, 'IsColor' => 1, 'ByteOrderMotorola' => 0, 'CCDWidth' => '9mm', 'ApertureFNumber' => 'f/11.0', 'UserComment' => null, 'UserCommentEncoding' => 'UNDEFINED')).
 * @method string  getImageDescription()         Provides the description of the current image (e.g.: 'Style: "Portrait B&W"').
 * @method integer getOrientation()              Provides the orientation of the current image (e.g.: 1).
 * @method integer getYCbCrPositioning()         Provides the YCbCr positioning of the current image (e.g.: 1).
 * @method string  getXResolution()              Provides the X resolution of the current image (e.g.: '300/1').
 * @method string  getYResolution()              Provides the Y resolution of the current image (e.g.: '300/1').
 * @method integer getResolutionUnit()           Provides the resolution unit of the current image (e.g.: 2).
 * @method string  getDateTime()                 Provides the date/time of the current image (e.g.: '2007:00:00 00:00:00').
 * @method string  getDateTimeOriginal()         Provides the original date/time of the current image (e.g.: '2009:02:13 18:41:56').
 * @method string  getDateTimeDigitized()        Provides the digitized date/time of the current image (e.g.: '2009:02:13 18:41:56').
 * @method string  getMake()                     Provides the brand of the camera with which the current image was taken (e.g.: 'Canon').
 * @method string  getModel()                    Provides the model of the camera with which the current image was taken (e.g.: 'Canon EOS-1Ds Mark II').
 * @method string  getSoftware()                 Provides the software of the camera with which the current image was taken (e.g.: 'Capture One PRO 3.7.4 (3207) [fw: Firmware Version 1.1.6]').
 * @method integer getExif_IFD_Pointer()         Provides a pointer to the Exif IFD of the current image (e.g.: 186).
 * @method string  getExifVersion()              Provides the version of the Exif standard supported by the current image (e.g.: '0221').
 * @method string  getFlashPixVersion()          Provides the FlashPix format version supported by the current image (e.g.: '0010').
 * @method mixed   getColorSpace()               Provides the color space specifier of the current image (e.g.: 65535 - can also be an array of integer values sometimes, instead of just an integer).
 * @method string  getFNumber()                  Provides the FNumber of the current image (e.g.: '11/1').
 * @method string  getExposureTime()             Provides the exposure time of the current image (e.g.: '1/125').
 * @method integer getExposureProgram()          Provides the exposure program of the current image (e.g.: 1).
 * @method integer getISOSpeedRatings()          Provides the ISO speed ratings of the current image (e.g.: 100).
 * @method string  getComponentsConfiguration()  Provides various informations, specific to compressed data, about the current image (e.g.: '').
 * @method string  getShutterSpeedValue()        Provides the shutter speed value of the current image (e.g.: '458752/65536').
 * @method string  getApertureValue()            Provides the aperture value of the current image (e.g.: '458752/65536').
 * @method string  getExposureBiasValue()        Provides the exposure bias value of the current image (e.g.: '0/1').
 * @method integer getMeteringMode()             Provides the metering mode of the current image (e.g.: 5).
 * @method integer getFlash()                    Provides the flash of the current image (e.g.: 16).
 * @method string  getFlashPixVersion()          Provides the flash pix version of the current image (e.g.: '0100').
 * @method string  getFocalLength()              Provides the focal length of the current image (e.g.: '100/1').
 * @method string  getUserComment()              Provides the user comment of the current image (e.g.: '').
 * @method integer getExifImageWidth()           Provides the width of the current image (e.g.: 2048).
 * @method integer getExifImageLength()          Provides the length of the current image (e.g.: 1536).
 * @method string  getFocalPlaneXResolution()    Provides the focal plane X resolution of the current image (e.g.: '5008000/1420').
 * @method string  getFocalPlaneYResolution()    Provides the focal plane Y resolution of the current image (e.g.: '3334000/945').
 * @method integer getFocalPlaneResolutionUnit() Provides the focal plane resolution unit of the current image (e.g.: 2).
 * @method integer getCustomRendered()           Provides the custom rendered of the current image (e.g.: 0).
 * @method integer getExposureMode()             Provides the exposure mode of the current image (e.g.: 1).
 * @method integer getWhiteBalance()             Provides the white balance of the current image (e.g.: 0).
 * @method integer getSceneCaptureType()         Provides the scene capture type of the current image (e.g.: 0).
 * ...
 */
class s6yExifDataManager
{

  /**
   * A singleton instance of the current class.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @var s6yExifDataManager A singleton instance of the current class.
   */
  private static $_instance = null;

  /**
   * The absolute path to a JPEG/TIFF image file.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @var string The absolute path to a JPEG/TIFF image file.
   */
  private $_file_path = null;

  /**
   * The Exif data of a JPEG/TIFF image file.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @var array The Exif data of a JPEG/TIFF image file.
   */
  private $_exif_data = array();

  /**
   * Provides a new instance of the current class.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @param string $path The absolute path to a JPEG/TIFF image file.
   *
   * @return s6yExifDataManager A new instance of the current class.
   */
  public function __construct($path = null)
  {
    $this->supplyImage($path);
  }

  /**
   * Provides an instance of the current class.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @param string $path The absolute path to a JPEG/TIFF image file.
   *
   * @return s6yExifDataManager An instance of the current class.
   */
  public static function getInstance($path = null)
  {
    if (!isset(self::$_instance))
    {
      self::$_instance = new self($path);
    }
    else
    {
      self::$_instance->supplyImage($path);
    }

    return self::$_instance;
  }

  /**
   * Supplies a JPEG/TIFF image file.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @param string $path The absolute path to a JPEG/TIFF image file.
   *
   * @return s6yExifDataManager $this An instance of the current class.
   *
   * @throws sfException Throws an exception in case of unexisting file.
   * @throws sfException Throws an exception in case of unreadable file.
   */
  public function supplyImage($path = null)
  {
    if (!empty($path))
    {
      if (!is_file($this->_file_path = $path))
      {
        throw new sfException('The supplied file does not exist or is not a file.');
      }

      if (!$this->_exif_data = @read_exif_data($path))
      {
        throw new sfException('No Exif data can be read from the supplied file.');
      }
    }

    return $this;
  }

  /**
   * Provides methods to get the Exif data of a JPEG/TIFF image file.
   *
   * @author  Jérôme Pierre <contact@susokary.com>
   * @version V1 - July 28th 2010
   *
   * @param string $method    The name of the called method.
   * @param array  $arguments The arguments of the called method.
   *
   * @return mixed The Exif data returned by the called method.
   *
   * @throws sfException Throws an exception in case of missing file.
   * @throws sfException Throws an exception in case of undefined method.
   */
  private function __call($method, $arguments)
  {
    if (empty($this->_file_path) || empty($this->_exif_data))
    {
      throw new sfException('No JPEG/TIFF image file has been supplied.');
    }

    if (mb_substr($method, 0, 3) === 'get' && isset($this->_exif_data[mb_substr($method, 3)]))
    {
      return $this->_exif_data[mb_substr($method, 3)];
    }
    else
    {
      throw new sfException('The called method is undefined for the supplied JPEG/TIFF image file.');
    }
  }

}
