# ClickMarket
WebService de vendas de produtos para Supermercado


## 🧬 Etapa 1: Clonar o repositório

Abra seu terminal e execute:

```bash
git clone https://github.com/Edilson-Gomes/ClickMarket.git
cd ClickMarket
```

---

## ⚙️ Etapa 2: Instalar dependências do Laravel

Certifique-se de que você tenha o **PHP** e o **Composer** instalados:

```bash
php -v
composer -V
```

Se não tiver o Composer: [getcomposer.org](https://getcomposer.org)

Agora instale as dependências do projeto:

```bash
composer install
```

---

## 🔐 Etapa 3: Configurar ambiente `.env`

Crie o arquivo `.env` copiando do exemplo:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

No arquivo `.env`, ajuste a configuração do banco SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/absoluto/para/database.sqlite
```

📁 Crie o arquivo `database.sqlite` dentro da pasta `database` se ainda não existir:

```bash
touch database/database.sqlite
```

---

## 🎨 Etapa 4: Instalar frontend (TailwindCSS)

Se o projeto usa `npm` para Tailwind:

```bash
npm install
npm run dev
```

Isso compila os arquivos CSS e JS.

---

## 🧪 Etapa 5: Migrar banco e rodar servidor

Execute as migrations (se houver):

```bash
php artisan migrate
```

Inicie o servidor:

```bash
php artisan serve
```

O Laravel estará rodando em [http://localhost:8000](http://localhost:8000) 🎉

---

### Insira os produtos no seu Banco de Dados - SGBD (Sistema de Gerenciamento de Banco de Dados)
````
INSERT INTO produtos (id, nome, preco, estoque, descricao, imagem, created_at, updated_at) VALUES
(0, 'açúcar', 2.42, 52, 'Açúcar bom de adoçar', 'acucar.jpg', '', ''),
(1, 'alface', 1.90, 25, 'Alface fresca', 'alface.jpg', '', ''),
(2, 'arroz', 3.03, 200, 'Arroz de qualidade', 'arroz.jpg', '', ''),
(3, 'banana', 2.38, 128, 'Banana madura', 'banana.jpg', '', ''),
(4, 'batata', 3.61, 49, 'Batata de mesa', 'batata.jpg', '', ''),
(5, 'café', 4.90, 40, 'Café forte e saboroso', 'cafe.jpg', '', ''),
(6, 'carne bovina', 24.95, 150, 'Corte nobre de carne bovina', 'carne_bovina.jpg', '', ''),
(7, 'carne suína', 14.00, 45, 'Corte de carne suína', 'carne_suina.jpg', '', ''),
(8, 'desodorante', 12.90, 15, 'Desodorante antitranspirante', 'desodorante.jpg', '', ''),
(9, 'detergente', 2.30, 28, 'Detergente para limpeza geral', 'detergente.jpg', '', ''),
(10, 'feijão', 3.94, 97, 'Feijão tipo carioca', 'feijao.jpg', '', ''),
(11, 'laranja', 2.25, 71, 'Laranja doce', 'laranja.jpg', '', ''),
(12, 'leite', 3.98, 95, 'Leite integral', 'leite.jpg', '', ''),
(13, 'maçã', 5.50, 52, 'Maçã fresca', 'maca.jpg', '', ''),
(14, 'macarrão', 4.18, 17, 'Macarrão espaguete', 'macarrao.jpg', '', ''),
(15, 'manteiga', 8.90, 34, 'Manteiga cremosa', 'manteiga.jpg', '', ''),
(16, 'óleo', 3.49, 18, 'Óleo de soja', 'oleo.jpg', '', ''),
(17, 'ovo', 0.40, 450, 'Ovo branco unidade', 'ovo.jpg', '', ''),
(18, 'pão de forma', 3.12, 35, 'Pão de forma tradicional', 'pao_de_forma.jpg', '', ''),
(19, 'peixe', 16.00, 200, 'Filé de peixe fresco', 'peixe.jpg', '', ''),
(20, 'queijo', 21.00, 60, 'Queijo minas', 'queijo.jpg', '', ''),
(21, 'sabonete', 1.99, 26, 'Sabonete perfumado', 'sabonete.jpg', '', ''),
(22, 'shampoo', 12.22, 9, 'Shampoo nutritivo', 'shampoo.jpg', '', ''),
(23, 'tomate', 2.34, 34, 'Tomate italiano', 'tomate.jpg', '', ''),
(24, 'uva', 5.80, 42, 'Uva roxa sem semente', 'uva.jpg', '', '');

````
