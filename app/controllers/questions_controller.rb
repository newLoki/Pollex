class QuestionsController < ApplicationController
  def index
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @questions = @poll.questions
    end
  end

  def show
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = @poll.questions.find_by_id(params[:id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:id]} found" }
        render :error, :status => 404, :formats => [:json]
      end
    end
  end
end
