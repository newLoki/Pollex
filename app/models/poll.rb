class Poll < ActiveRecord::Base
  attr_accessible :user_id, :body, :title
  belongs_to :user
  has_many :questions

  validates :title, :presence => true,
                    :format => {
                      :with => /\A[a-zA-Z\.\?! -_]+\z/,
                      :message => "Only letters, ?!-_. and whitespaces allowed"
                    }
  validates :body, :presence => true,
                   :format => {
                      :with => /\A[a-zA-Z\.\?! -_]+\z/,
                      :message => "Only letters, ?!-_. and whitespaces allowed"
                  }
end
