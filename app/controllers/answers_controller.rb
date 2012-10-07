class AnswersController < ApplicationController
  def show
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        head :not_found
      else
        @answer = @question.answers.find_by_id(params[:id])

        if @answer.nil?
          head :not_found
        end
      end
    end
  end

  def index
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        head :not_found
      else
        @answers = @question.answers.all
      end
    end
  end

  def create
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        head :not_found
      else
        @answer = Answer.new(JSON.parse(params[:answer]))

        if @answer.valid?
          @answer.save
          render :update, :status => :ok, :formats => [:json]
        else
          head :conflict
        end
      end
    end
  end

  def update
    @poll = Poll.find_by_id(params[:poll_id])
    if @poll.nil?
      head :not_found
    else
      @question = @poll.questions.find_by_id(params[:question_id])

      if @question.nil?
        head :not_found
      else
        @answer = Answer.find_by_id(params[:id])
        if @answer.nil?
          head :not_found
        else
          @answer.update_attributes(JSON.parse(params[:answer]))

          if @answer.valid?
            @answer.save
            render :update, :status => :ok, :formats => [:json]
          else
            head :conflict
          end
        end
      end
    end
  end

  def destroy
    @answers = Answer.find_by_id(params[:id])

    if @answer.nil?
      head :not_found
    else
      @answer.destroy
      render :destroy, :status => :ok, :formats => [:json]
    end
  end
end
