class Question < ActiveRecord::Base
  attr_accessible :poll_id, :title, :type_id, :value
  belongs_to :poll
  has_many :answers
  belongs_to :group
  belongs_to :type

  validates :title, :presence => true,
            :format => {
                :with => /\A[a-z0-9\.\?! -_]+\z/i,
                :message => "Only letters, numbers, ?!-_. and whitespaces allowed"
            }
  validates :value, :presence => true,
            :format => {
                :with => /\A[a-z0-9\.\?! -_]+\z/,
                :message => "Only letters, numbers , ?!-_. and whitespaces allowed"
            }
  validates_presence_of :poll
  #validates_presence_of :type @todo needed for templating implementation
end
