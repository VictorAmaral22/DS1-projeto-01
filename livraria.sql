USE livraria;
drop table livrosusuario;
drop table livroexemplar;
drop table livro;
drop table usuario;

CREATE TABLE usuario (
    id integer AUTO_INCREMENT not null,
    nome varchar(255) not null,
    email varchar(255) unique not null,
    username varchar(255) unique not null,
    senha varchar(255) not null,
    datacriacao datetime default CURRENT_TIMESTAMP not null,
    PRIMARY KEY(id)
);

CREATE TABLE livro (
    id integer AUTO_INCREMENT not null,
    titulo varchar(255) not null,
    descricao varchar(500) not null,
    autor varchar(255) not null,
    datalancamento datetime not null DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE livroexemplar (
    id integer AUTO_INCREMENT not null,
    livro integer not null,
    PRIMARY KEY(id, livro),
    FOREIGN KEY(livro) REFERENCES livro(id)
);

CREATE TABLE livrosusuario (
    livro integer not null,
    usuario integer not null,
    dataalugado datetime default CURRENT_TIMESTAMP,
    alugado BOOLEAN not null DEFAULT false,
    PRIMARY KEY(usuario, livro),
    FOREIGN KEY(livro) REFERENCES livroexemplar(id),
    FOREIGN KEY(usuario) REFERENCES usuario(id)
);

insert into livro (id, titulo, descricao, autor, datalancamento) values 
    (123456789, 'O Hobbit', 'Situado em um tempo Entre o Alvorecer das Fadas e o Dominio dos Homens,[1] o livro segue a busca do hobbit caseiro Bilbo Bolseiro para conquistar uma parte do tesouro guardado pelo dragao Smaug. A jornada de Bilbo o leva de um ambiente rural alegre a um territorio mais sinistro.[2] A historia e contada na forma de uma busca episodica, e a maioria dos capitulos apresenta uma criatura especifica, ou um tipo de criatura, das "Terras Ermas" de Tolkien.', 'J.R.R. Tolkien', '1937-09-21'),
    (234567890, '1984', 'Apos uma guerra global, semelhante a segunda grande guerra, porem com mais bombas atomicas, o mundo foi dividido em tres continentes: Lestasia, Eurasia e Oceania, onde fica a cidade de Londres. Esse ultimo e comandado pelo lider Big Brother, a figura maxima de poder e controle, "o olho que tudo ve"', 'George Orwell', '1949-06-08'),
    (345678901, 'A Revolucao dos Bichos: Um conto de fadas', 'Verdadeiro classico moderno, concebido por um dos mais influentes escritores do seculo XX, A revolucao dos bichos e uma fabula sobre o poder. Narra a insurreicao dos animais de uma granja contra seus donos. Progressivamente, porem, a revolucao degenera numa tirania ainda mais opressiva que a dos humanos.', 'George Orwell', '1945-08-17'),
    (456789012, 'O ultimo Desejo', 'Geralt de Rivia e um bruxo sagaz e habilidoso. Um assassino impiedoso e de sangue-frio treinado, desde a infancia, para cacar e eliminar monstros. Seu unico objetivo: destruir as criaturas do mal que assolam o mundo. Um mundo fantastico criado por Sapkowski com claras influencias da mitologia eslava. Um mundo em que nem todos os que parecem monstros sao maus nem todos os que parecem anjos sao bons...', 'Andrzej Sapkowski', '1993-01-01'),
    (567890123, 'Do mil ao milhao: Sem cortar o cafezinho', 'Em seu primeiro livro, Thiago Nigro, criador da plataforma O Primo Rico, ensina aos leitores os tres pilares para atingir a independencia financeira: gastar bem, investir melhor e ganhar mais. Por meio de dados e de sua propria experiencia como investidor e assessor, Nigro mostra que a riqueza e possivel para todos - basta estar disposto a aprender e se dedicar.', 'Thiago Nigro', '2018-11-01'),
    (678901234, 'O Chamado de Cthulhu e outros contos', 'O Chamado de Cthulhu e um dos contos de horror mais famosos de H. P. Lovecraft e marca o inicio de uma era "lovecraftiana" com uma linguagem propria e fantasiosa que chegou a inspirar jogos de RPG, bem como musicas e historias em quadrinhos. A historia e baseada numa mitologia imaginaria em que um ser extraterreno muito poderoso espera ser trazido de volta a vida por seus adoradores...', 'H.P. Lovecraft', '2020-06-08');

insert into livroexemplar (livro) values 
    (123456789),
    (123456789),
    (123456789),
    (234567890),
    (234567890),
    (234567890),
    (234567890),
    (456789012),
    (456789012),
    (567890123),
    (678901234);

insert into usuario (id, nome, email, username, senha, datacriacao) values (1, 'Victor Amaral', 'victor@gmail.com', 'victor', '$2a$08$dpanlhwASDqcuaLHBLJBH.rx0M36T77yxKecQW4mZFwZs1nemzBmO', '2022-03-18 15:17:03');