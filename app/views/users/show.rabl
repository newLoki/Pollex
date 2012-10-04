
object @user

attributes :surname, :lastname, :birthdate

# Include a custom node with full_name for user
node :full_name do |user|
  [user.first_name, user.last_name].join(" ")
end


