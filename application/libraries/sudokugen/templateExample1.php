<?php

include_once "class.Sudoku.php" ;

$p = new SudokuTemplates() ;

$theInitialState = $p->generatePuzzleFromFile() ;

$i = new Sudoku() ;

$i->initializePuzzleFromArray($theInitialState) ;

$i->printSolution() ;

$p->printSolution() ;

?>