import Echo from 'laravel-echo';

const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerName = get(".msger-name");
const msgerChat = get(".msger-chat");
const msgerAvatar = get(".msger-avatar");
const msgerRoom = get(".msger-room");
const sideLeft = 'left';
const sideRight = 'right';

window.Echo.channel('public-channel')
    .listen('ChatEvent', function (data) {
        // Check if this message was send by current user
        if (data.name !== msgerName.value) {
            appendMessage(data.name, data.avatar, sideLeft, data.content);
        }
    });

msgerForm.addEventListener("submit", event => {
    event.preventDefault();

    let msgRoom = msgerRoom.value;
    let msgText = msgerInput.value;
    let msgAvatar = msgerAvatar.value;
    if (!msgText) return;

    // Send message to server
    sendMessage(msgRoom, msgAvatar, msgText, appendMessage);
});

function appendMessage(name, img, side, text) {
    //   Simple solution for small apps
    const msgHTML = `
        <div class="msg ${side}-msg">
          <div class="msg-img" style="background-image: ${img}"></div>
    
          <div class="msg-bubble">
            <div class="msg-info">
              <div class="msg-info-name">${name}</div>
              <div class="msg-info-time">${formatDate(new Date())}</div>
            </div>
    
            <div class="msg-text">${text}</div>
          </div>
        </div>
      `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTo(0, msgerChat.scrollHeight)
}

// Utils
function get(selector, root = document) {
    return root.querySelector(selector);
}

function formatDate(date) {
    const h = "0" + date.getHours();
    const m = "0" + date.getMinutes();

    return `${h.slice(-2)}:${m.slice(-2)}`;
}

function sendMessage(idActive, avatar, content, callback) {
    // Check if the browser supports 'fetch' or not
    if (!('fetch' in window)) {
        console.log('Fetch API not found, try including the polyfill');
        return;
    }

    // Send request if browser support 'fetch
    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': get('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            'id_active': idActive,
            'avatar': avatar,
            'content': content
        })
    }).then(response => {
        let msgName = msgerName.value;
        msgerInput.value = '';
        callback(msgName, avatar, sideRight, content);
    }).catch(function (error) {
        console.log('Send request failed. Try again!');
    });
}

