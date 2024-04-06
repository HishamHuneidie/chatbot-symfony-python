from flask import Blueprint, request

ChatController = Blueprint('ChatController', __name__)


@ChatController.route('/chat')
def chat():
    return '{"message": "My chat"}'
