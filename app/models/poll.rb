class Poll < ActiveRecord::Base
  attr_accessible :author_id, :body, :title
  belongs_to :users
  has_many :questions
end
