
object @user

attributes :surname, :lastname, :birthdate

# Include a custom node with full_name for user
node :full_name do |user|
  [user.surname, user.lastname].join(" ")
end


