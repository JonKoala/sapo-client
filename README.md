# SAPO-CLIENT
Client para o sistema SAPO (Sistema de Auditoria de Portais).

## Requisitos
 - [Node](https://nodejs.org) >= 6.9
 - [Bower](https://bower.io)

## Instalação
Clone o projeto para a sua máquina e acesse o diretório do mesmo.
``` bash
git clone https://github.com/JonKoala/sapo-client.git
cd sapo-client
```
Instale as dependências.
``` bash
npm install
```
Instale os components.
``` bash
bower install
```

## Configuração
O projeto depende de um arquivo `appconfig.json`, na sua raiz, contendo algumas configurações locais. Crie uma cópia do arquivo `appconfig.json.example` e coloque as configurações do seu ambiente.

Exemplo de `appconfig.json`:
``` javascript
{
  "url": {
    "api": "http://localhost:8080"
  },
  "server": {
    "port": "8081"
  }
}
```

## Execução
Para subir o servidor de Client, basta executar o comando `start` do _npm_.
``` bash
npm start
```
Caso não ocorra nenhum erro, um servidor deve ser criado, usando a porta especificada no `appconfig.json` (_e.g `http://localhost:8081/`_)
