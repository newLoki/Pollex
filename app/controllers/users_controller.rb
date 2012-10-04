class UsersController < ApplicationController
  #require oauth login before any action is performed
  #before_filter :oauth_required

  #ensure that it can return json and xml
  respond_to :json, :xml

  #method to list all users
  def index
    @users = User.all
  end

  #method to find a user by given id
  def show
    @user = User.find_by_id(params[:id])
  end

  def create
    @user = User.new(params[:user])

    if @user.valid?
      @user.save
      render :create, :status => :ok, :formats => [:xml, :json]
    else
      render @user.errors, :status => :conflict, :formats => [:xml, :json]
    end
  end

#  def update
#    @user = User.find(params[:id])
#    
#    if @user.update_attributes(params[:user])?
#      render { :head  => :ok }
#    else
#      render { @user.errors, :status => :unprocessable_entity }
#   end
#
#  end
end
