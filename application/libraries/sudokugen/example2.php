<?php

include_once("class.Sudoku.php") ;

/**
 * @author Dick Munroe <munroe@csworks.com>
 * @copyright copyright @ 2005 by Dick Munroe, Cottage Software Works, Inc.
 * @license http://www.csworks.com/publications/ModifiedNetBSD.html
 * @package SudokuExample
 *
 * Generate a puzzle and print the initial position and the solution.
 */
echo "its submitted";
$p = new Sudoku() ;

$theInitialPosition = $p->generatePuzzle(10) ;

$i = new Sudoku() ;

$i->initializePuzzleFromArray($theInitialPosition) ;

$numbers = $i->printSolution();
// echo "<pre>";
// var_dump($i);
// echo "</pre>";
$numbers =  $p->printSolution();
// var_dump($p);
// echo($numbers);
// var_dump($numbers);

?>