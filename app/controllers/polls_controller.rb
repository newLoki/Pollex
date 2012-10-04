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
    @polls = Poll.new(JSON.parse(params[:poll]))

    unless @polls.valid?
      @errors = @polls.errors
      render :error, :status => :conflict, :formats => [:json]
    else
      @polls.save
    end
  end
end
