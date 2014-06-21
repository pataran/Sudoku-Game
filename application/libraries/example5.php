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
 *
 * This is specifically a test of the "ambiguous" sudoku clues contained
 * in puzzle4.txt.  Personally I don't feel that a set of sudoku clues
 * that require you to guess at a solution are legal, but I'm providing
 * this interface since Ghica van Emde Boas (author of another Sudoku
 * related class) raised the possibility.
 */

//
// Edit History:
//
//  Dick Munroe (munroe@csworks.com) 15-Nov-2005
//      Initial Version Creatd.
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

/*
 * If a deductive approach fails, brute force the rest of the solution.
 */

if (!$p->solve())
{
    $x = $p->solveBruteForce() ;
    
    var_dump($x) ;
}

$p->printSolution() ;

?>