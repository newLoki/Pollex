class User < ActiveRecord::Base

  attr_accessible :birthdate, :email, :lastname, :surname
  has_many :polls
  belongs_to :questions
  belongs_to :groups
  belongs_to :answers

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
                    :uniqueness => true,
                    :format => { 
                      :with => /^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i,
                      :message => 'This is not an email address'
                    }
  validates :birthdate, :presence => true,
                        :format => {
                          :with => /^(19|20)\d\d[- \/.](0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])$/,
                          :message => 'Date should formatted like yyyy-mm-dd'
                    }
end
