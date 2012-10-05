class Poll < ActiveRecord::Base
  attr_accessible :user_id, :body, :title
  belongs_to :user
  has_many :questions

  validates :title, :presence => true,
                    :format => {
                      :with => /\A[a-z0-9\.\?! -_]+\z/i,
                      :message => "Only letters, numbers, ?!-_. and whitespaces allowed"
                    }
  validates :body, :presence => true,
                   :format => {
                      :with => /\A[a-z0-9\.\?! -_]+\z/i,
                      :message => "Only letters, numbers, ?!-_. and whitespaces allowed"
                  }
  validates_presence_of :user
end
