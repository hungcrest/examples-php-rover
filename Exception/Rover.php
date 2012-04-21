<?php
// $Id$

/**
 * Rover Exception
 *
 * @author carlos.hung
 * 
 */
class Exception_Rover extends Exception
{
    /**
     * Constructor
     * 
     * Force message to be required rather than optional as defined in the default constructor
     * 
     * @param $message
     * @param $code
     */
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    /**
     * Customize object display
     */
    public function __toString() {
        return "ERROR - {$this->message}\n";
    }    
}