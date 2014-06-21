<?php
class Sudoku {
        protected $hGrid = array();
        protected $vGrid = array();
        public function generate() {
                $this -> vGrid = $this -> hGrid = array();
                $numbers = range(1,9);
                for($x = 0; $x < 9; $x++) {
                        for($y = 0; $y < 9; $y++) {
                                $this -> hGrid[$x] = !isset($this -> hGrid[$x]) ? array() : $this -> hGrid[$x];
                                $this -> vGrid[$y] = !isset($this -> vGrid[$y]) ? array() : $this -> vGrid[$y];
                                $box = $this -> getbox($x,$y);
                                $options = array_diff($numbers,$this -> hGrid[$x],$this -> vGrid[$y],$box);
                                $key = array_rand($options);
                                if(!isset($options[$key])) {
                                        return $this -> generate();
                                }
                                $val = $options[$key];
                                $this -> hGrid[$x][$y] = $this -> vGrid[$y][$x] = $val;
                        }
                }
                return $this -> hGrid;
        }
        public function getbox($x,$y) {
                $right = ceil(($x + 1) / 3) * 3 - 1;
                $left = $right - 2;
                $bottom = ceil(($y + 1) / 3) * 3 - 1;
                $top = $bottom - 2;
                $box = array();
                for($x = $left; $x <= $right;$x++) {
                        for($y = $top; $y <= $bottom;$y++) {
                                if(isset($this -> hGrid[$x][$y])) {
                                        $box[] = $this -> hGrid[$x][$y];
                                }
                        }
                }
                return $box;
        }
}
$sudoku = new Sudoku();
$grid = $sudoku -> generate();
?>
 
<table cellpadding="2" cellspacing="0" border="2">
 
<?php foreach($grid as $row) : ?>
        <tr>
        <?php foreach($row as $val) : ?>
                <td width="20"><center><?php echo $val; ?></center></td>
        <?php endforeach; ?>
        </tr>
<?php endforeach; ?>
 
</table>


