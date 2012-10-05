class Answer < ActiveRecord::Base
  attr_accessible :question_id, :type_id, :value
  belongs_to :question
  belongs_to :user
  belongs_to :group
  #belongs_to :type

  validates :value, :presence => true,
            :format => {
                :with => /\A[a-z0-9\.\?! -_]+\z/i,
                :message => "Only letters, numbers, ?!-_. and whitespaces allowed"
            }
  validates_presence_of :user
  validates_presence_of :question
  #validates_presence_of :type
end
