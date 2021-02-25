# -*- coding: utf-8 -*-

from flask import Flask, Blueprint

profile_page = Blueprint('profile_page', 'Profile Page')
@profile_page.route('/profile')
def show():
    return 'This will be the profile page'