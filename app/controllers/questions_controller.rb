class QuestionsController < ApplicationController
  def index
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @questions = @poll.questions
    end
  end

  def show
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @question = @poll.questions.find_by_id(params[:id])

      if @question.nil?
        head :not_found
      end
    end
  end

  def create
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @question = Question.new(JSON.parse(params[:question]))
      @question.poll = @poll

      if @question.valid?
        @question.save
        render :update, :status => :ok, :formats => [:json]
      else
        @errors = @question.errors
        head :conflict
      end
    end
  end

  def update
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else

      @question = Question.find_by_id(params[:id])

      if @question.nil?
        head :not_found
      else
        @question.update_attributes(JSON.parse(params[:question]))
        @question.poll = @poll

        if @question.valid?
          @question.save
          render :update, :status => :ok, :formats => [:json]
        else
          @errors = @question.errors
          head :conflict
        end
      end
    end
  end

  def destroy
    @question = Question.find_by_id(params[:id])

    if @question.nil?
      head :not_found
    else
      @question.destroy
      render :destroy, :status => :ok, :formats => [:json]
    end
  end
end
