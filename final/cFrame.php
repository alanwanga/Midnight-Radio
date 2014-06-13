<?session_start();?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- <link href="cStyle.css" type="text/css" rel="stylesheet" /> -->
	<link href="cIphone.css" type="text/css" rel="stylesheet" />
</head>
<body style="background-color:transparents">
	<div id="ParaPublic" >
		<form id="sendPublic"  name="sendPublic">			 
		<table border="0" cellpadding="0" cellspacing="0" >
		  <tbody>
			<tr>
			  <td colspan="2" id="chat_output_td"  class="chat_output">
				<div id="chat_output"  style="min-height: 120px; height: 400px; background-color:gainsboro;"></div>
			  </td>
			</tr>
			<?
			if($_SESSION['acc']!= NULL ){
				echo '<tr id="tr_chat_input">';
				  echo '<td class="chat_input">';
					echo '<textarea  onkeypress="keyJudge(event)" type="text" autofocus rows="1" id="publicInput" name="msg" style="font-size:18pt;color:black;resize:none;"></textarea>';
				  echo '</td>';
				  
				echo '<td class="chat_input">';
				echo '<input type="button" id="im_chat_send" onclick="sendMsg()" value="Send" />';
				echo '</td>';
				echo '</tr>';
			}
			?>
		  </tbody>
		</table>
		</form>
	</div> 
	<script src="./Carousel Template for Bootstrap_files/jquery.min.js"></script>
	<script>
	function init()
	{
		$('#chat_output').scrollTop( $('#chat_output')[0].scrollHeight);
	}
	
	function setCaretPosition(ctrl, pos){
		if(ctrl.setSelectionRange){
			ctrl.focus();
			ctrl.setSelectionRange(pos,pos);
		}
		else if (ctrl.createTextRange) {
			var range = ctrl.createTextRange();
			range.collapse(true);
			range.moveEnd('character', pos);
			range.moveStart('character', pos);
			range.select();
		}

	}
	
    function sendMsg(){
		$.post(
            "cInsert.php",
            "msg="+$("#publicInput").val()
        );
        $("#publicInput").val(function(n,c){
		  return "";
		});
		$('#chat_output').scrollTop( $('#chat_output')[0].scrollHeight);
		
    }
    
    function showMsg(){	
		//alert($('#chat_output')[0].scrollHeight+"px  "+$('#chat_output').scrollTop());
        $("#chat_output").load(
            "cDisp.php", "",
            function(){
				if(($('#chat_output')[0].scrollHeight) - ($('#chat_output').scrollTop())<500){
					$('#chat_output').scrollTop( $('#chat_output')[0].scrollHeight);
				}	
				
            }
        );
	}
    setInterval("showMsg();", 700);
	setTimeout("init();", 2000)
    
	function keyJudge(e)
	{
		if(e.keycode == 13 || e.which == 13)
		{		
			e.preventDefault();
			sendMsg();	
			
		}	
	}
	</script>
</body>
</html>