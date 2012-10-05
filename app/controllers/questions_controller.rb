class QuestionsController < ApplicationController
  def index
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @questions = @poll.questions
    end
  end

  def show
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = @poll.questions.find_by_id(params[:id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:id]} found" }
        render :error, :status => 404, :formats => [:json]
      end
    end
  end

  def create
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = Question.new(JSON.parse(params[:question]))
      @question.poll = @poll

      if @question.valid?
        @question.save
        render :update, :status => :ok, :formats => [:json]
      else
        @errors = @question.errors
        render :error, :status => :conflict, :formats => [:json]
      end
    end
  end

  def update
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else

      @question = Question.find_by_id(params[:id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:id]} found" }
        render :error, :status => 404, :formats => [:json]
      else
        @question.update_attributes(JSON.parse(params[:question]))
        @question.poll = @poll

        if @question.valid?
          @question.save
          render :update, :status => :ok, :formats => [:json]
        else
          @errors = @question.errors
          render :error, :status => :conflict, :formats => [:json]
        end
      end
    end
  end

  def destroy
    @question = Question.find_by_id(params[:id])

    if @question.nil?
      @errors = { :messages => "No question with id #{params[:id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question.destroy
      render :destroy, :status => :ok, :formats => [:json]
    end
  end
end
