from flask import Blueprint

IndexController = Blueprint('IndexController', __name__)

@IndexController.route('/')
def index():
    return '{"message": "My index"}'