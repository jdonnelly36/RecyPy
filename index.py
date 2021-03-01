# -*- coding: utf-8 -*-

from flask import Flask, render_template
from views.profile_page import profile_page
app = Flask(__name__)
app.register_blueprint(profile_page)

@app.route('/')
def hello_world():
    return 'Hello, World!'
if __name__ == '__main__':
    app.run()