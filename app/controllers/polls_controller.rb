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
end
