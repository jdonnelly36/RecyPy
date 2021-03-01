from flask import render_template, Blueprint
from flask_login import login_required, current_user

from recypy import db

## Config
home_blueprint = Blueprint(
    'home', __name__,
    template_folder =  "templates"
)

## Routes

@home_blueprint.route("/")
def home():
    return "Index"