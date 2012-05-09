require 'cgi'
require 'digest/md5'
require 'net/https'
require 'uri'
require 'open-uri'

module Jekyll
  class ExternalSourceTag < Liquid::Tag
    def initialize(tag_name, text, token)
      super
      @text           = text
    end

    def render(context)
        url = @text
        code       = get_code(url)
        html_output_for(url, code)
    end

    def get_code(url)
        web_contents  = open(URI.encode(url.strip)) {|f| f.read }

        return web_contents
    end

    def html_output_for(script_url, code)
      code = CGI.escapeHTML code
      "<script src='#{script_url}'></script><div><noscript><pre><code>#{code}</code></pre></noscript></div>"
    end
  end
end

Liquid::Template.register_tag('external_source', Jekyll::ExternalSourceTag)
