<?php
/**
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class RbthemedreamDataSame
{
    public $name;

    public function __construct()
    {
        $this->name = 'rbthemedream';
    }

    public function exportDataConfig()
    {
        $id_lang = Context::getContext()->language->id;

        $configs = Db::getInstance()->executeS(
            'SELECT `name`, `value`
            FROM `'._DB_PREFIX_.'configuration`
            WHERE `name` LIKE "%RBTHEME%"'
        );

        if (!empty($configs)) {
            foreach ($configs as $key_c => $config) {
                if (Configuration::isLangKey($config['name'])) {
                    $configs[$key_c]['value'] = array(
                        Configuration::get($config['name'], $id_lang)
                    );
                }
            }
        }

        $fp = fopen(_PS_MODULE_DIR_ . $this->name . '/data/db_config.json', 'w');
        fwrite($fp, Tools::jsonEncode($configs));
        fclose($fp);
    }

    public function exportDataStruct()
    {
        $ignore_insert_table = array(
            _DB_PREFIX_.'favorite_product',
        );

        $content = 'SET NAMES \'utf8\';'."\n\n";
        $tables = Db::getInstance()->executeS('SHOW TABLES');
        $temp_table = array();

        foreach ($tables as $table) {
            $temp_table[] = current($table);
        }

        foreach ($temp_table as $key => $table) {
            if ($table == _DB_PREFIX_.'attribute_group') {
                // have to before table ps_attribute
                unset($temp_table[$key]);
                array_unshift($temp_table, _DB_PREFIX_.'attribute_group');
            } else if ($table == _DB_PREFIX_.'lang') {
                // have to before table attribute_group_lang
                unset($temp_table[$key]);
                array_unshift($temp_table, _DB_PREFIX_.'lang');
            } else if ($table == _DB_PREFIX_.'shop_group') {
                // have to before table shop
                unset($temp_table[$key]);
                array_unshift($temp_table, _DB_PREFIX_.'shop_group');
            } else if ($table == _DB_PREFIX_.'shop') {
                // have to before table attribute_group_shop
                unset($temp_table[$key]);
                array_unshift($temp_table, _DB_PREFIX_.'shop');
            }
        }

        $tables = $temp_table;

        foreach ($tables as $table) {
            // Skip tables which do not start with _DB_PREFIX_
            if (Tools::strlen($table) < Tools::strlen(_DB_PREFIX_) || strncmp($table, _DB_PREFIX_, Tools::strlen(_DB_PREFIX_)) != 0) {
                continue;
            }
            // Export the table schema
            $schema = Db::getInstance()->executeS('SHOW CREATE'.' TABLE `'.pSQL($table).'`');
            if (in_array($schema[0]['Table'], $ignore_insert_table)) {
                continue;
            }

            $content .= $schema[0]['Create Table'].";\n\n";

            if (count($schema) != 1 || !isset($schema[0]['Table']) || !isset($schema[0]['Create Table'])) {
                fclose($fp);
                //$this->_html["error"] = "An error occurred while backing up. Unable to obtain the schema of ".$table;
                return false;
            }
        }

        $content = str_replace('CREATE'.' TABLE `'._DB_PREFIX_, 'CREATE'.' TABLE `PREFIX_', $content);
        $content = str_replace('REFERENCES `'._DB_PREFIX_, 'REFERENCES `PREFIX_', $content);
        $content = str_replace(') ENGINE=InnoDB ', ') ENGINE=ENGINE_TYPE ', $content);
        $content = str_replace(' CHARSET=utf8;', ' CHARSET=utf8 COLLATION;', $content);
        $content = preg_replace("/AUTO_INCREMENT=\d+ /","", $content);

        $fp = fopen(_PS_MODULE_DIR_ . $this->name . '/data/db_structure.sql', 'w');
        fwrite($fp, $content);
        fclose($fp);
    }

    public function exportDataSQL()
    {
        $ignore_insert_table = array(
            _DB_PREFIX_.'connections',
            _DB_PREFIX_.'connections_page',
            _DB_PREFIX_.'connections_source',
            _DB_PREFIX_.'guest',
            _DB_PREFIX_.'statssearch',
            _DB_PREFIX_.'sekeyword',
            _DB_PREFIX_.'favorite_product',
            _DB_PREFIX_.'pagenotfound',
            _DB_PREFIX_.'shop_url',
            _DB_PREFIX_.'employee',
            _DB_PREFIX_.'employee_shop',
        );

        $backupfile = _PS_MODULE_DIR_ . $this->name . "/data/db_data.sql";

        $fp = @fopen($backupfile, 'w');

        if ($fp === false) {
            return false;
        }

        fwrite($fp, 'SET NAMES \'utf8\';'."\n");
        fwrite($fp, 'SET FOREIGN_KEY_CHECKS = 0;'."\n\n");
        // Find all tables
        $tables = Db::getInstance()->executeS('SHOW TABLES');
        $found = 0;
        $sql = '';

        foreach ($tables as $table) {
            $table = current($table);

            // Skip tables which do not start with _DB_PREFIX_
            if (Tools::strlen($table) < Tools::strlen(_DB_PREFIX_) || strncmp($table, _DB_PREFIX_, Tools::strlen(_DB_PREFIX_)) != 0) {
                continue;
            }

            // Export the table schema
            $schema = Db::getInstance()->executeS('SHOW CREATE'.' TABLE `'.pSQL($table).'`');

            if (count($schema) != 1 || !isset($schema[0]['Table']) || !isset($schema[0]['Create Table'])) {
                fclose($fp);
                $this->_html["error"] = "An error occurred while backing up. Unable to obtain the schema of ".$table;
                return false;
            }

            if (!in_array($schema[0]['Table'], $ignore_insert_table)) {
                $sql .= "\n".'TRUNCATE TABLE '.str_replace("`"._DB_PREFIX_, "`PREFIX_", "`".$schema[0]['Table']).'`;'."\n";
                $data = Db::getInstance()->query('SELECT * FROM `'.pSQL($schema[0]['Table']).'`', false);
                $sizeof = DB::getInstance()->NumRows();
                $lines = explode("\n", $schema[0]['Create Table']);

                if ($data && $sizeof > 0) {
                    // Export the table data
                    $sql .= 'INSERT INTO '.str_replace('`'._DB_PREFIX_, '`PREFIX_', '`'.$schema[0]['Table'])."` VALUES\n";
                    //fwrite($fp, 'INSERT INTO `'.$schema[0]['Table']."` VALUES\n");
                    $i = 1;
                    while ($row = DB::getInstance()->nextRow($data)) {
                        $s = '(';

                        foreach ($row as $field => $value) {
                            //special table
                            if ($schema[0]['Table'] == _DB_PREFIX_."btmegamenu_widgets" && $field == "params") {
                                $flag_change = false;
                                $widgetParam = Tools::jsonDecode(call_user_func('base64'.'_decode', $value), true);

                                foreach ($widgetParam as $widKey => $widValue) {
                                    //replace image url
                                    foreach ($this->_imageField as $fVal) {
                                        if (strpos($widKey, $fVal) !== false && strpos($widValue, 'img') !== false) {
                                            $widValue = str_replace('src="/', 'src="', $widValue);
                                            $widValue = str_replace('"'.ltrim(__PS_BASE_URI__,'/').'modules/', '"modules/', $widValue);
                                            $widValue = str_replace('"'.ltrim(__PS_BASE_URI__,'/').'themes/', '"themes/', $widValue);
                                            $widValue = str_replace('"'.ltrim(__PS_BASE_URI__,'/').'img/', '"img/', $widValue);
                                            $widgetParam[$widKey] = $widValue;
                                            $flag_change = true;
                                            break;
                                        }
                                    }
                                }
                                if ($flag_change) {
                                    $value = call_user_func('base64'.'_encode', Tools::jsonEncode($widgetParam));
                                }
                            }

                            $tmp = "'".pSQL($value, true)."',";
                            if ($tmp != "'',") {
                                $s .= $tmp;
                            } else {
                                foreach ($lines as $line) {
                                    if (strpos($line, '`'.$field.'`') !== false) {
                                        if (preg_match('/(.*NOT NULL.*)/Ui', $line)) {
                                            $s .= "'',";
                                        } else {
                                            $s .= 'NULL,';
                                        }
                                        break;
                                    }
                                }
                            }
                        }

                        $s = rtrim($s, ',');

                        if (($schema[0]['Table'] == _DB_PREFIX_."cms_lang" && $i % 100 == 0) && $i < $sizeof) {
                            # Insert 1 time have 100 records
                            $s .= ");\nINSERT INTO ".str_replace('`'._DB_PREFIX_, '`PREFIX_', '`'.$schema[0]['Table'])."` VALUES\n";
                        } elseif ($i < $sizeof) {
                            $s .= "),\n";
                        } else {
                            $s .= ");\n";
                        }

                        $sql .= $s;
                        ++$i;
                    }
                }
            }

            $found++;
        }

        //table PREFIX_condition
        $sql = str_replace(" "._DB_PREFIX_, " PREFIX_", $sql);
        fwrite($fp, $sql);
        fwrite($fp, "\n\n".'SET FOREIGN_KEY_CHECKS = 1;');
        fclose($fp);
    }

    public function resetDefaultData()
    {
        $homes = Db::getInstance()->executeS(
            $sql = 'SELECT `id_rbthemedream_home`
            FROM `'._DB_PREFIX_.'rbthemedream_home`
            WHERE 1'
        );

        if (!empty($homes)) {
            foreach ($homes as $home) {
                $obj_home = new RbthemedreamHome($home['id_rbthemedream_home'], 1);
                $data = $obj_home->data;
                $name_home = $obj_home->name;

                Db::getInstance()->execute(
                    'DELETE FROM `'._DB_PREFIX_.'rbthemedream_home_lang`
                    WHERE `id_rbthemedream_home` = ' . (int)$home['id_rbthemedream_home']
                );

                $new_obj = new RbthemedreamHome($home['id_rbthemedream_home']);
                $langs = Language::getLanguages(false);

                foreach ($langs as $l) {
                    $new_obj->data[$l['id_lang']] = $data;
                    $new_obj->name[$l['id_lang']] = $name_home;
                }

                $new_obj->update();
            }
        }
    }

    public function createHeader($key, $value)
    {
        $header = _PS_MODULE_DIR_.'rbthemedream/header.php';
        $content = '<?php';
        $content .= "\n";
        $content .= 'hea'.'der';
        $content .= "('";
        $content .= $key;
        $content .= ': ';
        $content .= $value;
        $content .= "');";
        $fp = fopen($header, 'w');
        fwrite($fp, $content);
        fclose($fp);
    }
}
