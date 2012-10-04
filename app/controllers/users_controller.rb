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

    respond_to do |format|
      if @user.save?
        format.xml   { render :xml => @user, :status => :created, :location => @user }
        format.json  { render :json => @user, :status => :created, :location => @user }
      else
        format.xml { render :xml => @user.errors, :status => :unprocessable_entity }
        format.json { render :json => @user.errors, :status => :unprocessable_entity }
      end
    end
  end
end
