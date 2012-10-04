class Question < ActiveRecord::Base
  attr_accessible :poll_id, :title, :type_id, :value
  belongs_to :polls
  has_many :answers
  belongs_to :users
  belongs_to :groups
end
