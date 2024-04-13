from flask import Blueprint, request

from .methods import *

IndexController = Blueprint('IndexController', __name__)


@IndexController.route('/')
def index():

    return {'answer': 'index'}
