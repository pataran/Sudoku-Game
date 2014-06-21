
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title id='title'>Sudoku</title>
    
     <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dropit.css"/>
     <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/sudokucss.css">
 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="/assets/js/dropit.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.jplayer.min.js"></script>
	<script src="<?=base_url()?>assets/jqfloat/jqfloat.js"></script>
	<script src="<?=base_url()?>assets/spritely-master/src/jquery.spritely.js"></script>
	



	<script type="text/javascript">
$(document).ready(function()
{
 $('.menu').dropit();
 $('.background').dropit();
$('.fallingleaves').hide();
$('.fallingleaves').fadeIn( 40000, function() {
   		 // Animation complete
 		 });

////Cursor/////
document.getElementById("sudokuboard").style.cursor="pointer";

$('#error_message').hide();


///////////Drop Behavior for Hints/////
$( '#gridcontainer' ).droppable({
  drop: function( event, ui ) {
  	
  		 $('body').append('<embed src="/assets/drop.mp3" autostart="true" hidden="true" loop="false">');
  }
});



////AJAX CALL FOR SOLUTION CHECK/////////
	$("#sudokuconstructor").on('submit', function()
	{
  			$("#error_message").html("");
			var form = $(this);
	 		$.post(
		 		$(this).attr('action'),
		 		$(this).serialize(),
		 		function(data)
		 		{
		 			$('#error_message').css('display','inline-block')

		 		if(data.lose){
		 			$("#error_message").prepend(data.lose);
		 			$('#error_message').effect("highlight",300);
		 			$('body').append('<embed src="/assets/fail.mp3" autostart="true" hidden="true" loop="false">');
		 			setTimeout(function() 
		 			{
    					$('#error_message').effect("explode",300);
					}, 3000);
				}else
				{
					$("#error_message").prepend(data.win);
					$('#error_message').effect("highlight",300);
					$('body').append('<embed src="/assets/gong.mp3" autostart="true" hidden="true" loop="false">');
					$( "#sudokuboard" ).fadeOut( 10000, function() {});
    					$(".cell").fadeOut( 10000, function() {});
					setTimeout(function() 
					{
    					$('#error_message').effect("explode",3000);
					}, 10000);
				}
				}, 
			
				"json");
				return false;
	 });


	 $('#easy').click(function(){
	 	
	 	
	 	window.location = '/user/sudokufront/easy';
	 
	 		
	 });

	 $('#medium').click(function(){
	 	// alert('medium');	
	 	window.location = '/user/sudokufront/medium';
	 	});


	 $('#hard').click(function(){
	 	// alert('hard');
	 		
	 	window.location = '/user/sudokufront/hard';
	 		
	 	});
	 		

	 

// 
///Duck Animations	
     	 
	$('#ducks').sprite({fps: 12, no_of_frames: 7, play_frames: 30})   
	    $( "#ducks").animate({
	    opacity: 0,
	    left: "1800",
	    // height: "toggle"
	 	 }, 5000, function() {
	    // Animation complete.
	  	});
//////Butterfly/////
	$('#butterfly').jqFloat({
  		speed: 3000
  	}); 
  	$('#butterfly2').jqFloat({
  		speed: 3000
  	}); 


///////Mark table and Hints////
// $('#hinttable').draggable(); 
	$('.hintcell').draggable({
	    helper: "clone"
		}).on('dragstart', function (e, ui) {
	    $(ui.helper).css('z-index','999999');
		}).on('dragstop', function (e, ui) {
	    $(this).after($(ui.helper).clone().draggable());
	});
	
////////Setting Up Board Intro/////////
		$("#sudokuboard").hide();
		$(".smallcell").hide();
		$("#sudokuboard").fadeIn( 1000, function() {
  		  // Animation complete
  		});    

		$(".smallcell").fadeIn( 3000, function() {
   		 // Animation complete
 		 });

///Setting up listener and logic for bluesquare/////
	 $('.blue').click(function(){
		 // $('body').append('<embed src="/assets/click.mp3" autostart="true" hidden="true" loop="false">hihi');

	 		///Cell Selection Logic/////////
	   		var number_total = 0;
	   		if(parseInt($(this).children('p').text()))
	  	 		number_total = parseInt($(this).children('p').text());
	  	 		$(this).effect("highlight",300);
		  	 if(number_total < 9)
		  	 {
		   	 	number_total++;
		   		$(this).children('input[type=hidden]').val(number_total);
		    	$(this).children('p').html(number_total);
		     }
		     else
		     {
		   		 $(this).children('input[type=hidden]').val(0);
		     	 $(this).children('p').html("&nbsp;");
		    	 number_total = 0;
		     }
  	  });
   			
////TIME COUNTER///////////
	var c =0;
	var timer_on = true;
	function displayCount() 
	{
	  console.log(c);
      $('#timer').append(c);
	}
	function count() {
	    if(timer_on) 
	    {
	        c=c+1;
	         $('#timer').html(" ");
	        displayCount();
	    }
	}
	var interval = setInterval(count,1000);

/////////////Plays Music/////////
      $("#jquery_jplayer_1").jPlayer({
        ready: function() {
          $(this).jPlayer("setMedia", {
            mp3: "https://dl-web.dropbox.com/get/Public/zen.mp3?w=AAAk1Fiib11Zt1msqXGEUvjZG4zQmYL5DhyFnl98ji_h4A"
	          }).jPlayer("play");
	          var click = document.ontouchstart === undefined ? 'click' : 'touchstart';
	          var kickoff = function () {
            $("#jquery_jplayer_1").jPlayer("play");
            document.documentElement.removeEventListener(click, kickoff, true);
          };
          document.documentElement.addEventListener(click, kickoff, true);
        },
        loop: true,
        swfPath: "/js"
      });

//////////////BackgroundChanger/////
$("#bird").on('click', function()
{

      		$('#wrapper').attr('class', "bird");
      	
   });
$("#tree").on('click', function()
{

      		$('#wrapper').attr('class', "tree");
      	
   });
$("#paper").on('click', function()
{

      		$('#wrapper').attr('class', "paper");
      	
   });
$("#fight").on('click', function()
{

      		$('#wrapper').attr('class', "fight");
      	
   });

});
</script>

