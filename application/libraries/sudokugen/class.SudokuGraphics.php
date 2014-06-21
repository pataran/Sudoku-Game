<?php

include_once("class.Sudoku.php") ;

/**
 * @author Dick Munroe <munroe@csworks.com>
 * @copyright copyright @ 2005 by Dick Munroe, Cottage Software Works, Inc.
 * @license http://www.csworks.com/publications/ModifiedNetBSD.html
 * @version 1.0.0
 * @package Sudoku
 */

/**
 * Generate graphic output of Sudoku.
 */

class SudokuGraphics extends Sudoku
{
    var $copyright = 11 ;
    var $grid = 20 ;
    var $height = 190 ;
    var $width = 190 ;
    var $size = 15 ;
    
    function SudokuGraphics($grid = 41)
    {
        $this->height = $grid * 9 + 10 ;
        $this->width = $grid * 9 + 10 ;
        $this->grid = $grid ;
        
        $this -> Sudoku() ;
    }
    
    /**
     * Print the solution in graphical form.
     * 
     * @access public
     * @param string $font [optional] the [path to the] font to be used to output the Sudoku.
     * @param string $type [optional] the type of the image produced (jpeg, gif, or png).
     */

    function printSolutionAsGraphic($font = "msttcorefonts/Arial", $type = "png")
    {
 	$image = ImageCreate($this -> width, $this -> height + $this->copyright) or die("Cannot Initialize new GD image stream");
		
	// colors
        
	$background_color = ImageColorAllocate($image, 240, 240, 240);
	$lineColor = ImageColorAllocate($image, 0, 0, 0);
	$stringColor = ImageColorAllocate($image, 0, 0, 0);

        ImageLine($image, 0, 0, $this->width, 0, $lineColor) ;
	for ($i = 0; $i <= 10; $i++)
        {
            ImageLine($image, 0, $i * $this->grid + $i, $this->width, $i * $this->grid + $i, $lineColor) ; // Horizontal
            ImageLine($image, $i * $this->grid + $i, 0, $i * $this->grid + $i, $this->height - 1, $lineColor) ; // Vertical
        }
        
        /*
        ** Thicken the lines on the squares.
        */
        
        for ($i = 1; $i < 3; $i++)
        {
            $j = $i * 3 ;
            ImageLine($image, 0, $j * $this->grid + $j + 1, $this->width, $j * $this->grid + $j + 1, $lineColor) ; // Horizontal
            ImageLine($image, $j * $this->grid + $j - 1, 0, $j * $this->grid + $j - 1, $this->height - 1, $lineColor) ; // Vertical
        }

        $deltaX = (int)(($this->grid - $this->size) / 2) ;
        $deltaY = (int)(($this->grid - $this->size) / 2) ;
        
        for ($i = 1; $i <= 9; $i++)
        {
            for ($j = 1; $j <= 9; $j++)
            {
                ImageTTFText($image, (float)$this->size, 0, ($j - 1) * $this->grid + $j + $deltaX,
                                                            ($i) * $this->grid + $i - $deltaY,
                             $stringColor, $font, $this->theBoard[$i][$j]->asString()) ;
            }
        }
        
        ImageTTFText($image, (float)7, 0, 0, $this->height + $this->copyright - 2, $stringColor, $font, "Copyright @ " . date("Y") .", Dick Munroe (munroe@csworks.com), Cottage Software Works, Inc.") ;

	switch ($type)
        {
            case 'jpeg': imagejpeg($image); break;
	    case 'png':  imagepng($image);  break;
	    case 'gif':  imagegif($image);  break;
	    default:     imagepng($image);  break;
	}
    }
}
?>