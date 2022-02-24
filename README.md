# SistemCar Laravel 8 API REST com JWT
  Sistema desenvolvido como objetivo de estudo, utilizando as stacks Vue js 3 consumindo uma Api laravel 8 Rest com JWT.
  
  
# Back-end
  Api rest desenvolvida com laravel 8 utiliza:
    - Autenticação via JWT.    
    

# Banco de dados
  A aplicação teve como testes os bancos mysql e também postgres.
  - Para criação do banco de dados foram criados migrations com a estrutura das tabelas.
  - Com a intenção de inserir registros para teste foram criados Factorys com o pacote Faker para gerar dados fictícios.
  - Concluindo a inserção de registros foram criados Seeders.


# O sistema se encontra no online através da plataforma Heroku
    link de acesso: atualmente em manutenção.
    
    
# Os arquivos foram armazenados contendo todas as pastas
    Incluindo as pastas dos pacotes.
    Caso haja problemas pode-se atualizar os pacotes via npm e composer.
    
    
# Documentação
  A api se encontra com seus métodos comentados e documentados.
  O front apresenta métodos com nomes intuitivos de modo a se tornar mais fácil a compreensão.
  
  
# Observação
  Projeto desenvolvido para estudo, versão simples, podendo ser atualizado e otimizado.
  
  
# Possíveis futuras interações:
  - Atualização de versão.
  - Otimizações de código.
  - Aplicação de teste automatizados.
  - Mapear e gerar documentação dos end-poits da API, através da ferramenta swagger.


# Orientações para teste local
  - Realize o download ou clone e execute o comando composer install.
  - Configue o arquivo .inv com as informações de acesso ao banco de dados:
  
        DB_CONNECTION=mysql         -> Drivers de conexão, caso use postgres deve instalar alguns 
                                       arquivos complementares para realizar o acesso.
        DB_HOST=127.0.0.1           -> Endereço de acesso
        DB_PORT=3306                -> Porta de acesso
        DB_DATABASE=my_db           -> nome do seu banco de dados
        DB_USERNAME=root            -> usuário do seu banco de dados
        DB_PASSWORD=                -> senha de acesso ao seu banco de dados
        
  - Realize a geração do jwt:key com o comando: php artisan jwt:secret
  - Crie a estrutura do banco de dados com o comando: php artisan migrate
  - Caso queira popular o banco de dados com informações de teste use o comando: php artisan db::seed  
    gerando registros de clientes e um usuário padrão com as credenciais admin@admin.com e senha admin9999
  - Realizado as etapas anteriores, pode-se rodar a api executando o comando: php artisan serve
