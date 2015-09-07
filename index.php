

<!DOCTYPE html>


<html>




<head>

<title>Chatbox</title>
	<script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>

	  <link rel="stylesheet" type="text/css" href="style.css">
	 


</head>



<body>

<section class='chat-container'>
  <header class='top-header'>
    <div class='left'>
     <i class="fa fa-comment"></i>
      <span class='top-header-tit'>Anonymous-Chat</span>
    </div>
    
  </header>

  <div class="setting">
    <div class='left'>
      <span>Name:</span>
      <input type="text" id='nameInput'>
      <span></span>
      
    </div>
    
  </div>

  <ol class='chat-box'>
     <ul id='messages' class="chat-messages"></ul>

  </ol>
  <div class="chatfooter">

    <input type="text" size="100" placeholder="Type your message here"  id='messageInput' ></input>

  </div>
</section>

<script>

  var messagesRef = new Firebase('https://luminous-fire-4585.firebaseio.com/');


  var messageField = $('#messageInput');
  var nameField = $('#nameInput');
  var messageList = $('#messages');


  messageField.keypress(function (e) {
    if (e.keyCode == 13) {

      var username = nameField.val();
      var message = messageField.val();
      if(message!=''){

      messagesRef.push({name:username, text:message});
      messageField.val('');  
      }
      
    }
  });


  messagesRef.limitToLast(10).on('child_added', function (snapshot) {

    var data = snapshot.val();
    var username = data.name || "anonymous";
    var message = data.text;


    var messageElement = $("<li>");
    var nameElement = $("<strong class='example-chat-username' style='margin-right:1em;'></strong>")
    nameElement.text(username+"");
    messageElement.text(message).prepend(nameElement);


    messageList.append(messageElement)


    messageList[0].scrollTop = messageList[0].scrollHeight;
  });
</script>




</body>







