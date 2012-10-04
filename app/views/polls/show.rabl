
object @polls

attributes :title, :body

child :user do
  extends "users/show"
end
