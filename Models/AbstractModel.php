<?php

namespace XssBadWebApp\Models;

use XssBadWebApp\Utilities\DataFile;

abstract class AbstractModel {
    
    protected static $dataFile = null;
    protected static $modelName = '';
    
    protected $id = '';
    protected $name = '';
    protected $location = '';
    protected $greeting = '';
    
    /**
     *
     * @return \XssBadWebApp\Utilities\DataFile The data file
     */
    public static function getDataFile() {
        if (is_null(static::$dataFile)) {
            static::$dataFile = new DataFile(static::$modelName);
        }
        return static::$dataFile;
    }
    
    public static function has($id) {
        return static::load($id)->getId() == $id;
    }
    
    public static function load($id) {
        $model = null;
        if ($id) {
            $model = static::getDataFile()->get($id);
        }
        return $model ? $model : new static;
    }
    
    public static function loadAll($dir = 1) {
        $all = static::getDataFile()->getAll();
        usort(
            $all,
            function($a, $b) use ($dir) {
                if ($a->getId() == $b->getId()) {
                    return 0;
                }
                return ($a->getId() < $b->getId()) ? -1 * $dir : $dir;
            }
        );
        return $all;
    }
    
    abstract public function asArray();

    abstract public function getId();
    
    public function save() {
        static::getDataFile()->set($this->getId(), $this);
    }

}