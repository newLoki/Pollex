#ensure that the mail validation gem is loaded
require 'valid_email'

class User < ActiveRecord::Base
  attr_accessible :birthdate, :email, :lastname, :surname
  has_many :polls
  has_many :questions
  has_many :groups
  has_many :answers

  validates :surname, :presence => true,
                      :format => {
                        :with => /\A[a-zA-Z]+\z/,
                        :message => "Only letters allowed"
                      }
  validates :lastname,  :presence => true,
                        :format => {
                          :with => /\A[a-zA-Z]+\z/,
                          :message => "Only letters allowed"
                        }
  validates :email, :presence => true,
                    :email => true
  validates_date :birthdate
end
