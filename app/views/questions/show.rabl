object @question

attributes :title, :body

child :poll do
  extends "polls/show"
end