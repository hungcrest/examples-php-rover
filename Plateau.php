<?php
// $Id$

require_once 'Exception/Plateau.php';

/**
 * Plateau Class
 * 
 * This is a singleton class
 * 
 * @author carlos.hung
 * 
 */
class Plateau
{
    const LowerX = 0;
    const LowerY = 0;
    
    private $_upperX = 0;
    private $_upperY = 0;
    private static $_instance = null;
    
    /**
     * Constructor 
     * 
     * @param $aUpperX
     * @param $aUpperY
     */
    private function __construct($aUpperX, $aUpperY)
    {
        $this->_upperX = $aUpperX;
        $this->_upperY = $aUpperY;
    }
    
    /**
     * Validate upper (x,y) coordinates
     * 
     * @param $aUpperX
     * @param $aUpperY
     */
    private static function _validate($aUpperX, $aUpperY)
    {
        if ($aUpperX < 0 || $aUpperY < 0) {
            throw new Exception_Plateau("The plateau's (x,y) coordinates of ({$aUpperX},{$aUpperY}) must be >= (0,0)");
        }
    }
    
    /**
     * Get this singleton class instance
     * 
     * @param $aUpperX
     * @param $aUpperY
     * @return $instance
     */
    public static function getInstance($aUpperX = 0, $aUpperY = 0)
    {
        self::_validate($aUpperX, $aUpperY);
        
        if (self::$_instance === null) {
            self::$_instance = new self($aUpperX, $aUpperY);
        }
        
        return self::$_instance;
    }
    
    /**
     * Is on upper X boundary
     * 
     * @param $aX
     * @return boolean
     */
    public function isOnUpperX($aX) 
    {
        return $aX == $this->_upperX ? true : false;
    }
    
    /**
     * Is on upper Y boundary
     * 
     * @param $aY
     * @return  boolean
     */
    public function isOnUpperY($aY)
    {
        return $aY == $this->_upperY ? true : false;
    }
    
    /**
     * Is on lower X boundary
     * 
     * @param $aX
     * @return boolean
     */
    public function isOnLowerX($aX) 
    {
        return $aX == self::LowerX ? true : false;
    }
    
    /**
     * Is on lower Y boundary
     * 
     * @param $aY
     * @return boolean
     */
    public function isOnLowerY($aY)
    {
        return $aY == self::LowerY ? true : false;
    }    
  
}
