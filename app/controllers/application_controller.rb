class ApplicationController < ActionController::Base

  protect_from_forgery

  #add default responder to responde with correct headers on update/creation
  self.responder = ApiResponder
end
