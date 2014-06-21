<?php
* @author Anush Prem <goku.anush@gmail.com>
* @package Solver
* @subpackage Sudoku
* @version 0.1
*/
 
/**
* <i>Sudoku Solver</i> class
* 
* This class solves the sudoku in my own logic.
*
* This solver takes time to execute according to the 
* complexity of the sudoku.
*
* @author Anush Prem <goku.anush@gmail.com>
* @package Solver
* @subpackage Sudoku
* @version 0.1
*/
 
	Class SudokuSolver{
	
		/**
		* To store the input Sudoku
		* @access private
		* @var array $_input row == column mapping
		*/
		private $_input;
		
		/**
		* To store the currently solved sudoku at any moment of time
		* @access private
		* @var array $_currentSudoku row == column mapping
		*/
		private $_currentSudoku;
		
		/**
		* To store the probable values for each cell
		* @access private
		* @var array $_probable [row][col] == possible values array mapping
		*/
		private $_probable;
		
		/**
		* to store weather the sudoku have been solved or not
		* @access private
		* @var bool
		*/
		private $_solved = false;
		
		/**
		* store weather each cell is solved or not
		* @access private
		* @var array $_solvedParts row == column (bool) values
		*/
		private $_solvedParts = array (
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false ),
			array ( false, false, false, false, false, false, false, false, false )
		);
		
		/**
		* SudokuSolver constructor
		*
		* If the input sudoku is provided it will store to the {@link _input} property.
		* 
		* @access public
		* @param array $input row == column mapping
		* @return void
		*/
		public function __construct($input = null){
			
			// check if the input sudoku is provided, if yes then
			// store it in $_input
			if ( $input !== null ) $this -> _input = $input;
		}
		
		/**
		* Input Method
		*
		* Explictly give a new input array if its not already provided in 
		* the constructor. If already provieded in the constructore then
		* it will be replaced
		*
		* @access public
		* @param array $input row == column mapping
		* @return void
		*/
		public function input($input){
			
			// store the received input into $_input
			$this -> _input = $input;
		}
		
		/**
		* Solve Method
		*
		* The main function to start solving the sudoku and return the
		* solved sudoku
		*
		* @access public
		* @return array row == column mapping of solved sudoku
		*/
		public function solve (){
		
			// Copy the input sudoku to _currentSudoku
			$this -> _currentSudoku = $this -> _input;
			
			// update _solvedParts of the given sudoku
			$this -> _updateSolved ();
			
			// Start solving the sudoku
			$this -> _solveSudoku();
			
			// return the solved sudoku
			return $this -> _currentSudoku;
		}
		
		/**
		* updateSolved Method
		*
		* Update the _solvedParts array to match the values of 
		* _currentSudoku.
		*
		* @access private
		* @return void
		*/
		private function _updateSolved(){
			
			// loop for rows
			for ($i = 0; $i < 9; $i++ )
			
				// loop for columns
				for ($j = 0; $j < 9; $j++ )
				
					// if the value exists for the corresponding row, column
					// then update the _solvedParts corresponding row, column
					// to true
					if ( $this -> _currentSudoku[$i][$j] != 0 )
						$this -> _solvedParts[$i][$j] = true;
		}
		
		/**
		* _solveSudoku Method
		*
		* Main sudoku solving method
		*
		* @access private
		* @return void
		*/
		private function _solveSudoku(){
			
			// continue running untill the sudoku is completly solved
			do{
				// calculate the probable values for each cell an solve 
				// available cells
				$this -> _calculateProbabilityAndSolve();
				
				// check weather the sudoku is completly solved
				$this -> _checkAllSolved();
			}while (!$this -> _solved); // run till the _solved value becomes true
			
		}
		
		/**
		* _calculateProbabilityAndSolve Method
		*
		* Find the possible values for each cell and
		* solve it if possible
		*
		* @access private
		* @return void
		*/
		private function _calculateProbabilityAndSolve(){
			
			// find possible values for each cell
			$this -> _findPosibilites();
			
			// check if each cell is solveable and if yes solve it
			$this -> _solvePossible();
			
		}
		
		/**
		* _findPosibilites Method
		*
		* Find possible values for each cell
		*
		* @access private
		* @return void
		*/
		private function _findPosibilites(){
		
			// loop for rows
			for ($i = 0; $i < 9; $i++ ){
			
				// loop for columns
				for ($j = 0; $j < 9; $j++ ){
					
					// if the ixj cell is not solved yet
					if ( !$this -> _solvedParts[$i][$j] ){
						
						// find all possible values for cell ixj
						$this -> _findAllProbables ($i, $j);
					}
				}
			}
		}
		
		/**
		* _solvePossible Method
		*
		* Solve possible cells using probable values calculated
		*
		* @access private
		* @return void
		*/
		private function _solvePossible(){
		
			// loop for rows
			for ($i = 0; $i < 9; $i++ ){
			
				// loop for column
				for ($j = 0; $j < 9; $j++ ){
					
					// if cell ixj is not solved yet
					if ( !$this -> _solvedParts[$i][$j] ){
						
						// solve the cell ixj if possible using probable values
						// calculated
						$this -> _solveIfSolveable ($i, $j);
					}
				}
			}
		}
		
		/**
		* _checkAllSolved Method
		*
		* check if all the cells have been solved
		*
		* @access private
		* @return void
		*/
		private function _checkAllSolved(){
		
			// pre assign all solved as true
			$allSolved = true;
			
			// loop for rows
			for ($i = 0; $i < 9; $i++ ){
			
				// loop for columns
				for ($j = 0; $j < 9; $j++ ){
				
					// if allSolved is still true an the cell iXj is not
					if ( $allSolved and !$this -> _solvedParts[$i][$j] ){
						// set all solved as false
						$allSolved = false;
					}
				}
			}
			
			// copy the value of allSolved into _solved.
			$this -> _solved = $allSolved;
		}
		
		/**
		* _solveIfSolveable Method
		*
		* Solve a single cell $rowx$col if it is solveable using
		* available probable datas
		*
		* @access private
		* @param int $row 0-8
		* @param int $col 0-8
		* @return bool
		*/
		private function _solveIfSolveable ($row, $col){
			
			// if there is only one probable value for the cell $rowx$col
			if ( count ($this -> _probable[$row][$col]) == 1 ){
				
				// copy the only possible value to $value
				$value = $this -> _probable[$row][$col][0];
				
				// set the value of cell $rowx$col as $value an update solvedParts
				$this -> _setValueForCell ($row, $col, $value);
				
				// return true as solved
				return true;
			}
			
			// pre assign $value as 0. ie; not solved
			$value = 0;
			
			// loop through all the possible values for $row x $col
			// and check if any possiblity can be extracted from it
			// by checking if its possible for the same number to be
			// positioned anywhere else thus confilicting with current
			// cell. If a possibility is not a possibility for any other
			// cell in the confilicting places then it is the value for 
			// current cell
			foreach ($this -> _probable[$row][$col] as $possible){
			
				// a try-catch exception handling used here
				// as a control statement for continuing the main loop 
				// if a value is possible in some place.
				try{
				
					// loop through the current column
					for ($i = 0; $i < 9; $i++ ){
						// if the cell is solved continue the loop
						if ($this -> _currentSudoku[$i][$col] != 0)
							continue;
						
						// if the possible is also possible in the $i x $col cell
						// then throw a ContinueException to continue the outer loop
						if (in_array($possible, $this -> _probable[$i][$col]))
							throw new ContinueException ("Exists");
						
					}
					
					// loop through the current row
					for ($i = 0; $i < 9; $i++ ){
						// if the cell is solved continue the loop
						if ($this -> _currentSudoku[$row][$i] != 0)
							continue;
						
						// if the possible is also possible in the $i x $col cell
						// then throw a ContinueException to continue the outer loop
						if (in_array($possible, $this -> _probable[$row][$i]))
							throw new ContinueException ("Exists");
						
					}
					
					// find the start of the 3x3 grid with $row x $col cell
					$gridRowStart = $this -> _findGridStart($row);
					$gridColStart = $this -> _findGridStart($col);
					
					// loop row through the current 3x3 grid
					for ($i = $gridRowStart; $i < $gridRowStart + 3; $i++){
						
						// loop column through the current 3x3 gri
						for ($j = $gridColStart; $j < $gridColStart + 3; $j++){
						
							// if its the current $row x $col cell then 
							// continue the loop
							if ($i == $row && $j == $col ) 
								continue; 
								
							// if the cell is already solved then 
							// continue the loop
							if ($this -> _currentSudoku[$row][$i] != 0)
								continue;
 
							// if the possible is also possible in the 
							// $i x $j cell then throw a ContinueException
							// to continue the outer loop
							if (in_array($possible, $this -> _probable[$i][$j]))
								throw new ContinueException ("Exists");
						}
					}
					
					// if the loop is not continued yet,
					// then that means this possible value is
					// not possible in any other conflicting 
					// cells. So assign the value of $value to 
					// $possible and break the loop.
					$value = $possible;
					break;
				}catch (ContinueException $e){
					// if a ContinueException is thrown then contine
					// the outer loop
					continue;
				}
			}
			
			// if the value of $value is not 0 then the value of 
			// the cell is $value.
			if ($value != 0){
				
				// set the value of cell $rowx$col as $value an update solvedParts
				$this -> _setValueForCell ($row, $col, $value);
				
				// return true as solved
				return true;
			}
			
			// return false as not solved yet.
			return false;
		}
		
		/**
		* _setValueForCell Method
		*
		* If a cell is solved then update the value for 
		* that cell, and also update the {@link _solvedParts}.
		*
		* @access private
		* @param int $row 0-8
		* @param int $col 0-8
		* @param int $value 1-9
		* @return void		
		*/
		private function _setValueForCell($row, $col, $value){
		
			// update the solved parts in _currentSudoku.
			$this -> _currentSudoku[$row][$col] = $value;
			
			// update the corresponding _solvedParts.
			$this -> _solvedParts[$row][$col] = true;
		}
		
		/**
		* _findAllProbables Method
		*
		* Find all possible values for any given cell using
		* other already solved or given cell values.
		*
		* @access private
		* @param int $row 0-8
		* @param int $col 0-8
		* @return void
		*/
		private function _findAllProbables ($row, $col){
		
			// initially set the $probable as array 1 to 9.
			$probable = range(1,9);
			
			// loop through current column
			for ($i = 0; $i < 9; $i++ )
			
				// if the cell $i x $col is solved and the value of
				// cell $ix$col is in the $probable array then remove
				// that element.
				if ( 
					( $current = $this -> _currentSudoku[$i][$col] ) != 0  
					and 
					( $key = array_search($current, $probable) ) !== false 
				)
					unset ($probable[$key]);
					
			// loop through the current row
			for ($i = 0; $i < 9; $i++ )
			
				// if the cell $row x $i is solved and the value of
				// cell $rowx$i is in the $probable array then remove
				// that element.
				if ( 
					( $current = $this -> _currentSudoku[$row][$i] ) != 0  
					and 
					( $key = array_search($current, $probable) ) !== false 
				)
					unset ($probable[$key]);
				
			// find the start of the 3x3 grid with $row x $col cell
			$gridRowStart = $this -> _findGridStart($row);
			$gridColStart = $this -> _findGridStart($col);
			
			// loop row through the current 3x3 grid
			for ($i = $gridRowStart; $i < $gridRowStart + 3; $i++)
			
				// loop column through the current 3x3 grid
				for ($j = $gridColStart; $j < $gridColStart + 3; $j++)
				
					// if the cell $i x $j is solved and the value of
					// cell $ix$j is in the $probable array then remove
					// that element.
					if ( 
						( $current = $this -> _currentSudoku[$i][$j] ) != 0  
						and 
						( $key = array_search($current, $probable) ) !== false 
					)
						unset ($probable[$key]);
				
			// Store the rest of the probable values to 
			// _probable[$row][$col]
			$this -> _probable[$row][$col] = array_values($probable);
			
		}
		
		/**
		* _findGridStart Method
		*
		* Find the start of the 3x3 grid in which the value
		* comes
		*
		* @access private
		* @param int $value 0-9
		* @return int
		*/
		private function _findGridStart ($value){
		
			// return the start of the current 3x3 grid
			return floor( $value / 3 ) * 3;
		}
	}
	
/**
* <i>ContinueException</i> class
* 
* Extends Exception. Used to throw exception for 
* continue the outer most loop.
* 
*/	
	Class ContinueException extends Exception{}
	?>