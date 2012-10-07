class UsersController < ApplicationController
  #require oauth login before any action is performed
  #before_filter :oauth_required

  #ensure that it can return json and xml
  respond_to :json

  #method to list all users
  def index
    @users = User.all
  end

  #method to find a user by given id
  def show
    @user = User.find_by_id(params[:id])
    
    if @user.nil?
      head :not_found
    end
  end

  def create
    @user = User.new(JSON.parse(params[:user]))
    if @user.valid?
      @user.save
      render :create, :status => :ok, :formats => [:json]
    else
      head :conflict
    end
  end

  def update
    @user = User.find_by_id(params[:id])

    if @user.nil?
      head :not_found
    else
      @user.update_attributes(JSON.parse(params[:user]))
      
      if @user.valid?
        @user.save
        render :update, :status => :ok, :formats => [:json]
      else
        head :conflict
      end
    end
  end

  def destroy
    @user = User.find_by_id(params[:id])
    
    if @user.nil?
      head :not_found
    else
      @user.destroy
      render :destroy, :status => :ok, :formats => [:json]
    end
  end
end