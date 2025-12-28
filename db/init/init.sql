CREATE TABLE api_route (
  id INT AUTO_INCREMENT PRIMARY KEY,
  method_http VARCHAR(10),
  endpoint_request VARCHAR(100),
  class_method VARCHAR(100),
  api_version VARCHAR(10),
  endpoint_status TINYINT(1),
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE aluno (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  genero ENUM('Masculino','Feminino','Outro'),
  nascimento DATE,
  telefone VARCHAR(15),
  status TINYINT(1),
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE avaliacao_fisica (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  peso DECIMAL(5,2),
  altura DECIMAL(5,2),
  data_avaliacao DATETIME,
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (aluno_id) REFERENCES aluno(id)
);

CREATE TABLE checkin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
  status TINYINT(1),
  FOREIGN KEY (aluno_id) REFERENCES aluno(id)
);

CREATE TABLE exercicio (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  descricao TEXT,
  grupo_muscular VARCHAR(100),
  dificuldade ENUM('Facil','Medio','Dificil'),
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ficha (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  objetivo VARCHAR(100),
  FOREIGN KEY (aluno_id) REFERENCES aluno(id)
);

CREATE TABLE ficha_exercicio (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ficha_id INT,
  exercicio_id INT,
  series INT,
  repeticoes INT,
  carga DECIMAL(5,2),
  FOREIGN KEY (ficha_id) REFERENCES ficha(id),
  FOREIGN KEY (exercicio_id) REFERENCES exercicio(id)
);

CREATE TABLE matricula (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT,
  data_inicio DATE,
  data_fim DATE,
  status TINYINT(1),
  FOREIGN KEY (aluno_id) REFERENCES aluno(id)
);

CREATE TABLE plano (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50),
  descricao TEXT,
  valor DECIMAL(10,2),
  duracao_meses INT,
  create_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO api_route (method_http, endpoint_request, class_method, api_version, endpoint_status)
VALUES
('GET','aluno','AlunoController@buscar','v1',1),
('POST','aluno','AlunoController@criar','v1',1),
('PUT','aluno','AlunoController@atualizar','v1',1),
('PATCH','aluno','AlunoController@atualizarParcial','v1',1),
('DELETE','aluno','AlunoController@deletar','v1',1),
('GET','avaliacao-fisica','AvaliacaoFisicaController@buscar','v1',1),
('POST','avaliacao-fisica','AvaliacaoFisicaController@criar','v1',1),
('PUT','avaliacao-fisica','AvaliacaoFisicaController@atualizar','v1',1),
('PATCH','avaliacao-fisica','AvaliacaoFisicaController@atualizarParcial','v1',1),
('DELETE','avaliacao-fisica','AvaliacaoFisicaController@deletar','v1',1),
('GET','checkin','CheckinController@buscar','v1',1),
('POST','checkin','CheckinController@criar','v1',1),
('PUT','checkin','CheckinController@atualizar','v1',1),
('PATCH','checkin','CheckinController@atualizarParcial','v1',1),
('DELETE','checkin','CheckinController@deletar','v1',1),
('GET','exercicio','ExercicioController@buscar','v1',1),
('POST','exercicio','ExercicioController@criar','v1',1),
('PUT','exercicio','ExercicioController@atualizar','v1',1),
('PATCH','exercicio','ExercicioController@atualizarParcial','v1',1),
('DELETE','exercicio','ExercicioController@deletar','v1',1),
('GET','ficha','FichaController@buscar','v1',1),
('POST','ficha','FichaController@criar','v1',1),
('PUT','ficha','FichaController@atualizar','v1',1),
('PATCH','ficha','FichaController@atualizarParcial','v1',1),
('DELETE','ficha','FichaController@deletar','v1',1),
('GET','ficha-exercicio','FichaExercicioController@buscar','v1',1),
('POST','ficha-exercicio','FichaExercicioController@criar','v1',1),
('PUT','ficha-exercicio','FichaExercicioController@atualizar','v1',1),
('PATCH','ficha-exercicio','FichaExercicioController@atualizarParcial','v1',1),
('DELETE','ficha-exercicio','FichaExercicioController@deletar','v1',1),
('GET','matricula','MatriculaController@buscar','v1',1),
('POST','matricula','MatriculaController@criar','v1',1),
('PUT','matricula','MatriculaController@atualizar','v1',1),
('PATCH','matricula','MatriculaController@atualizarParcial','v1',1),
('DELETE','matricula','MatriculaController@deletar','v1',1),
('GET','plano','PlanoController@buscar','v1',1),
('POST','plano','PlanoController@criar','v1',1),
('PUT','plano','PlanoController@atualizar','v1',1),
('PATCH','plano','PlanoController@atualizarParcial','v1',1),
('DELETE','plano','PlanoController@deletar','v1',1);


INSERT INTO aluno (nome, genero, nascimento, telefone, status) VALUES
('Joao','Masculino','2000-01-01','11111111111',1),
('Ana','Feminino','1995-05-12','22222222222',1),
('Ziggy','Outro','2002-09-23','33333333333',1),
('Carlos', 'Masculino','1998-07-15','44444444444',1),
('Jean','Feminino','2001-12-30','55555555555',1);

INSERT INTO avaliacao_fisica (aluno_id, peso, altura, data_avaliacao) VALUES
(1,75.5,1.80,'2025-01-01'),
(2,60.0,1.65,'2025-02-01'),
(3,68.0,1.70,'2025-03-01'),
(4,80.0,1.75,'2025-04-01'),
(5,55.0,1.60,'2025-05-01');

INSERT INTO checkin (aluno_id, status) VALUES
(1,1),(2,1),(3,1),(4,1),(5,1);

INSERT INTO exercicio (nome, descricao, grupo_muscular, dificuldade) VALUES
('Agachamento','Agachamento com barra','Pernas','Medio'),
('Supino','Supino reto','Peito','Medio'),
('Flexão','Flexão de braço','Peito','Facil'),
('Corrida','Corrida 5km','Cardio','Facil'),
('Puxada','Puxada na barra','Costas','Dificil');

INSERT INTO ficha (aluno_id, objetivo) VALUES
(1,'Hipertrofia'),
(2,'Emagrecimento'),
(3,'Condicionamento'),
(4,'Força'),
(5,'Perda de peso');

INSERT INTO ficha_exercicio (ficha_id, exercicio_id, series, repeticoes, carga) VALUES
(1,1,4,12,50),
(1,2,4,10,40),
(1,3,3,15,0),
(2,4,3,20,0),
(2,5,3,12,30);

INSERT INTO matricula (aluno_id, data_inicio, data_fim, status) VALUES
(1,'2025-01-01','2025-12-31',1),
(2,'2025-02-01','2025-12-31',1),
(3,'2025-03-01','2025-12-31',1),
(4,'2025-04-01','2025-12-31',1),
(5,'2025-05-01','2025-12-31',1);

INSERT INTO plano (nome, descricao, valor, duracao_meses) VALUES
('Mensal','Plano mensal básico',100.00,1),
('Trimestral','Plano trimestral intermediário',270.00,3),
('Semestral','Plano semestral completo',500.00,6),
('Anual','Plano anual completo',900.00,12),
('VIP','Plano VIP com personal',1500.00,12);
