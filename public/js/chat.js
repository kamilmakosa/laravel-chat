const form = document.querySelector(".typing-area"),
sender_id = form.querySelector(".sender_id").value,
receiver_id = form.querySelector(".receiver_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/api/messages", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/messages"+"?sender_id="+ sender_id +"&receiver_id=" + receiver_id, true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response
            // chatBox.innerHTML = data;
            chatBox.innerHTML = view(data, sender_id);
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

function view(data, sender_id) {
    avatars = {};
    parsedData = JSON.parse(data)
    messages = parsedData.data.messages;
    users = parsedData.data.users;
    users.forEach(function(user, index) {
        avatars['id'+user.id] = user.avatar;
    });
    output = '';
    messages.forEach(function(msg, index) {
        if (msg.sender_id == sender_id) {
            output += '<div class="chat outgoing"><div class="details"><p>'+ msg.message +'</p></div></div>';
        } else {
            output += '<div class="chat incoming"><img src="/'+ avatars['id'+msg.sender_id] +'" alt=""><div class="details"><p>'+ msg.message +'</p></div></div>'
        }
    });
    console.log(output);
    return output;
}