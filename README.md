## Laravel - Eventos e Ingressos

Sistema para cadastro de eventos e vendas de ingressos

## Tecnologias

	- Laravel 5.7
	- MySQL
	- Vue.js
    - Vuex

## Execuções

	Inicialmente deve-se configurar .env de acordo com as configurações do Banco de Dados da máquina em que será utilizado.

    Após a configuração do banco é preciso utilizar os seguintes comandos:
    
    - php artisan migrate
    - php artisan db:seed

    Com isso se terá o banco de dados criado, junto ao usuário administrador padrão.

    - Login: admin@mail.com
    - Senha: admin123

    Também virá por padrão com 3 eventos criados, um já finalizado (portanto não aparecerá na tela inicial), um evento sem ingressos disponíveis para a venda e outro com um lote de ingressos pronto.

## Cadastros

    Primeiramente é necessário cadastrar um evento e seus lotes de ingressos no dashboard do sistema.

    No página inicial do sistema é onde se pode observar a lista de eventos e selecionar um evento para ver seus detalhes. Ao acessar os detalhes do evento poderá se deparar com três situações distintas:

    - Caso não esteja logado, ao clicar em comprar ingressos irá surgir uma tela para realizar login ou registrar-se;
    - Caso esteja logado porém o evento não possui mais ingressos, no lugar do botão de compra estará um aviso de ingressos esgotados;
    - Por fim caso esteja logado e o evento possua ingressos, a opção de compra de ingressos irá abrir um modal para que seja realizada a compra do mesmo.