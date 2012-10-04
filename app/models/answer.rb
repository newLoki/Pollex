class Answer < ActiveRecord::Base
  attr_accessible :poll_id, :question_id, :type_id, :value
  belongs_to :questions
  belongs_to :polls
  belongs_to :users
  belongs_to :groups
end
