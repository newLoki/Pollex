require 'cgi'
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
        url = URI.encode(@text.strip)
        code       = get_code(url)
        html_output_for(url, code)
    end

    def get_code(url)
        puts "URL: #{URI.encode(url.strip)}"
        web_contents  = open(url) {|f| f.read }

        return web_contents
    end

    def html_output_for(script_url, code)
      "<script src='#{script_url}'></script><div><noscript><pre><code>#{code}</code></pre></noscript></div>"
    end
  end
end

Liquid::Template.register_tag('external_source', Jekyll::ExternalSourceTag)
