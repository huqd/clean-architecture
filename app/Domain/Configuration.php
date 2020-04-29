<?php

namespace App\Domain;

class Configuration
{
    /**
     * Singleton
     */
    private $init;
    private static $instance = null;

    private function __construct()
    {
        $file = dirname(__FILE__) . '/../../config.ini';
        $this->init = parse_ini_file($file);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Configuration();
        }

        return self::$instance;
    }

    public function getWeightCoefficient()
    {
        return (float) $this->init['weight_coefficient'];
    }

    public function getDimensionCoefficient()
    {
        return (float) $this->init['dimension_coefficient'];
    }

    public function getInToMeter()
    {
        return (float) $this->init['inche_to_meter'];
    }

    public function getPToKg()
    {
        return (float) $this->init['pound_to_kg'];
    }

    public function getOToKg()
    {
        return (float) $this->init['ounce_to_kg'];
    }
}
