from flask import Flask

from Controller.IndexController import IndexController
from Controller.ChatController import ChatController

app = Flask(__name__)

app.register_blueprint(IndexController)
app.register_blueprint(ChatController)

if __name__ == '__main__':
	app.run(host='0.0.0.0', port=5000)