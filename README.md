# 🛠️ SiGePa – Sistema de Gestão Patrimonial

**SiGePa** é um sistema web desenvolvido em **2025** para auxiliar na criação e gestão de **ordens de serviço** da seção de manutenção patrimonial do **3º Batalhão Logístico do Exército Brasileiro**.

Seu objetivo é otimizar o fluxo de solicitações, registro e acompanhamento de serviços relacionados a bens patrimoniais, proporcionando maior controle, organização e transparência nos processos administrativos da seção.

---

## 🎯 Objetivo

Desenvolver uma solução digital customizada para a realidade do ambiente militar, atendendo às necessidades específicas do setor de manutenção patrimonial com foco em praticidade, rastreabilidade e usabilidade.

---

## 🧰 Tecnologias Utilizadas

- **PHP 8.x** com **Laravel 12** – estrutura backend robusta e moderna
- **Filament PHP** – painel administrativo com interface elegante e componentes prontos
- **MySQL** – banco de dados relacional
- **HTML5 & CSS3** – estrutura e layout
- **JavaScript (vanilla)** – interações frontend
- **Blade** – engine de templates do Laravel

---

## 🔐 Funcionalidades Principais

- 🧾 **Cadastro e emissão de ordens de serviço**
- 🛠️ **Classificação por setor, tipo de serviço e responsável**
- 📍 **Acompanhamento do status da manutenção**
- 🧑‍💼 **Painel administrativo com Filament PHP**
- 🧩 **Autenticação com níveis de acesso**

---

## 🐳 Instalação com Docker Compose

### Pré-requisitos

- Docker
- Docker Compose
- Git

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone [https://github.com/seu-usuario/sigepa.git](https://github.com/EmanuelAlderete/sigepa.git)
   cd sigepa
   ```

2. **Inicie os containers**
   ```bash
   docker compose up -d
   ```

3. **Acesse a aplicação**
   - Abra seu navegador e acesse: `http://localhost:8000`
   - O painel administrativo estará disponível em: `http://localhost:8000/app`

### Configuração Automática

O sistema é configurado automaticamente durante o build e inicialização:

- O arquivo `.env` é criado a partir do `.env.example`
- A chave da aplicação é gerada automaticamente
- O banco de dados é inicializado com migrações e seeders
- Os caches são limpos automaticamente
- As permissões dos diretórios são configuradas
- O banco de dados é inicializado com dados de exemplo
