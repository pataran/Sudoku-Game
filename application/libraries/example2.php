<?php
include_once("class.Sudoku.php") ;
class example2{
	function fuckmylife($difficulty){
	/**
	 * @author Dick Munroe <munroe@csworks.com>
	 * @copyright copyright @ 2005 by Dick Munroe, Cottage Software Works, Inc.
	 * @license http://www.csworks.com/publications/ModifiedNetBSD.html
	 * @package SudokuExample
	 *
	 * Generate a puzzle and print the initial position and the solution.
	 */
	// echo "its submitted";
	$numbers = array();
	$p = new Sudoku() ;
	$theInitialPosition = $p->generatePuzzle() ;
	if(empty($theInitialPosition))
	{
		$medium = "medium";
		
		$this->fuckmylife($medium);
		// $theInitialPosition = $p->generatePuzzle() ;
	}

	$i = new Sudoku() ;

	$i->initializePuzzleFromArray($theInitialPosition) ;

	$numbers['puzzle'] = $i->printSolution();
	// echo "<pre>";
	// var_dump($i);
	// echo "</pre>";
	$numbers['solution'] =  $p->printSolution();
	// var_dump($p);
	// echo($numbers);
$num = 0;
// var_dump($difficulty);
if($difficulty == "easy")
{
	$num = 40;
}elseif($difficulty == "medium")
{
	$num = 15;
}else
{
 $num = 1;
}

	  for($i = 1; $i < $num; $i++)
    {
    	$value = rand(1,80);
    	if(!(is_numeric($numbers['puzzle'])))
    	{
    	$numbers['puzzle'][$value] = $numbers['solution'][$value];
    	}
    }
	return $numbers;


	}
}
?>