object @question

attributes :title, :type_id, :value

child :poll do
  extends "polls/show"
end