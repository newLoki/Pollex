class PollsController < ApplicationController
  def index
    @polls = Poll.all
  end

  def show
    @polls = Poll.find_by_id(params[:id])
    
    if @polls.nil?
      @errors = { :messages => "No poll with id #{params[:id]} found" }
      render :error, :status => 404, :formats => [:json]
    end
  end

  def create
    @poll = Poll.new(JSON.parse(params[:poll]))

    if  @poll.valid?
      @poll.save
    else
      @errors = @poll.errors
      render :error, :status => :conflict, :formats => [:json]
    end
  end

  def update
    @poll = Poll.find_by_id(params[:id])

    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @poll.update_attributes(JSON.parse(params[:user]))

      if @poll.valid?
        @poll.save
        render :update, :status => :ok, :formats => [:json]
      else
        @errors = @poll.errors
        render :error, :status => :conflict, :formats => [:json]
      end
    end
  end

  def destroy
    @poll = Poll.find_by_id(params[:id])

    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @poll.destroy
      render :destroy, :status => :ok, :formats => [:json]
    end
  end
end
