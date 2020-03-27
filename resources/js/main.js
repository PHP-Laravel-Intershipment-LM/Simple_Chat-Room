const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerName = get(".msger-name");
const msgerChat = get(".msger-chat");
const sideLeft = 'left';
const sideRight = 'right';

msgerForm.addEventListener("submit", event => {
  event.preventDefault();

  const msgText = msgerInput.value;
  const msgName = msgerName.value;
  if (!msgText) return;

  // Append current message to chat area
  appendMessage(msgName, null, sideRight, msgText);
  msgerInput.value = '';
});

function appendMessage(name, img = null, side, text) {
  //   Simple solution for small apps
  const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-img" style="background-image: url(${img})"></div>

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
  msgerChat.scrollTop += 500;
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
