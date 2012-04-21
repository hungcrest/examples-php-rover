<?php
// $Id$

/**
 * Command Class
 * 
 * This is constant class
 * 
 * @author carlos.hung
 * 
 */
class Command
{
    const Left  = 'L';
    const Right = 'R';
    const Move  = 'M';

    // ensures that this class acts like an enum
    // and that it cannot be instantiated
    private function __construct() {}   
}
