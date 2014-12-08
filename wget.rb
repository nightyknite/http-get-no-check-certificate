require "net/https"
require "uri"

uri = URI.parse(ARGV[1])
http = Net::HTTP.new(uri.host,uri.port)
http.use_ssl = true
http.verify_mode = OpenSSL::SSL::VERIFY_NONE # SSLの検証を無効

request = Net::HTTP::Get.new(uri.request_uri)
response = http.request(request)

# filename = File.basename(uri.request_uri)
filename=ARGV[0]
open(filename, 'wb') do |file|
    file.puts response.body
end
