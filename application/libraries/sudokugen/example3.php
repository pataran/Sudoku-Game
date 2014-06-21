<?php

include_once("class.Sudoku.php") ;

/**
 * @author Dick Munroe <munroe@csworks.com>
 * @copyright copyright @ 2005 by Dick Munroe, Cottage Software Works, Inc.
 * @license http://www.csworks.com/publications/ModifiedNetBSD.html
 * @package SudokuExample
 *
 * Test the difficulty level logic in the puzzle generator.  By default,
 * the puzzle generator returns maximal difficulty puzzles.
 */

mt_srand(101) ;

$p = new Sudoku() ;

$theInitialPosition = $p->generatePuzzle() ;

$i = new Sudoku() ;

$i->initializePuzzleFromArray($theInitialPosition) ;

$i->printSolution() ;

$p->printSolution() ;

mt_srand(101) ;

$p = new Sudoku() ;

$theInitialPosition = $p->generatePuzzle(1) ;

$i = new Sudoku() ;

$i->initializePuzzleFromArray($theInitialPosition) ;

$i->printSolution() ;

$p->printSolution() ;
?>