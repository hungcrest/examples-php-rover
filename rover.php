<?php
// $Id$

// Feature enhancements:
// Initially kept it simple by removing any dependency for needing any external libraries to run this program
// TODO: use Zend Auto Loader to auto load classes. Hence, require_once won't be needed

require_once 'Plateau.php';
require_once 'Robot.php';

/**
 * Main program for the Mars Rovers programming assignment
 * 
 * This code is robust and extensible/scalable
 * 
 * Assumptions made:
 * The plateau rectangular region is in Quadrant I; that is, both x and y are positive.
 * 
 * When an invalid input is supplied to a rover, only that rover won't move.
 * This means process good input, skip bad ones.
 *
 * @author carlos.hung
 * 
 */

$lines = file('input.txt');

foreach ($lines as $l) {
    // This is a gotcha!
    // Don't forget to strips '\n' & '\r' especially at the end of the line
    $line = trim($l);
    
    // skip blank lines
    if ($line == '') {
        continue;
    }
    
    $elm = explode(" ", $line);

    try {
        // handle the plateau's dimension
        if (count($elm) == 2) {
            // instance the singleton plateau
            $plateau = Plateau::getInstance($elm[0], $elm[1]);
        } 
        // handle the rover's position
        else if (count($elm) == 3) {
            $bSkip = false;
            $robot = new Robot($elm[0], $elm[1], $elm[2]);
        } 
        // handle the rover's commands
        else if (!$bSkip) {         
            echo $robot->explore($line) . "\n";
        }
    } catch (Exception_Plateau $e) {
        print($e);
        
        // fix error before we can continue
        break;
    } catch (Exception_Robot $e) {
        print($e);

        // skip next input line; this rover's commands
        $bSkip = true;
    } catch (Exception_Command $e) {
        print($e);
    }
}
?>