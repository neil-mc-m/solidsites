<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 27/10/2017
 * Time: 22:43
 */

namespace Solidsites;

class IniConfig implements ConfigInterface
{
    protected $file;
    public function __construct($file)
    {
        $this->file = $file;
    }
    public function parse()
    {
        $config = parse_ini_file($this->file, true);
        return $config;
    }
}
