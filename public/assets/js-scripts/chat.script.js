/**
 * creates the json template of the message to send
 * 
 * @param string from
 * @param string msg
 * @param string type
 */
function createJSON(from, msg, type) {
    return {
        "from": from,
        "msg": msg,
        "type": type
    };
}

/**
 * sends a data json to the other connections
 * 
 * @param string from
 * @param string msg
 * @param string type
 */
function send(data) {
    conn.send(JSON.stringify(data));
}

/**
 * executes when the connection is opened
 */
conn.onopen = function() {
    var data = createJSON(getCookie("username"), "", "joined");
    send(data);
};

/**
 * executes when a message is received
 * 
 * @param object e
 */
conn.onmessage = function(e) {
    var data = JSON.parse(e.data);
    showMessage(data.from, data.msg, data.type);
};

/**
 * 
 * @param string from, the author of the message
 * @param string msg, the message
 * @param string sent, if the message is sent from the user
 */
function showMessage(from, msg, type, sent = "") {

    // gets the chat-box element
    var chatBox = document.getElementById("chat-box");

    switch (type) {
        case "message":
            var msgDiv = `<div class="message-box ${sent}"><h2>${from}</h2><p>${msg}</p></div>`;
            break;

        case "joined":
            var msgDiv = `<div class="alert"><p>${from} has joined</p></div>`;
            break;
    }

    // shows the message in the chat-box
    chatBox.innerHTML += msgDiv;

    // keeps scrolling to the bottom
    chatBox.scrollTop = chatBox.scrollHeight;
}

/**
 * creates an array with the name and the value of the cookie
 * 
 * @param string name
 * 
 * @return array
 */
function getCookie(name) {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split("=");

        if (cookie[0] == name) {
            return cookie[1];
        }
    }
}

window.onload = function() {

    // sends the message when the user press enter
    textarea.onkeyup = function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            
            // gets the message from the textarea
            var msg = textarea.value;

            // clears the textarea
            textarea.value = "";

            var data = createJSON(getCookie("username"), msg, "message")

            // shows the message in the user browser
            showMessage(data.from, data.msg, data.type, "sent");

            // sends the message to the other connections
            send(data);
        }
    }
}