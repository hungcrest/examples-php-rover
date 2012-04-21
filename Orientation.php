<?php
// $Id$

/**
 * Orientation Class
 * 
 * This is constant class
 *
 * @author carlos.hung
 * 
 */
class Orientation
{
    const North = 'N';
    const South = 'S';
    const East  = 'E';
    const West  = 'W';

    // ensures that this class acts like an enum
    // and that it cannot be instantiated
    private function __construct() {}   
}
