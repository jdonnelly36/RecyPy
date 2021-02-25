# -*- coding: utf-8 -*-

from flask import Flask
from views.profile_page import profile_page
app = Flask('Recypy')
app.register_blueprint(profile_page)

@app.route('/')
def hello_world():
    return 'Hello, World!'