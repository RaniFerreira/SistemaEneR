# ⚡ EneR — Sistema de Gerenciamento Individual de Energia em Condomínios Rurais

**EneR** é um sistema web desenvolvido para automatizar o registro de consumo de energia, cálculo automático de valores, geração de boletos informativos e acompanhamento de pagamentos em condomínios rurais.
Ele traz transparência, organização e autonomia para moradores e síndicos, reduzindo erros e eliminando processos manuais.

## 🛠️ Funcionalidades Principais

- 🔐 Cadastro e login de usuários (Morador, Síndico->Ouvidoria)
- ⚡ Registro mensal de consumo (kWh)
- 💰 Cálculo automático do valor da conta
- 📄 Geração de boleto informativo individual
- ✔️ Validação de pagamentos
- 📢 solicitações de correção
- 📚 Listagem de consumo,moradores, boletos e solicitações
- 🔒 Controle de acesso seguro por perfil

## 🖥️ Interface do Sistema

###  Tela de Cadastro de Sindico
<img width="998" height="745" alt="image" src="https://github.com/user-attachments/assets/502fdc3d-23a0-43e0-aebf-e847ae96399d" />

- Um sindico que deseja gerenciar energia em seu condominio rural, pode se cadastrar no sistema.

###  Tela de Login
<img width="920" height="544" alt="image" src="https://github.com/user-attachments/assets/41f02f0d-0189-4a38-af1f-6d200ad08473" />

- Login seguro
- Permite acesso conforme o tipo de usuário (Morador, Síndico->Ouvidoria).
- Validação de credenciais via banco de dados.

###  Painel do Sindico
<img width="1235" height="872" alt="image" src="https://github.com/user-attachments/assets/9e9aeadd-4e8c-416e-a76e-42fac458fb41" />

- Permite que o síndico cadastre moradores
- Listar os moradores cadastrado no condiminio
- Gerenciar os consumos e boletos de cada morador
- Permite ao sindico validar o pagamento do boleto de cada morador
- Solicitar uma correção
- Visualizar suas proprias reclamaçoes
- Permite ao sindico ir para o painel de ouvidoria

###  Painel Ouvidoria
<img width="1845" height="877" alt="image" src="https://github.com/user-attachments/assets/661df042-11bf-4cda-b97c-3a0e5bb7b4fc" />

- A ouvidoria é acessada através do Login do Sindico
- Espaço para tomar deciçoes importantes
- Permite gerenciar as reclamaçoes de todos os moradores e as proprias(interna)
- A ouvidoria permitirá filtrar as solicitações
- Visualizar as sreclamaçoes Aprovadas
- Visualizar as reclamaçoes Reprovadas
- Visualizar novas solicitações

###  Painel Morador
<img width="1851" height="854" alt="image" src="https://github.com/user-attachments/assets/3907dd4b-9a53-4de4-b2b0-e2fb51e411a9" />

- Permite ao morador inserir uma nova leitura de Kwh
- Solicitar correções
- Listar as reclamações
- Visualizar os boletos de forma informativa e acompanhar o status do mesmo.
- Permite que o morador após a tranferencia do pagamento, clicar em pagar o boleto, e aguardar a confirmação do síndico.


## 🗂️ Estrutura do Projeto(MVC)
<img width="634" height="677" alt="image" src="https://github.com/user-attachments/assets/1d286c91-0bf5-45dd-b067-d28076941632" />

## 💻 Tecnologias Utilizadas

- **PHP** (backend)
- **MySQL** (banco de dados)
- **HTML5 / CSS3**
- **JavaScript**
- **VSCode**

## 💻 Requisitos para execução

- Apache (XAMPP, WAMP ou similar)  
- PHP 7.4 ou superior  
- MySQL 5.7+  
- Navegador atualizado

## 🚀 Instalação 

Siga os passos abaixo para configurar e executar o **sistemaEneR** no XAMPP.

