class Group < ActiveRecord::Base
  attr_accessible :title
  belongs_to :users
  has_many :polls
end
