from recypy import db
from recypy import bcrypt

from sqlalchemy import ForeignKey, Column
from sqlalchemy.orm import relationship

class User(db.Model):

    __tablename__ = 'user'

    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password = db.Column(db.Text)
    recipes = relationship("Recipe", back_populates="user")

    def __init__(self, username, password): 
        self.username = username
        self.password = bcrypt.generate_password_hash(password)
    
    def __repr__(self):
        return '<User {}>'.format(self.username)

class Recipe(db.Model):
    __tablename__ = 'recipe'
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(80), nullable=False)
    description = db.Column(db.Text, nullable=False)
    date = db.Column(db.Time, nullable=False)
    author_id = db.Column(db.Integer, ForeignKey("user.id"))
    author = relationship("User", back_populates="recipe")
    steps = relationship("RecipeSteps")
    ingredients = relationship("Ingredients")
    likes = db.Column(db.Integer)
    dislikes = db.Column(db.Integer)
    comments = relationship("Comments", back_populates="recipe")
    active_time = db.Column(db.Integer, nullable=False) # in minutes
    total_time = db.Column(db.Integer, nullable=False) # in minutes

class RecipeSteps(db.Model):
    __tablename__ = 'recipe_steps'
    id = db.Column(db.Integer, primary_key=True)
    recipe_id = Column(db.Integer, ForeignKey("recipe.id"))
    step_number = db.Column(db.Integer, nullable=False)
    instructions = db.Column(db.Text, nullable=False)

class Ingredients(db.Model):
    __tablename__ = "ingredients"
    id = db.Column(db.Integer, primary_key=True)
    recipe_id = Column(db.Integer, ForeignKey("recipe.id"))
    name = db.Column(db.String(80), nullable=False)
    quantity = db.Column(db.String(80), nullable=False)
    notes = db.Column(db.Text)

class SavedRecipes(db.Model):
    __tablename__ = "saved_recipes"
    id = db.Column(db.Integer, primary_key=True)
    user_id = Column(db.Integer, ForeignKey("user.id"))
    recipe_id = Column(db.Integer, ForeignKey("recipe.id"))

class Following(db.Model):
    __tablename__ = "following"
    id = db.Column(db.Integer, primary_key=True)
    following_id = Column(db.Integer, ForeignKey("user.id"))
    followed_id = Column(db.Integer, ForeignKey("user.id"))

class Likes(db.Model):
    __tablename__ = "likes"
    id = db.Column(db.Integer, primary_key=True)
    user_id = Column(db.Integer, ForeignKey("user.id"))
    recipe_id = Column(db.Integer, ForeignKey("recipe.id"))
    score = Column(db.Integer) # 1 for like, -1 for dislike, 0 for nothing

class Comments(db.Model):
    __tablename__ = "comments"
    id = db.Column(db.Integer, primary_key=True)
    user_id = Column(db.Integer, ForeignKey("user.id"))
    recipe_id = Column(db.Integer, ForeignKey("recipe.id"))
    comment = db.Column(db.Text, nullable=False)
    recipe = relationship("Recipe", back_populates="comments")
