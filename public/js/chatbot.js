function getNewChat(idKey) {
    let chatbot = document.createElement('div');
    let chatbotButton = document.createElement('button');
    let chatbotContainer = document.createElement('div');
    let header = buildChatbotHeader();
    let messagesBox = buildChatbotMessagesBox();
    let inputsBox = buildChatbotInputsBox();

    // Setting attributes
    chatbot.id = idKey;
    chatbot.className = 'chatbot';
    chatbotButton.className = 'chatbot-button';
    chatbotContainer.className = 'chatbot-messenger-container';

    // Setting content
    chatbotButton.innerHTML = 'k';

    // Events
    chatbotButton.addEventListener('click', minimize);

    // Organizing nodes
    chatbotContainer.appendChild(header);
    chatbotContainer.appendChild(messagesBox);
    chatbotContainer.appendChild(inputsBox);
    chatbot.appendChild(chatbotButton);
    chatbot.appendChild(chatbotContainer);

    return chatbot;
}

function buildChatbotHeader() {
    // Declaring nodes
    let header = document.createElement('div');
    let title = document.createElement('p');
    let icons = document.createElement('div');
    let closeIcon = document.createElement('i');

    // Setting attributes
    header.className = 'chatbot-messenger-header';
    icons.className = 'chatbot-messenger-header-icons';
    closeIcon.className = 'chatbot-icon chatbot-icon-times';

    // Setting content
    title.innerHTML = 'Ask something';
    closeIcon.innerHTML = 'k';

    // Events
    closeIcon.addEventListener('click', minimize);

    // Organizing nodes
    header.appendChild(title);
    icons.appendChild(closeIcon);
    header.appendChild(icons);

    return header;
}

function buildChatbotMessagesBox() {
    // Declaring nodes
    let box = document.createElement('div');
    let message1 = document.createElement('div');
    let message2 = document.createElement('div');
    let messageContent1 = document.createElement('span');
    let messageContent2 = document.createElement('span');

    // Setting attributes
    box.className = 'chatbot-messenger-messages';
    message1.className = 'chatbot-message chatbot-message-left';
    message2.className = 'chatbot-message chatbot-message-right';

    // Setting content
    messageContent1.innerHTML = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto delectus dicta, enim ex facere harum maxime minus molestiae obcaecati odit optio pariatur perferendis placeat quibusdam reprehenderit voluptates! Quaerat, unde!';
    messageContent2.innerHTML = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto delectus dicta, enim ex facere harum maxime minus molestiae obcaecati odit optio pariatur perferendis placeat quibusdam reprehenderit voluptates! Quaerat, unde!';

    // Organizing nodes
    message1.appendChild(messageContent1);
    message2.appendChild(messageContent2);
    box.appendChild(message1);
    box.appendChild(message2);

    return box;
}

function buildChatbotInputsBox() {
    // Declaring nodes
    let box = document.createElement('div');
    let input = document.createElement('input');
    let button = document.createElement('button');
    let icon = document.createElement('i');

    // Setting attributes
    box.className = 'chatbot-messenger-inputs';
    input.type = 'text';
    input.placeholder = 'Ask something...';
    icon.className = 'icon';

    // Setting content
    icon.innerHTML = 'k';

    // Events
    button.addEventListener('click', sendMessage);

    // Organizing nodes
    button.appendChild(icon);
    box.appendChild(input);
    box.appendChild(button);

    return box;
}

function getChatbotsContainer() {
    let chatbotsContainer = document.querySelector('#chatbot-container');
    if (!chatbotsContainer) {
        chatbotsContainer = document.createElement('div');
        chatbotsContainer.id = 'chatbot-container';
        chatbotsContainer.className = 'chatbot-container';
        document.body.appendChild(chatbotsContainer);
        chatbotsContainer = document.querySelector('#chatbot-container');
    }

    return chatbotsContainer;
}

function minimize(e) {
    let button = e.currentTarget;
    let chatbot = button.getParentByClass('chatbot');
    chatbot.classList.toggle('show');
}

function sendMessage(e) {
    let button = e.currentTarget;
    let inputBox = button.getParentByClass('chatbot-messenger-inputs');
    let input = inputBox.querySelector('input');
    let message = input.value.trim();

    // Sending message
    app.ajax(
        "/analyzer/ask-ajax",
        "POST",
        {message: message},
        res => {
            console.log('Making request...', res.toObject());
        },
        res => {
            console.error(res)
        },
    );
}

module.exports = {
    getNewChat: getNewChat,
    getChatbotsContainer: getChatbotsContainer,
};