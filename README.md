# teste-netshow.me

## Teste Prático para Netshow.me
![](https://i.imgur.com/teNwOs2.png)

#### Feito com: Yii2

## Criando Banco de Dados
#### MySQL

```
CREATE DATABASE IF NOT EXISTS netshow;

USE netshow;

CREATE TABLE IF NOT EXISTS contato (
	nome VARCHAR(50),
	telefone VARCHAR(20),
	email VARCHAR(50),
	mensagem TEXT,
	file_dir TEXT,
	ip VARCHAR(20),
	data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
```

## Instalação
```
git clone https://github.com/eduardoedson/teste-netshow.me.git
cd teste-netshow.me
```

#### Configure o caminho do banco de dados
```cd config/```
- Edite o arquivo db.php com as informações do seu banco

#### Configurar o E-mail que receberá
- Na mesma pasta edite o arquivo params.php alterando ```email@exemplo.com``` para o e-mail desejado

### Rodando os testes
- Volte para a raíz do projeto e execute ```php vendor/bin/codecept run unit```

### Rodando a aplicação
- Na raíz do projeto execute ```php yii2 serve --port=8081```
- No navegador acesse ```http://localhost:8081/```




