<?php
// $Id$

require_once 'Direction.php';
require_once 'Orientation.php';
require_once 'Command.php';
require_once 'Exception/Robot.php';

/**
 * Robot Class
 *
 * @author carlos.hung
 *
 */
class Robot
{
    private $_x;
    private $_y;
    private $_orientation;
    
    private $_validOrient = array(Orientation::North, 
                                  Orientation::South, 
                                  Orientation::East, 
                                  Orientation::West);
    
    /**
     * Constructor
     * 
     * @param $aX
     * @param $aY
     * @param $aOrientation
     */
    public function __construct($aX, $aY, $aOrientation)
    {
        $this->_x = $aX;
        $this->_y = $aY;
        $this->_orientation = $aOrientation;
        
        $this->_validate();
    }

    /**
     * Validate rover's position
     */
    private function _validate()
    {
        if ($this->_x < 0 || $this->_y < 0) {
            throw new Exception_Robot("The rover's (x,y) coordinates of ({$this->_x},{$this->_y}) must be >= (0,0)");
        }

        if (!in_array($this->_orientation, $this->_validOrient)) {
            throw new Exception_Robot("The rover's position (x,y,orientation) of ({$this->_x},{$this->_y},{$this->_orientation}) " .
                                      "must have a valid orientation of 'N', 'S', 'E', 'W'");
        }
    }    
    
    /**
     * Explode the plateau
     * 
     * @param $aCommands
     * @return $position
     */
    public function explore($aCommands) 
    {
        $direction = new Direction($this->_x, $this->_y, $this->_orientation);
        
        return $direction->execute($aCommands);    
    }
 
}
