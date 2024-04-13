import chatbot from '../chatbot';

window.addEventListener('load', e => {
    console.log('Este es el index');
    let chatbotsContainer = chatbot.getChatbotsContainer();
    let newChatbot1 = chatbot.getNewChat('lll');
    let newChatbot2 = chatbot.getNewChat('ggg');
    chatbotsContainer.appendChild(newChatbot1);
    chatbotsContainer.appendChild(newChatbot2);

});
