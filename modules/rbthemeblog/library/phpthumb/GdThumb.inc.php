<?php
/**
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class GdThumb extends ThumbBase
{
    protected $oldImage;
    protected $workingImage;
    protected $currentDimensions;
    protected $newDimensions;
    protected $options;
    protected $maxWidth;
    protected $maxHeight;
    protected $percent;
    
    public function __construct($fileName, $options = array(), $isDataStream = false)
    {
        parent::__construct($fileName, $isDataStream);
        
        $this->determineFormat();
        
        if ($this->isDataStream === false) {
            $this->verifyFormatCompatiblity();
        }
        
        switch ($this->format) {
            case 'GIF':
                $this->oldImage = imagecreatefromgif($this->fileName);
                break;
            case 'JPG':
                $this->oldImage = imagecreatefromjpeg($this->fileName);
                break;
            case 'PNG':
                $this->oldImage = imagecreatefrompng($this->fileName);
                break;
            case 'STRING':
                $this->oldImage = imagecreatefromstring($this->fileName);
                break;
        }
    
        $this->currentDimensions = array(
            'width'     => imagesx($this->oldImage),
            'height'    => imagesy($this->oldImage)
        );
        
        $this->setOptions($options);
        
        // TODO: Port gatherImageMeta to a separate function that can be called to extract exif data
    }
    
    public function __destruct()
    {
        if (is_resource($this->oldImage)) {
            imagedestroy($this->oldImage);
        }
        
        if (is_resource($this->workingImage)) {
            imagedestroy($this->workingImage);
        }
    }
    
    public function resize($maxWidth = 0, $maxHeight = 0)
    {
        // make sure our arguments are valid
        if (!is_numeric($maxWidth)) {
            throw new InvalidArgumentException('$maxWidth must be numeric');
        }
        
        if (!is_numeric($maxHeight)) {
            throw new InvalidArgumentException('$maxHeight must be numeric');
        }
        
        // make sure we're not exceeding our image size if we're not supposed to
        if ($this->options['resizeUp'] === false) {
            $this->maxHeight    = ((int)$maxHeight > $this->currentDimensions['height']) ? $this->currentDimensions['height'] : $maxHeight;
            $this->maxWidth        = ((int)$maxWidth > $this->currentDimensions['width']) ? $this->currentDimensions['width'] : $maxWidth;
        } else {
            $this->maxHeight    = (int)$maxHeight;
            $this->maxWidth        = (int)$maxWidth;
        }
        
        // get the new dimensions...
        $this->calcImageSize($this->currentDimensions['width'], $this->currentDimensions['height']);
        
        // create the working image
        if (function_exists('imagecreatetruecolor')) {
            $this->workingImage = imagecreatetruecolor($this->newDimensions['newWidth'], $this->newDimensions['newHeight']);
        } else {
            $this->workingImage = imagecreate($this->newDimensions['newWidth'], $this->newDimensions['newHeight']);
        }
        
        $this->preserveAlpha();
        
        // and create the newly sized image
        imagecopyresampled(
            $this->workingImage,
            $this->oldImage,
            0,
            0,
            0,
            0,
            $this->newDimensions['newWidth'],
            $this->newDimensions['newHeight'],
            $this->currentDimensions['width'],
            $this->currentDimensions['height']
        );

        // update all the variables and resources to be correct
        $this->oldImage                     = $this->workingImage;
        $this->currentDimensions['width']     = $this->newDimensions['newWidth'];
        $this->currentDimensions['height']     = $this->newDimensions['newHeight'];
        
        return $this;
    }
    
    public function adaptiveResize($width, $height)
    {
        // make sure our arguments are valid
        if (!is_numeric($width) || $width  == 0) {
            throw new InvalidArgumentException('$width must be numeric and greater than zero');
        }
        
        if (!is_numeric($height) || $height == 0) {
            throw new InvalidArgumentException('$height must be numeric and greater than zero');
        }
        
        // make sure we're not exceeding our image size if we're not supposed to
        if ($this->options['resizeUp'] === false) {
            $this->maxHeight    = ((int)$height > $this->currentDimensions['height']) ? $this->currentDimensions['height'] : $height;
            $this->maxWidth        = ((int)$width > $this->currentDimensions['width']) ? $this->currentDimensions['width'] : $width;
        } else {
            $this->maxHeight    = (int)$height;
            $this->maxWidth        = (int)$width;
        }
        
        $this->calcImageSizeStrict($this->currentDimensions['width'], $this->currentDimensions['height']);
        
        // resize the image to be close to our desired dimensions
        $this->resize($this->newDimensions['newWidth'], $this->newDimensions['newHeight']);
        
        // reset the max dimensions...
        if ($this->options['resizeUp'] === false) {
            $this->maxHeight    = ((int)$height > $this->currentDimensions['height']) ? $this->currentDimensions['height'] : $height;
            $this->maxWidth        = ((int)$width > $this->currentDimensions['width']) ? $this->currentDimensions['width'] : $width;
        } else {
            $this->maxHeight    = (int)$height;
            $this->maxWidth        = (int)$width;
        }
        
        // create the working image
        if (function_exists('imagecreatetruecolor')) {
            $this->workingImage = imagecreatetruecolor($this->maxWidth, $this->maxHeight);
        } else {
            $this->workingImage = imagecreate($this->maxWidth, $this->maxHeight);
        }
        
        $this->preserveAlpha();
        
        $cropWidth    = $this->maxWidth;
        $cropHeight    = $this->maxHeight;
        $cropX         = 0;
        $cropY         = 0;
        
        // now, figure out how to crop the rest of the image...
        if ($this->currentDimensions['width'] > $this->maxWidth) {
            $cropX = (int)(($this->currentDimensions['width'] - $this->maxWidth) / 2);
        } elseif ($this->currentDimensions['height'] > $this->maxHeight) {
            $cropY = (int)(($this->currentDimensions['height'] - $this->maxHeight) / 2);
        }
        
        imagecopyresampled(
            $this->workingImage,
            $this->oldImage,
            0,
            0,
            $cropX,
            $cropY,
            $cropWidth,
            $cropHeight,
            $cropWidth,
            $cropHeight
        );
        
        // update all the variables and resources to be correct
        $this->oldImage                     = $this->workingImage;
        $this->currentDimensions['width']     = $this->maxWidth;
        $this->currentDimensions['height']     = $this->maxHeight;
        
        return $this;
    }
    
    public function adaptiveResizeWidth($width)
    {
        // make sure our arguments are valid
        if (!is_numeric($width) || $width  == 0) {
            throw new InvalidArgumentException('$width must be numeric and greater than zero');
        }
        
        // make sure we're not exceeding our image size if we're not supposed to
        if ($this->options['resizeUp'] === false) {
            $this->maxWidth        = ((int)$width > $this->currentDimensions['width']) ? $this->currentDimensions['width'] : $width;
        } else {
            $this->maxWidth        = (int)$width;
        }
        
        $this->calcImageSizeStrict($this->currentDimensions['width'], $this->currentDimensions['height']);
        
        // resize the image to be close to our desired dimensions
        $this->resize($this->newDimensions['newWidth'], $this->newDimensions['newHeight']);
        
        // reset the max dimensions...
        if ($this->options['resizeUp'] === false) {
            $this->maxWidth        = ((int)$width > $this->currentDimensions['width']) ? $this->currentDimensions['width'] : $width;
        } else {
            $this->maxWidth        = (int)$width;
        }
        
        $this->maxHeight = $this->currentDimensions['height'];
        
        // create the working image
        if (function_exists('imagecreatetruecolor')) {
            $this->workingImage = imagecreatetruecolor($this->maxWidth, $this->maxHeight);
        } else {
            $this->workingImage = imagecreate($this->maxWidth, $this->maxHeight);
        }
        
        $this->preserveAlpha();
        
        $cropWidth    = $this->maxWidth;
        $cropHeight    = $this->maxHeight;
        $cropX         = 0;
        $cropY         = 0;
        
        // now, figure out how to crop the rest of the image...
        if ($this->currentDimensions['width'] > $this->maxWidth) {
            $cropX = (int)(($this->currentDimensions['width'] - $this->maxWidth) / 2);
        } elseif ($this->currentDimensions['height'] > $this->maxHeight) {
            $cropY = (int)(($this->currentDimensions['height'] - $this->maxHeight) / 2);
        }
        
        imagecopyresampled(
            $this->workingImage,
            $this->oldImage,
            0,
            0,
            $cropX,
            $cropY,
            $cropWidth,
            $cropHeight,
            $cropWidth,
            $cropHeight
        );
        
        // update all the variables and resources to be correct
        $this->oldImage                     = $this->workingImage;
        $this->currentDimensions['width']     = $this->maxWidth;
        $this->currentDimensions['height']     = $this->maxHeight;
        
        return $this;
    }
    
    public function resizePercent($percent = 0)
    {
        if (!is_numeric($percent)) {
            throw new InvalidArgumentException('$percent must be numeric');
        }
        
        $this->percent = (int)$percent;
        
        $this->calcImageSizePercent($this->currentDimensions['width'], $this->currentDimensions['height']);
        
        if (function_exists('imagecreatetruecolor')) {
            $this->workingImage = imagecreatetruecolor($this->newDimensions['newWidth'], $this->newDimensions['newHeight']);
        } else {
            $this->workingImage = imagecreate($this->newDimensions['newWidth'], $this->newDimensions['newHeight']);
        }
        
        $this->preserveAlpha();
        
        ImageCopyResampled(
            $this->workingImage,
            $this->oldImage,
            0,
            0,
            0,
            0,
            $this->newDimensions['newWidth'],
            $this->newDimensions['newHeight'],
            $this->currentDimensions['width'],
            $this->currentDimensions['height']
        );

        $this->oldImage                     = $this->workingImage;
        $this->currentDimensions['width']     = $this->newDimensions['newWidth'];
        $this->currentDimensions['height']     = $this->newDimensions['newHeight'];
        
        return $this;
    }
    
    public function cropFromCenter($cropWidth, $cropHeight = null)
    {
        if (!is_numeric($cropWidth)) {
            throw new InvalidArgumentException('$cropWidth must be numeric');
        }
        
        if ($cropHeight !== null && !is_numeric($cropHeight)) {
            throw new InvalidArgumentException('$cropHeight must be numeric');
        }
        
        if ($cropHeight === null) {
            $cropHeight = $cropWidth;
        }
        
        $cropWidth    = ($this->currentDimensions['width'] < $cropWidth) ? $this->currentDimensions['width'] : $cropWidth;
        $cropHeight = ($this->currentDimensions['height'] < $cropHeight) ? $this->currentDimensions['height'] : $cropHeight;
        $cropX = (int)(($this->currentDimensions['width'] - $cropWidth) / 2);
        $cropY = (int)(($this->currentDimensions['height'] - $cropHeight) / 2);
        
        $this->crop($cropX, $cropY, $cropWidth, $cropHeight);
        
        return $this;
    }
    
    public function crop($startX, $startY, $cropWidth, $cropHeight)
    {
        // validate input
        if (!is_numeric($startX)) {
            throw new InvalidArgumentException('$startX must be numeric');
        }
        
        if (!is_numeric($startY)) {
            throw new InvalidArgumentException('$startY must be numeric');
        }
        
        if (!is_numeric($cropWidth)) {
            throw new InvalidArgumentException('$cropWidth must be numeric');
        }
        
        if (!is_numeric($cropHeight)) {
            throw new InvalidArgumentException('$cropHeight must be numeric');
        }
        
        // do some calculations
        $cropWidth    = ($this->currentDimensions['width'] < $cropWidth) ? $this->currentDimensions['width'] : $cropWidth;
        $cropHeight = ($this->currentDimensions['height'] < $cropHeight) ? $this->currentDimensions['height'] : $cropHeight;
        
        // ensure everything's in bounds
        if (($startX + $cropWidth) > $this->currentDimensions['width']) {
            $startX = ($this->currentDimensions['width'] - $cropWidth);
        }
        
        if (($startY + $cropHeight) > $this->currentDimensions['height']) {
            $startY = ($this->currentDimensions['height'] - $cropHeight);
        }
        
        if ($startX < 0) {
            $startX = 0;
        }
        
        if ($startY < 0) {
            $startY = 0;
        }
        
        // create the working image
        if (function_exists('imagecreatetruecolor')) {
            $this->workingImage = imagecreatetruecolor($cropWidth, $cropHeight);
        } else {
            $this->workingImage = imagecreate($cropWidth, $cropHeight);
        }
        
        $this->preserveAlpha();
        
        imagecopyresampled(
            $this->workingImage,
            $this->oldImage,
            0,
            0,
            $startX,
            $startY,
            $cropWidth,
            $cropHeight,
            $cropWidth,
            $cropHeight
        );
        
        $this->oldImage                     = $this->workingImage;
        $this->currentDimensions['width']     = $cropWidth;
        $this->currentDimensions['height']     = $cropHeight;
        
        return $this;
    }
    
    public function rotateImage($direction = 'CW')
    {
        if ($direction == 'CW') {
            $this->rotateImageNDegrees(90);
        } else {
            $this->rotateImageNDegrees(-90);
        }
        
        return $this;
    }
    
    public function rotateImageNDegrees($degrees)
    {
        if (!is_numeric($degrees)) {
            throw new InvalidArgumentException('$degrees must be numeric');
        }
        
        if (!function_exists('imagerotate')) {
            throw new RuntimeException('Your version of GD does not support image rotation.');
        }
        
        $this->workingImage = imagerotate($this->oldImage, $degrees, 0);
        
        $newWidth                             = $this->currentDimensions['height'];
        $newHeight                             = $this->currentDimensions['width'];
        $this->oldImage                     = $this->workingImage;
        $this->currentDimensions['width']     = $newWidth;
        $this->currentDimensions['height']     = $newHeight;
        
        return $this;
    }
    
    public function show($rawData = false)
    {
        if (headers_sent()) {
            throw new RuntimeException('Cannot show image, headers have already been sent');
        }
        
        switch ($this->format) {
            case 'GIF':
                imagegif($this->oldImage);
                break;
            case 'JPG':
                imagejpeg($this->oldImage, null, $this->options['jpegQuality']);
                break;
            case 'PNG':
            case 'STRING':
                imagepng($this->oldImage);
                break;
        }
        
        return $this;
    }
    
    public function getImageAsString()
    {
        $data = null;
        ob_start();
        $this->show(true);
        $data = ob_get_contents();
        ob_end_clean();
        
        return $data;
    }
    
    public function save($fileName, $format = null)
    {
        $validFormats = array('GIF', 'JPG', 'PNG');
        $format = ($format !== null) ? Tools::strtoupper($format) : $this->format;
        
        if (!in_array($format, $validFormats)) {
            throw new InvalidArgumentException('Invalid format type specified in save function: ' . $format);
        }
        
        // make sure the directory is writeable
        if (!is_writeable(dirname($fileName))) {
            // try to correct the permissions
            if ($this->options['correctPermissions'] === true) {
                @chmod(dirname($fileName), 0777);
                
                // throw an exception if not writeable
                if (!is_writeable(dirname($fileName))) {
                    throw new RuntimeException('File is not writeable, and could not correct permissions: ' . $fileName);
                }
            } else {
                throw new RuntimeException('File not writeable: ' . $fileName);
            }
        }
        
        switch ($format) {
            case 'GIF':
                imagegif($this->oldImage, $fileName);
                break;
            case 'JPG':
                imagejpeg($this->oldImage, $fileName, $this->options['jpegQuality']);
                break;
            case 'PNG':
                imagepng($this->oldImage, $fileName);
                break;
        }
        
        return $this;
    }

    public function setOptions($options = array())
    {
        // make sure we've got an array for $this->options (could be null)
        if (!is_array($this->options)) {
            $this->options = array();
        }
        
        // make sure we've gotten a proper argument
        if (!is_array($options)) {
            throw new InvalidArgumentException('setOptions requires an array');
        }
        
        // we've yet to init the default options, so create them here
        if (count($this->options) == 0) {
            $defaultOptions = array(
                'resizeUp'                => false,
                'jpegQuality'            => 92,
                'correctPermissions'    => false,
                'preserveAlpha'            => true,
                'alphaMaskColor'        => array (255, 255, 255),
                'preserveTransparency'    => true,
                'transparencyMaskColor'    => array (0, 0, 0)
            );
        } else {
            $defaultOptions = $this->options;
        }
        
        $this->options = array_merge($defaultOptions, $options);
    }
    
    public function getCurrentDimensions()
    {
        return $this->currentDimensions;
    }
    
    public function setCurrentDimensions($currentDimensions)
    {
        $this->currentDimensions = $currentDimensions;
    }
    
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }
    
    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;
    }
    
    /**
     *Returns $maxWidth.
     *
     *@see GdThumb::$maxWidth
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }
    
    /**
     *Sets $maxWidth.
     *
     *@param object $maxWidth
     *@see GdThumb::$maxWidth
     */
    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;
    }
    
    /**
     *Returns $newDimensions.
     *
     *@see GdThumb::$newDimensions
     */
    public function getNewDimensions()
    {
        return $this->newDimensions;
    }
    
    /**
     *Sets $newDimensions.
     *
     *@param object $newDimensions
     *@see GdThumb::$newDimensions
     */
    public function setNewDimensions($newDimensions)
    {
        $this->newDimensions = $newDimensions;
    }
    
    /**
     *Returns $options.
     *
     *@see GdThumb::$options
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     *Returns $percent.
     *
     *@see GdThumb::$percent
     */
    public function getPercent()
    {
        return $this->percent;
    }
    
    /**
     *Sets $percent.
     *
     *@param object $percent
     *@see GdThumb::$percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
    }
    
    /**
     *Returns $oldImage.
     *
     *@see GdThumb::$oldImage
     */
    public function getOldImage()
    {
        return $this->oldImage;
    }
    
    /**
     *Sets $oldImage.
     *
     *@param object $oldImage
     *@see GdThumb::$oldImage
     */
    public function setOldImage($oldImage)
    {
        $this->oldImage = $oldImage;
    }
    
    /**
     *Returns $workingImage.
     *
     *@see GdThumb::$workingImage
     */
    public function getWorkingImage()
    {
        return $this->workingImage;
    }
    
    /**
     *Sets $workingImage.
     *
     *@param object $workingImage
     *@see GdThumb::$workingImage
     */
    public function setWorkingImage($workingImage)
    {
        $this->workingImage = $workingImage;
    }
    
    protected function calcWidth($width, $height)
    {
        $newWidthPercentage    = (100 * $this->maxWidth) / $width;
        $newHeight            = ($height * $newWidthPercentage) / 100;
        
        return array(
            'newWidth'    => (int)$this->maxWidth,
            'newHeight'    => (int)$newHeight
        );
    }
    
    protected function calcHeight($width, $height)
    {
        $newHeightPercentage    = (100 * $this->maxHeight) / $height;
        $newWidth                 = ($width * $newHeightPercentage) / 100;
        
        return array(
            'newWidth'    => ceil($newWidth),
            'newHeight'    => ceil($this->maxHeight)
        );
    }
    
    protected function calcPercent($width, $height)
    {
        $newWidth    = ($width * $this->percent) / 100;
        $newHeight    = ($height * $this->percent) / 100;
        
        return array(
            'newWidth'    => ceil($newWidth),
            'newHeight'    => ceil($newHeight)
        );
    }
    
    protected function calcImageSize($width, $height)
    {
        $newSize = array(
            'newWidth'    => $width,
            'newHeight'    => $height
        );
        
        if ($this->maxWidth > 0) {
            $newSize = $this->calcWidth($width, $height);
            
            if ($this->maxHeight > 0 && $newSize['newHeight'] > $this->maxHeight) {
                $newSize = $this->calcHeight($newSize['newWidth'], $newSize['newHeight']);
            }
        }
        
        if ($this->maxHeight > 0) {
            $newSize = $this->calcHeight($width, $height);
            
            if ($this->maxWidth > 0 && $newSize['newWidth'] > $this->maxWidth) {
                $newSize = $this->calcWidth($newSize['newWidth'], $newSize['newHeight']);
            }
        }
        
        $this->newDimensions = $newSize;
    }
    
    protected function calcImageSizeStrict($width, $height)
    {
        // first, we need to determine what the longest resize dimension is..
        if ($this->maxWidth >= $this->maxHeight) {
            // and determine the longest original dimension
            if ($width > $height) {
                $newDimensions = $this->calcHeight($width, $height);
                
                if ($newDimensions['newWidth'] < $this->maxWidth) {
                    $newDimensions = $this->calcWidth($width, $height);
                }
            } elseif ($height >= $width) {
                $newDimensions = $this->calcWidth($width, $height);
                
                if ($newDimensions['newHeight'] < $this->maxHeight) {
                    $newDimensions = $this->calcHeight($width, $height);
                }
            }
        } elseif ($this->maxHeight > $this->maxWidth) {
            if ($width >= $height) {
                $newDimensions = $this->calcWidth($width, $height);
                
                if ($newDimensions['newHeight'] < $this->maxHeight) {
                    $newDimensions = $this->calcHeight($width, $height);
                }
            } elseif ($height > $width) {
                $newDimensions = $this->calcHeight($width, $height);
                
                if ($newDimensions['newWidth'] < $this->maxWidth) {
                    $newDimensions = $this->calcWidth($width, $height);
                }
            }
        }
        
        $this->newDimensions = $newDimensions;
    }
    
    protected function calcImageSizePercent($width, $height)
    {
        if ($this->percent > 0) {
            $this->newDimensions = $this->calcPercent($width, $height);
        }
    }
    
    /**
     *Determines the file format by mime-type
     *
     *This function will throw exceptions for invalid images / mime-types
     *
     */
    protected function determineFormat()
    {
        if ($this->isDataStream === true) {
            $this->format = 'STRING';

            return;
        }
        
        $formatInfo = getimagesize($this->fileName);
        
        // non-image files will return false
        if ($formatInfo === false) {
            if ($this->remoteImage) {
                $this->triggerError('Could not determine format of remote image: ' . $this->fileName);
            } else {
                $this->triggerError('File is not a valid image: ' . $this->fileName);
            }
            
            // make sure we really stop execution
            return;
        }
        
        $mimeType = isset($formatInfo['mime']) ? $formatInfo['mime'] : null;
        
        switch ($mimeType) {
            case 'image/gif':
                $this->format = 'GIF';
                break;
            case 'image/jpeg':
                $this->format = 'JPG';
                break;
            case 'image/png':
                $this->format = 'PNG';
                break;
            default:
                $this->triggerError('Image format not supported: ' . $mimeType);
        }
    }
    
    /**
     *Makes sure the correct GD implementation exists for the file type
     *
     */
    protected function verifyFormatCompatiblity()
    {
        $isCompatible     = true;
        $gdInfo            = gd_info();
        
        switch ($this->format) {
            case 'GIF':
                $isCompatible = $gdInfo['GIF Create Support'];
                break;
            case 'JPG':
                $isCompatible = (isset($gdInfo['JPG Support']) || isset($gdInfo['JPEG Support'])) ? true : false;
                break;
            case 'PNG':
                $isCompatible = $gdInfo[$this->format . ' Support'];
                break;
            default:
                $isCompatible = false;
        }
        
        if (!$isCompatible) {
            // one last check for "JPEG" instead
            $isCompatible = $gdInfo['JPEG Support'];
            
            if (!$isCompatible) {
                $this->triggerError('Your GD installation does not support ' . $this->format . ' image types');
            }
        }
    }
    
    protected function preserveAlpha()
    {
        if ($this->format == 'PNG' && $this->options['preserveAlpha'] === true) {
            imagealphablending($this->workingImage, false);
            
            $colorTransparent = imagecolorallocatealpha(
                $this->workingImage,
                $this->options['alphaMaskColor'][0],
                $this->options['alphaMaskColor'][1],
                $this->options['alphaMaskColor'][2],
                0
            );
            
            imagefill($this->workingImage, 0, 0, $colorTransparent);
            imagesavealpha($this->workingImage, true);
        }
        // preserve transparency in GIFs... this is usually pretty rough tho
        if ($this->format == 'GIF' && $this->options['preserveTransparency'] === true) {
            $colorTransparent = imagecolorallocate(
                $this->workingImage,
                $this->options['transparencyMaskColor'][0],
                $this->options['transparencyMaskColor'][1],
                $this->options['transparencyMaskColor'][2]
            );
            
            imagecolortransparent($this->workingImage, $colorTransparent);
            imagetruecolortopalette($this->workingImage, true, 256);
        }
    }
}
