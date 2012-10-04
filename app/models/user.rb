class User < ActiveRecord::Base
  attr_accessible :birthdate, :email, :lastname, :surname
  has_many :polls
  has_many :questions
  has_many :groups
  has_many :answers
end