---

## 📥 1. Baixar o script do banco de dados

- Baixe o script do banco sistemaEner.txt fornecido na pasta do projeto
- Crie o banco por meios de suas escolha

## 📥 2. Fique atento a configuração da aplicação com o banco

- Altere seu arquivo ConnectionFactory_class.php conforme a necessidade de configuração do seu banco

<img width="518" height="311" alt="image" src="https://github.com/user-attachments/assets/dddb25a3-7145-4da8-919d-dfcd59d1a99e" />

## 📥 3. Coloque o projeto no lugar correto

- Acesse o disco (C:)
- Acesse a pasta do xamp
- Após acessar a pasta do xamp, coloque o projeto dentro da pasta htdocs

## 📥 4. Acesse a aplicação pelo navegador

- Com Apache e MySQL iniciados no XAMPP, abra: http://localhost/sistemaEneR
- Após todos esse passo, a aplicação todara a index por padrão, que esta configurada para chmar a tela de cadastro de Síndico
- Caso ja seja um síndico cadstrado, basta ir para a página de Login

# 🎉 Começando a usar o sistema

### Vamos lá, agora que o banco está criado, você pode popular o mesmo através do uso da aplicação. 

###  Este é um passo a passo para a usabilidade do sistema, mas não significa que tem que ser nessa exata ordem.

## 👤 1. Crie seu usuário Síndico

1. Na tela inicial, clique em **Cadastrar Síndico**.
2. Após salvar, faça login.
3. através do login do sindico va para o painel de ouvidoria se quiser
4. Visualize e trate as reclamações

## 🏠 2. Cadastre seus moradores

Dentro do painel do síndico:

1. Clique em **Cadastrar Morador**.  
2. Informe todos os dados.
3. Depois, abra **Listar Moradores** para conferir seu cadastro.

Você pode adicionar quantos moradores quiser.

---

## ⚡ 3. Explore as funções do Painel do Síndico

No painel, você poderá:

- Gerenciar moradores  
- Registrar consumos  
- Ver boletos informativos  
- Validar pagamentos  
- Ir para o painel de ouvidoria tratar reclamações  
- Acompanhar o status do boleto de cada morador  

Aproveite para testar todas as funcionalidades.

---

## 🧑‍💻 4. Teste o sistema logando como morador

Pegue o e-mail e senha de um morador que você cadastrou e faça login usando essas credenciais.

No painel do morador você pode:

- Registrar seu consumo
- Ver seu boleto informativo
- pagar boleto
- solicitar correções

Teste à vontade!

---

## 🎯 O sistema já está pronto para ser explorado

A partir desses passos, você já pode:

- Popular o banco usando a própria aplicação  
- Testar todos os módulos  
- Criar cenários completos de uso  
- Simular interações entre Síndico e Morador
  
Siga o fluxo que quiser

## 🔒 Observações

- As sessões são controladas com segurança utilizando `$_SESSION`, garantindo que cada usuário acesse apenas as áreas autorizadas.
- Toda a geração de boletos informativos e relatórios é feita diretamente a partir do banco de dados.


---

## 📄 Licença

![License](https://img.shields.io/badge/license-Acad%C3%AAmico-blue.svg)
![Status](https://img.shields.io/badge/status-Ativo-success.svg)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4.svg?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1.svg?logo=mysql)
![XAMPP](https://img.shields.io/badge/XAMPP-Local-orange.svg?logo=xampp)

Este projeto foi desenvolvido **com fins acadêmicos**, como parte dos estudos de **Engenharia de Software**.  
Ele ainda possui diversas melhorias a serem implementadas e representa apenas o começo de uma longa e promissora jornada de evolução e aprendizado.


---

## 👨‍💻 Autor

**Ranielly Ferreira dos Santos**  
Desenvolvedora FullStack do sistemaEneR 
IFTM – Engenharia de Software 3

