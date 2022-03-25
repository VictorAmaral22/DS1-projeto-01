Prezados, desenvolver um CRUD semelhante ao sistema de uma biblioteca.

Teremos 2 tabelas:  Usuários e Livros.

Cada usuário tem id, nome e e-mail e password. O email será o username. Campo Nome será apenas para informação adicional.

Senha deve ser armazenada no banco de dados criptografada. Usar bcrypt.

Cada livro terá id, autores (pode ser um VARCHAR grande), título, ano, editora, quem pegou emprestado e quantidade disponível para empréstimo. 

Diante dessas duas tabelas, existe um relacionamento entre elas. Um usuário pode pegar emprestado 1 ou mais livros. 


O sistema deve solicitar cadastro do usuário, para popular o banco de dados Usuários, na tela de login, criar um link para o cadastro. 

O login deverá ser feito entrando com o e-mail existente do usuário e senha. Se a senha for correta, através de um select, entra-se na sessão, caso contrário, ERRO. A sessão apresentará todos os livros que o usuário pegou emprestado. Inicialmente deverá ter um aviso (nenhum livro pego emprestado). 
    
Em outra tabela na mesma página ou link, o usuário poderá fazer uma pesquisa. A pesquisa envolve: listar todos os livros, buscar por pedaço de titulo, e buscar por ano (ordem decrescente). 


Deve ter uma maneira para selecionar um livro que quer pegar emprestado. Se a quantidade for zero desse livro, o usuário não poderá selecionar para empréstimo. 


Para popular o banco de dados livros, neste trabalho, focaremos apenas session e acesso a recursos básicos do mysql. Podem popular o banco de dados livros, manualmente usando inserts. Sem CRUD específico ( por enquanto, pois em outros trabalhos, iremos aumentar a complexidade )

Criar um link para logout. Apresentar o campo NOME na tela com "Usuário 'NOME' logado".

Trabalho pode ser realizado INDIVIDUALMENTE, valendo 30%. 