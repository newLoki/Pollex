class UsersController < ApplicationController
  #require oauth login before any action is performed
  #before_filter :oauth_required

  #ensure that it can return json and xml
  respond_to :json, :xml

  #method to find a user by given id
  def show
    @user = User.find_by_id(params[:id])
  end
end
