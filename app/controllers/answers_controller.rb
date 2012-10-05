class AnswersController < ApplicationController
  def show
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:question_id]} found" }
        render :error, :status => 404, :formats => [:json]
      else
        @answer = @question.answers.find_by_id(params[:id])

        if @answer.nil?
          @errors = { :messages => "No answer with id #{params[:id]} found" }
          render :error, :status => 404, :formats => [:json]
        end
      end
    end
  end

  def index
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:question_id]} found" }
        render :error, :status => 404, :formats => [:json]
      else
        @answers = @question.answers.all
      end
    end
  end

  def create
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:question_id]} found" }
        render :error, :status => 404, :formats => [:json]
      else
        @answer = Answer.new(JSON.parse(params[:answer]))

        if @answer.valid?
          @answer.save
          render :update, :status => :ok, :formats => [:json]
        else
          @errors = @answer.errors
          render :error, :status => :conflict, :formats => [:json]
        end
      end
    end
  end

  def update
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      @errors = { :messages => "No poll with id #{params[:poll_id]} found" }
      render :error, :status => 404, :formats => [:json]
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        @errors = { :messages => "No question with id #{params[:question_id]} found" }
        render :error, :status => 404, :formats => [:json]
      else
        @answer = Answer.find_by_id(params[:id])
        if @answer.nil?
          @errors = { :messages => "No answer with id #{params[:id]} found" }
          render :error, :status => 404, :formats => [:json]
        else
          @answer.update_attributes(JSON.parse(params[:answer]))

          if @answer.valid?
            @answer.save
            render :update, :status => :ok, :formats => [:json]
          else
            @errors = @answer.errors
            render :error, :status => :conflict, :formats => [:json]
          end
        end
      end
    end
  end
end
