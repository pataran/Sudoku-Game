<?php

include_once("class.Sudoku.php") ;

/**
 * @author Dick Munroe <munroe@csworks.com>
 * @copyright copyright @ 2005 by Dick Munroe, Cottage Software Works, Inc.
 * @license http://www.csworks.com/publications/ModifiedNetBSD.html
 * @package SudokuExample
 *
 * Solve a puzzle, showing the steps taken by the puzzle solver.  The
 * puzzle is initialized from stdin.  The input file consists of triple,
 * one per line, whitespace separated, of the form:
 *
 * row column value
 *
 * where row, column, and value are in the range 1..9.
 */

//
// Edit History:
//
//  Dick Munroe (munroe@csworks.com) 12-Nov-2005
//      Windows doesn't do redirection properly (or at least PHP on Windows doesn't
//      do it right) so if an argument is provided, the argument is the name of
//      the puzzle initialization file.
//

$p = new SudokuIntermediateSolution() ;

if ($_SERVER["argc"] > 1)
{
    $p->initializePuzzleFromFile($_SERVER["argv"][1]) ;
}
else
{
    $p->initializePuzzleFromFile() ;
}

$p->solve() ;

$p->printSolution() ;

?>