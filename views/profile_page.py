# -*- coding: utf-8 -*-

from flask import Flask, Blueprint, render_template

profile_page = Blueprint('profile_page', 'Profile Page')
@profile_page.route('/profile')
def show():
    return render_template('profile_page.html')