class PollsController < ApplicationController
  def index
    @polls = Poll.all
  end

  def show
    @polls = Poll.find_by_id(params[:id])

  end
end