</head>

<body>
	<audio controls>
	  <source src="/assets/click.mp3" type="audio/mpeg">
 	</audio>

	<div id="wrapper" class="tree">
		<form action ="/user/logout" method="post" name="logout" class="logout_form">
			<input id="log_out" class="buttons" type="submit" value="Log Out">
		</form>


	<ul class="menu difficulty ">
    <li>
        <a href="#">Difficulty</a>
        <ul class ="minibar">
            <li id="easy"><a class ="strokeme" href="#">Easy</a></li>
            <li id='medium'><a class ="strokeme" href="#">Medium</a></li>
            <li id="hard"><a class ="strokeme" href="#">Hard</a></li>
        </ul>
    </li>
</ul>

	<ul class="background dropit ">
    <li>
        <a href="#">Backgrounds</a>
        <ul class ="minibar">
            <li id="paper"><a class ="strokeme" href="#">Paper</a></li>
            <li id='tree'><a class ="strokeme" href="#">Fall</a></li>
            <li id="bird"><a class ="strokeme" href="#">Snow</a></li>
            <li id="fight"><a class ="strokeme" href="#">Duel</a></li>
        </ul>
    </li>
</ul>
		
<div id="timer"></div>
<img id="butterfly" src="<?=base_url()?>assets/butterfly.gif" width="50" height="50"/>
<img id="butterfly2" src="<?=base_url()?>assets/butterfly.gif" width="50" height="50"/>
<div class="fallingLeaves">

	
	
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span></div>
	

<!-- The duck -->
	<div id="ducks"></div>
<!-- 	music player div -->
	<div id="jquery_jplayer_1"></div>

<div id="sudokuboard">
   <div id='gridcontainer'>
<?php 

////Check if puzzle generated is valid!!!////

foreach($data['solution'] as $value){
	if(!(is_numeric($value)))
		{
			header('location: /user/sudokufront');
		}
}

///////////CONSTRUCT PUZZLE/////////////////////
		// var_dump($data['puzzle']);
		echo "<form id='sudokuconstructor' action='/user/sudoku_check' method='post'>";
		foreach($data["puzzle"] as $key1=>$value)
		{
				if(!(is_numeric($value))) 
				{	
					echo "<div class='{$key1} smallcell blue japan_write unselectable'>";
					echo "<p class= 'num'>{$value}</p>";
				    echo "<input type='hidden' name='line[{$key1}]' value = '{$value}'>";
					echo "</div>";
				}
				else
				{
					echo "<div class='{$key1} smallcell yellow japan_write'>";
					echo "<input type='hidden' name='line[{$key1}]' value = '{$value}'>";
					echo $value;
					echo "</div>";	
				}
		}
		echo "<input id = 'check' type = 'submit' value='Check'>";
		echo "</form>";

		echo "<div id='error_message'></div>";

		///////Create Hints///////
		echo "<div id='hinttable'>";
		for($i = 9; $i >= 1; $i--)
		{
		echo "<div class='hintcell'>$i</div>";
		}	
		echo "</div>";

?>
		</div>	
	</div>
</div>
</body>
</html>