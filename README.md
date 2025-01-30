# Sistema Gestão Patrimonial - SiGePA

## Descrição

O **Sistema Gestão Patrimonial** foi desenvolvido para o pelotão de obras do Exército, com o objetivo de gerenciar e controlar as ordens de serviço, tarefas e recursos utilizados nas atividades do pelotão. O sistema foi desenvolvido utilizando o framework **Laravel**, visando proporcionar uma solução eficiente, segura e fácil de usar para a gestão das operações.

## Funcionalidades

-   **Cadastro de Ordens de Serviço**: Permite o registro de novas ordens de serviço, incluindo informações como data, descrição da tarefa, responsável, entre outros.
-   **Acompanhamento de Status**: Acompanhe o progresso de cada ordem de serviço, desde a criação até a conclusão.
-   **Gestão de Tarefas**: Organize e atribua tarefas relacionadas a cada ordem de serviço, com prazos e responsáveis.
-   **Relatórios**: Gere relatórios detalhados sobre as ordens de serviço e tarefas realizadas.
-   **Controle de Recursos**: Registre e controle os recursos necessários para a execução das ordens de serviço (materiais, veículos, equipamentos, etc.).

## Tecnologias Utilizadas

-   **Laravel** (versão 11)
-   **PHP** (versão 8.3)
-   **SQLite**
-   **Filament V3**

## Instalação

1. Clone o repositório para sua máquina local:

    ```bash
    git clone https://github.com/usuario/repo.git
    ```

2. Instale as dependências do projeto:

    ```bash
    cd nome-do-projeto
    composer install
    ```

3. Crie um arquivo `.env` e configure as variáveis de ambiente:

    ```bash
    cp .env.example .env
    ```

4. Gere a chave de aplicativo do Laravel:

    ```bash
    php artisan key:generate
    ```

5. Execute as migrações para criar as tabelas no banco de dados:

    ```bash
    php artisan migrate
    ```

6. Inicie o servidor de desenvolvimento:

    ```bash
    php artisan serve
    ```

    O sistema estará disponível em `http://localhost:8000`.

## Contribuições

Sinta-se à vontade para contribuir com melhorias ou correções. Para isso, faça um fork do repositório e envie um pull request com suas alterações.

## Licença

Este projeto está sob a licença [MIT](LICENSE).

## Contato

Para mais informações, entre em contato com [luisemanuel.alderete@gmail.com](mailto:luisemanuel.alderete@gmail.com).
