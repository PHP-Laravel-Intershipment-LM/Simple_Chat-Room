const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerName = get(".msger-name");
const msgerChat = get(".msger-chat");
const msgerAvatar = get(".msger-avatar");
const msgerRoom = get(".msger-room");
const sideLeft = 'left';
const sideRight = 'right';

msgerForm.addEventListener("submit", event => {
  event.preventDefault();

  let msgRoom = msgerRoom.value;

  // Send message to server
  sendMessage(msgRoom, msgText, appendMessage);
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

function sendMessage(idActive, content, callback) {
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
      'content': content
    })
  }).then(response => {
    let msgText = msgerInput.value;
    let msgName = msgerName.value;
    let msgAvatar = msgerAvatar.value;
    if (!msgText) return;
    msgerInput.value = '';
    callback(msgName, msgAvatar, sideRight, msgText);
  }).catch(function (error) {
    console.log('Send request failed. Try again!');
  });
}
