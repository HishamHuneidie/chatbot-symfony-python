from flask import Blueprint, request

from .methods import *

ChatController = Blueprint('ChatController', __name__)


@ChatController.route('/chat')
def chat():
    # Params
    message = request.args.get('message')

    answer = processRequest(message)

    return {'answer': answer}
