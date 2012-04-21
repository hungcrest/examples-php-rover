<?php
// $Id$

require_once 'Exception/Command.php';

/**
 * Direction Class
 * 
 * This class handles the rover's move
 * 
 * @author carlos.hung
 * 
 */
class Direction
{
    private $_x;
    private $_y;
    private $_orientation;
    
    // Define the new orientation after 90 degrees spin
    private $_spin = array(Orientation::North => array(Command::Left  => Orientation::West,
                                                       Command::Right => Orientation::East),
                           Orientation::South => array(Command::Left  => Orientation::East,
                                                       Command::Right => Orientation::West),
                           Orientation::East  => array(Command::Left  => Orientation::North,
                                                       Command::Right => Orientation::South),
                           Orientation::West  => array(Command::Left  => Orientation::South,
                                                       Command::Right => Orientation::North),
                      );

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
    }
    
    /**
     * Execute the next move: a step forward or backward or a spin
     * 
     * @param $aCommand
     * @return $position
     */
    public function execute($aCommands)
    {
        // get the plateau class instance
        $plateau = Plateau::getInstance();
                
        $commands = str_split(trim($aCommands));
        foreach ($commands as $command) {       
            switch ($command) {
                case Command::Left:
                case Command::Right:
                    $this->_orientation = $this->_spin[$this->_orientation][$command];
                    break;
                    
                case Command::Move:
                    // before moving the rover, check that it does not go 'out of bound'
                    // the rover must stay within the plateau boundaries
                    switch ($this->_orientation) {
                        case Orientation::North:
                            if (!$plateau->isOnUpperY($this->_y)) {
                                $this->_y += 1;
                            }
                            break;
                        case Orientation::South:
                            if (!$plateau->isOnLowerY($this->_y)) {
                                $this->_y -= 1;
                            }
                            break;
                        case Orientation::East:
                            if (!$plateau->isOnUpperX($this->_x)) {
                                $this->_x += 1;
                            }
                            break;
                        case Orientation::West:
                            if (!$plateau->isOnLowerX($this->_x)) {
                                $this->_x -= 1;
                            }
                            break;
                    }
                    break;
            }
        }

        // return the rover's new position
        return $this->_x . ' ' . $this->_y . ' ' . $this->_orientation;
    }

}
