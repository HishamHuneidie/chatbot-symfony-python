from flask import Blueprint, request

from .methods import *

IndexController = Blueprint('IndexController', __name__)


@IndexController.route('/')
def index():
    # Params
    question = request.args.get('question')

    answer = processRequest(question)

    return {'message': answer}
