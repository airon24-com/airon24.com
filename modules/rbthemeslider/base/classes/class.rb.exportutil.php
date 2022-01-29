<?php
/**
* 2007-2021 PrestaShop
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
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

defined('_PS_VERSION_') or exit;

class RbExportUtil
{
    private $zip;
    private $file;
    private $imageList;

    public function __construct()
    {
        if (class_exists('ZipArchive')) {
            // Temporary directory for file operations
            $upload_dir = rb_upload_dir();
            $tmp_dir = $upload_dir['basedir'];

            // Prepare ZIP to work with
            $this->file = tempnam($tmp_dir, "zip");
            $this->zip = new ZipArchive;
            $this->zip->open($this->file, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
        }
    }


    /**
     * Adds slider settings .json file to ZIP
     *
     * @since 5.0.3
     * @access public
     * @param string $data Slider settings JSON
     * @return void
     */
    public function addSettings($data, $folder = '')
    {
        $folder = !empty($folder) ? $folder.'/' : '';
        $this->zip->addFromString($folder.'settings.json', $data);
    }


    /**
     * Adds slider images to ZIP
     *
     * @since 5.0.3
     * @access public
     * @param string $path Image path to add
     * @return void
     */
    public function addImage($files, $folder = '')
    {

        // Check file
        if (empty($files)) {
            return false;
        }

        // Check file type
        if (!is_array($files)) {
            $files = array($files);
        }

        // Check folder
        $folder = is_string($folder) ? $folder.'/uploads/' : 'uploads/';

        // Add contents to ZIP
        foreach ($files as $file) {
            if (!empty($file) && is_string($file)) {
                $this->zip->addFile(
                    $file,
                    $folder.rb_sanitize_file_name(basename($file))
                );
            }
        }
    }


    /**
     * Closes all pending operations and downloads the ZIP file.
     *
     * @since 5.0.3
     * @access public
     * @return void
     */
    public function download()
    {

        // Close ZIP operations
        $this->zip->close();

        // Set headers and to user
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="RbThemeSlider_Export_'.date('Y-m-d').'_at_'.date('H.i.s').'.zip"');
        header("Content-length: " . filesize($this->file));
        header('Pragma: no-cache');
        header('Expires: 0');
        readfile($this->file);

        // Remove temporary file
        unlink($this->file);
        die();
    }


    public function getImagesForSlider($data)
    {

        // Array to hold image URLs
        $this->imageList = array();

        // Slider Preview
        if (! empty($data['meta'])) {
            $this->_addImageToList($data['meta'], 'previewId', 'preview');
        }

        $this->_addImageToList($data['properties'], 'backgroundimageId', 'backgroundimage');
        $this->_addImageToList($data['properties'], 'yourlogoId', 'yourlogo');


        // Slides
        if (!empty($data['layers']) && is_array($data['layers'])) {
            foreach ($data['layers'] as $slide) {
                $this->_addImageToList($slide['properties'], 'backgroundId', 'background');
                $this->_addImageToList($slide['properties'], 'thumbnailId', 'thumbnail');


                // Layers
                if (!empty($slide['sublayers']) && is_array($slide['sublayers'])) {
                    foreach ($slide['sublayers'] as $layer) {
                        $this->_addImageToList($layer, 'imageId', 'image');
                        $this->_addImageToList($layer, 'posterId', 'poster');
                    }
                }
            }
        }

        return $this->imageList;
    }

    public function fontsForSlider($data)
    {
        $ret = array();
        $usedFonts = array();
        $googleFonts = rb_get_option('rb-google-fonts', array());

        if (!empty($data['layers']) && is_array($data['layers'])) {
            foreach ($data['layers'] as $slide) {
                if (!empty($slide['sublayers']) && is_array($data['layers'])) {
                    foreach ($slide['sublayers'] as $layer) {
                        if (!empty($layer['styles'])) {
                            $layer['styles'] = Tools::stripslashes($layer['styles']);

                            $styles = !empty($layer['styles']) ? Tools::jsonDecode(_ss($layer['styles']), true) : new stdClass;

                            if (!empty($styles['font-family'])) {
                                $families = explode(',', $styles['font-family']);
                                foreach ($families as $family) {
                                    $family = trim($family, " \"'\t\n\r\0\x0B");

                                    if (!empty($family)) {
                                        $usedFonts[] = Tools::strtolower($family);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($googleFonts as $font) {
            list($family, $weights) = explode(':', $font['param']);
            $family = Tools::strtolower(str_replace('+', ' ', $family));

            if (array_search($family, $usedFonts) !== false) {
                $font['admin'] = false;
                $ret[] = $font;
            }
        }

        return $ret;
    }

    public function getFSPaths($urls)
    {
        if (!empty($urls) && is_array($urls)) {
            $paths         = array();
            $upload     = rb_upload_dir();
            $uploadDir     = basename($upload['basedir']);


            foreach ($urls as $url) {
                // Get URL relative to the uploads folder
                $urlPath = parse_url($url, PHP_URL_PATH);
                $urlPath = explode("/$uploadDir/", $urlPath);

                if (empty($urlPath[1])) {
                    continue;
                }

                $urlPath = $urlPath[1];

                // Get file path
                $filePath = $upload['basedir'] . $urlPath;
                $filePath = realpath($filePath);

                // Add to array
                if (file_exists($filePath) && is_file($filePath)) {
                    $paths[] = $filePath;
                }
            }

            return $paths;
        }

        return array();
    }

    protected function _addImageToList($data, $idKey = '', $urlKey = '')
    {

        if (! empty($data[ $urlKey ])) {
            $src = $data[ $urlKey ];
        }

        if (! empty($data[ $idKey ])) {
            if ($result = rb_get_attachment_image_url($data[ $idKey ], 'full')) {
                $src = $result;
            }
        }

        if (! empty($src)) {
            $this->imageList[] = $src;
        }
    }
}
