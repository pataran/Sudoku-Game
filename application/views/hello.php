<html>
<head>
<link rel="stylesheet" media="screen" type="text/css" href="<?=base_url()?>assets/css.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/jqfloat/jqfloat.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.jplayer.min.js"></script>
<script src="<?=base_url()?>assets/spritely-master/src/jquery.spritely.js"></script>
<script>
$( document ).ready(function() {

	$("#artwork").hide();
	$("#artwork").fadeIn( 3000, function() {
  	  // Animation complete
  	});   

  	$(".japan_write").hide();
 $( ".japan_write" ).slideDown( 3000, function() {
    // Animation complete.
  }); 
  	
  	$(".japan_write").fadeIn( 5000, function() {
  	  // Animation complete
  	}); 
  	$('#butterfly').jqFloat({
  		speed: 3000
  	}); 
  	

  	


    

  	$("#login").on('submit', function(){
  			$("#posts").html("");
			var form = $(this);
	 		$.post(
		 		$(this).attr('action'),
		 		$(this).serialize(),
		 		function(data)
		 		{	
		 			if(data.email){
		 				// alert(<?=base_url('user/sudokufront')?>);
		 			window.location = '/user/sudokufront/medium';
		 			 // '/user/sudokufront';
		 			// 'user/generate_sudoku';
		 			// 
		 			}
		 			else{	
		 				$("#posts").prepend(data);
		 			}
				}, "json");
				return false;
	 		});
  	

  	$("#register").on('submit', function(){
  			$("#posts").html("");
			var form = $(this);
	 		$.post(
		 		$(this).attr('action'),
		 		$(this).serialize(),
		 		function(data)
		 		{
		 			console.log(data);
		 			$("#posts").prepend(data);

				}, "json");
				return false;
	 		});



//////music////////////////
  	  $("#jquery_jplayer_1").jPlayer({
        ready: function() {
          $(this).jPlayer("setMedia", {
            mp3: "https://dl-web.dropbox.com/get/Public/Music%20Zen%20Garden.mp3?w=AADFd6IXiQm8udbdkcEfzwgdZPGD7ARv875Ub2kW9WL3dQ"
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
});

</script>
</head>
<body>
	<div id="jquery_jplayer_1"></div>
<div id = "artwork">
	<div id="posts"></div>
<img id="butterfly" src="<?=base_url()?>assets/butterfly.gif" width="200" height="200"/>
<p class="japan_write" id="title"> Sudoku </p>
<div id="login_div"class ="japan_write">
<h1>Log In</h1>
<form id="login" action="user/login_process" method="post"><br>
<label>Email</label>
<input type="text" name="email"><br>
<label>Password</label>
<input type="text" name="password"><br>
<input type="submit" name="submit" value="login" >
</form>	
</div>

<div id="register_div" class ="japan_write">
<h1>Register</h1>
<form id="register" action="user/register_action"  method="post">
 <input type="hidden" name="register" value="register"> 
<label>First Name</label>
<input type="text" name="first_name"><br>
<label>Last Name</label>
<input type="text" name="last_name"><br>
<label>Password</label>
<input type="password" name="password"><br>
<label>Repeat Password</label>
<input type="repeat password" name="repeat_password"><br>
<label>Email</label>
<input type="text" name="email"><br>
<input type="submit" name="submit" value="register">
</form>	
</div>

</div>


</body>
</html>