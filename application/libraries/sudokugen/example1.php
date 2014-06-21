<?php

include_once("class.Sudoku.php") ;

/**
 * Generate a new puzzle.
 * 
 * During puzzle generation, show the steps taken by the puzzle generator.
 * Then initialize a new Sudoku from the solution provided and print
 * the initial position and the solution.
 * 
 * @author Dick Munroe <munroe@csworks.com>
 * @copyright copyright @ 2005 by Dick Munroe, Cottage Software Works, Inc.
 * @license http://www.csworks.com/publications/ModifiedNetBSD.html
 * @package SudokuExample
 */

$p = new SudokuIntermediateSolution() ;

$theInitialPosition = $p->generatePuzzle() ;

$p = new Sudoku() ;

$p->initializePuzzleFromArray($theInitialPosition) ;

$p->printSolution();



?>