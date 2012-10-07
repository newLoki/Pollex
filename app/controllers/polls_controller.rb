class PollsController < ApplicationController
  def index
    @polls = Poll.all
  end

  def show
    @polls = Poll.find_by_id(params[:id])
    
    if @polls.nil?
      head :not_found
    end
  end

  def create
    @poll = Poll.new(JSON.parse(params[:poll]))

    if  @poll.valid?
      @poll.save
    else
      head :conflict
    end
  end

  def update
    @poll = Poll.find_by_id(params[:id])

    if @poll.nil?
      head :not_found
    else
      @poll.update_attributes(JSON.parse(params[:user]))

      if @poll.valid?
        @poll.save
        render :update, :status => :ok, :formats => [:json]
      else
        head :conflict
      end
    end
  end

  def destroy
    @poll = Poll.find_by_id(params[:id])

    if @poll.nil?
      head :not_found
    else
      @poll.destroy
      render :destroy, :status => :ok, :formats => [:json]
    end
  end
end
