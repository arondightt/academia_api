CREATE TABLE api_route (
  id INT AUTO_INCREMENT PRIMARY KEY,
  method_http VARCHAR(10),
  endpoint_request VARCHAR(100),
  class VARCHAR(100),
  class_method VARCHAR(100),
  api_version VARCHAR(10),
  endpoint_status BOOLEAN,
  create_date DATE
);
