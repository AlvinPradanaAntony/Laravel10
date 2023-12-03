## MyDashboard

Esse projeto nasceu da necessidade de um kit inicial, simples e fácil de personalizar. O projeto MyDashboard é um kit inicial para laravel, construido com Vue.JS 3, Inertia JS e Tailwind CSS 3. O design foi inspirado no [Admin One Dashboard](https://github.com/justboil/admin-one-vue-tailwind), utilizando-se de alguns de seus componentes modificados, a saber: Chart e CardWidget. Utilizou-se também código referente à funcionalidade de Modo Claro e Escuro.

## Tecnologias Primarias

- [Vue.JS 3.x](https://vuejsbr-docs-next.netlify.app/)
- [Inertia JS](https://inertiajs.com/)
- [Tailwind CSS 3.x](https://tailwindcss.com/docs/guides/laravel)
- [Pinia](https://pinia.vuejs.org/introduction.html)
- [Font Awesome](https://fontawesome.com/search?s=solid%2Cbrands)
- [Vuelidate](https://vuelidate.js.org/)

## Características

- Autenticação Simples (Usuário)
- Autenticação Multipla (Usuário e Admin)
- Página de Login
- Página de Registro
- Pagina de Perfil
- Upload de Imagem de Perfil
- Modo Claro e Escuro
- Responsividade

## Compatibilidade

Foi desenvolvido para o Laravel 8.x, portanto, funciona perfeitamente nessa versão. Para versões inferiores a 8.x, provavelmente, será necessário alterações adicionais, já nas versões superiores, talvez não será necessário.

## Mais Detalhes

Esse repositório tem como objetivo compartilhar o conhecimento, pois nada melhor que pegar algo e fazer manualmente, acompanhando cada etapa do processo, adquirindo um conhecimento solido. Com base nesse objetivo será apresentado o passo a passo de como fazer essa implementação manualmente. Para o dia a dia, em breve, será desenvolvido um [pacote](https://github.com/wagner-m-alves) que poderá ser instalado via o Composer.

## Implementação Manual

### Instalar Laravel 8.x e Dependências Básicas

1. Instale um novo projeto Laravel 8.x, utilizando o comando abaixo. Lembre-se de substituir `new-project` pelo nome do seu projeto.
```
composer create-project laravel/laravel:^8.0 new-project
```

2. Acesse a raiz de seu novo projeto Laravel, no qual deseja implementar o MyDashboard, utilizando o comando abaixo:
```
cd caminho-do-seu-projeto-laravel
```

3. Instale o pacote `Ziggy` (pacote que fornece a função global route para o JavaScript), utilizando o comando abaixo:
```
composer require tightenco/ziggy
```

### Instalar Vue.JS 3.x

1. Instale o Vue.JS 3.x, utilizando o comando abaixo:
```
npm install vue
```

2. Crie o arquivo `app.js` no diretório `resources/js` do seu novo projeto Laravel e adicione o conteúdo abaixo:
```
import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { createPinia } from 'pinia'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const pinia = createPinia()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(pinia)
      .use(ZiggyVue, Ziggy)
      .mount(el)
  },
})
```

### Instalar Inertia

1. Instale os adaptadores do lado do servidor, utilizando o comando abaixo:
```
composer require inertiajs/inertia-laravel
```

2. Crie ou modifique o arquivo `resources/view/app.blade.php`, conforme o conteúdo abaixo (caso o arquivo já exista, lembre-se de renomeá-lo para app.blade.php:
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0" />

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
```

3. Crie o middleware do Inertia, utilizando o comando abaixo:
```
php artisan inertia:middleware
```

4. Registre o middleware criado no passo anterior, acrescentando a linha abaixo na seção `web` do arquivo `app/http/kernel.php`:
```
\App\Http\Middleware\HandleInertiaRequests::class,
```

5. Instale as dependências do lado cliente, utilizando o comando abaixo:
```
npm install @inertiajs/inertia @inertiajs/inertia-vue3
```

### Instalar Pinia
1. Instale o Pinia, utilizando o comando abaixo:
```
npm install pinia
```
Obs: Caso o comando acima apresente erro, use: **npm install --legacy-peer-deps pinia**

2. Adicione o Pinia como plugin no arquivo `app.js`, presente no diretório `resources/js` de seu novo projeto laravel.
```
...
import { createPinia } from 'pinia'

const pinia = createPinia()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(pinia)
      .use(ZiggyVue, Ziggy)
      .mount(el)
  },
})
...
```

### Instalar Font Awesome
1. Instale os seguintes pacote, utilizando os comandos abaixo:
```
npm i --save @fortawesome/fontawesome-svg-core
npm i --save @fortawesome/free-solid-svg-icons
npm i --save @fortawesome/free-regular-svg-icons
npm i --save @fortawesome/free-brands-svg-icons
npm i --save @fortawesome/vue-fontawesome@prerelease
```

2. Crie um arquivo com o nome `fontawesome-icons.js` em `resources/js`

3. Insira o conteúdo abaixo no arquivo criado
```
import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

library.add(fas, far, fab)
dom.watch();
```

4. Acrescente a linha abaixo ao arquivo `app.js`, presente no diretório `resources/js`:
```
import ‘./fontawesome-icons’;
```

### Instalar Vuelidate
1. Instale o Vuelidate, utilizando o comando abaixo:
```
npm install @vuelidate/core @vuelidate/validators
```

### Instalar Tailwind CSS 3.x

1. Instale o Tailwind CSS, utilizando o comando abaixo:
```
npm install -D tailwindcss postcss
npx tailwindcss init
```

2. Adicione o Tailwind CSS ao Laravel Mix, adicionando a linha abaixo dentro do `postcss`,  no arquivo `webpack.mix.js`, localizado na raiz do projeto:
```
require("tailwindcss"),
```

3. Modifique o arquivo `tailwind.config.js`, localizado na raiz do projeto, de forma que fique igual ao exemplo abaixo:
```
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
            'gray-850':'#141e2c',
            'gray-750':'#1a2432',
            },
        },
    },

    plugins: [],
}
```

4. Adicione o conteúdo abaixo no arquivo `resources/css/app.css`:
```
@tailwind base; 
@tailwind components; 
@tailwind utilities;
```

### Configurações Finais

1. Adicione o Vue no arquivo `webpack.mix.js`, localizado na raiz do projeto. Certifique-se de que seu arquivo fique semelhando ao exemplo abaixo:
```
mix.js('resources/js/app.js', 'public/js')
.vue()
.postCss('resources/css/app.css', 'public/css', [
	require("tailwindcss")
]);
```

2. Abra o arquivo `webpack.mix.js`, presente na raiz do seu novo projeto Laravel para adicionar alias ao seu projeto. Certifique-se de que o seu arquivo fique conforme apresentado abaixo:
```
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
        require('autoprefixer')
    ])
    .alias({
        '@': 'resources/js',
    });

if (mix.inProduction()) {
    mix.version();
}
```

### Dependências Secundárias

1. Instale e atualize as dependências, utilizando os comandos abaixo:
```
npm install chart.js numeral -D
npm install autoprefixer@10.4.5 -D --save-exact
```

### Configuração do Autoprefixer

1. Adicione, caso não esteja pronto, `require('autoprefixer')` às opções de plug-in PostCSS no arquivo `webpack.mix.js`, presente na raiz de seu projeto Laravel.


### Obter Arquivos Necessários

1. Clone esse repositório, utilizando o comando abaixo:
```
git clone https://github.com/wagner-m-alves/my-dashboard.git
```

### Copia de Arquivos

1. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o conteúdo do diretório `resources/js`, exceto os arquivos `app.js`, `bootstrap.js` e `fontawesome-icons.js`, para o diretório `resources/js` do seu novo projeto Laravel.

2. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie os diretórios `app/Http/Controllers/Auth`, `app/Http/Controllers/Site`, `app/Http/Controllers/Usr` e `app/Http/Controllers/Admin` para o diretório `app/Http/Controllers` do seu novo projeto Laravel.

3. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o diretório `app/Http/Requests` para o diretório `app/Http` do seu novo projeto Laravel.

4. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o arquivo `app/Http/Middleware/HandleInertiaRequests.php` para o diretório `app/Http/Middleware` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

5. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o diretório `app/routes/auth` para o diretório app/routes` do seu novo projeto Laravel.

6. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie os arquivos `app/routes/admin.php`, `app/routes/site.php`, `app/routes/web.php` para o diretório `app/routes` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

7. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o diretório `app/Models/Traits` para o diretório `app/Models` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

8. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie os arquivos `app/Models/Admin.php` e `app/Models/User.php` para o diretório `app/Models` do seu novo projeto Laravel, de modo a substituir o arquivo existente.    

9. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie os arquivos `database/migrations/2014_10_12_000000_create_users_table.php` e `database/migrations/2014_10_12_000001_create_admins_table.php` para o diretório `database/migrations` do seu novo projeto Laravel, de modo a substituir o arquivo existente.    

10. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o diretório `app/Observers` para o diretório `app` do seu novo projeto Laravel.   

11. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o diretório `app/Console/Commands` para o diretório `app/Console` do seu novo projeto Laravel.

12. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o arquivo `config/auth.php` para o diretório `config` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

13. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o arquivo `app/Providers/RouteServiceProvider.php` para o diretório `app/Providers` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

14. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o arquivo `app/Exceptions/Handler.php` para o diretório `app/Exceptions` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

15. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o arquivo `app/Http/Middleware/AdminRedirectIfAuthenticated.php` para o diretório `app/Http/Middleware` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

16. Acesse os arquivos do repositório clonado no passo 1 da subseção `Obter Arquivos Necessários` e copie o arquivo `app/Http/Kernel.php` para o diretório `app/Http` do seu novo projeto Laravel, de modo a substituir o arquivo existente.

### Compilar Arquivos

1. Compile os arquivos css e js, utilizando o comando abaixo:
```
npm run dev
```
Obs: Caso dê algum erro relacionado ao autoprefixer, delete o diretório node_modules e rode os seguintes comandos: `npm install` e `npm run dev`

### Configuração de Ambiente

1. Abra o arquivo `.env` e insira os dados de sua configuração do banco de dados.

###  Migração de Banco de dados

1. Para rodar a migração de banco de dados, utilize o comando abaixo:
```
php artisan migrate
```

### Criar Admin de Testes

1. Para criar um administrador de testes, utilize o comando abaixo:
```
php artisan admin:register Admin admin@test.com 12345678
```
### Autenticação Simples

1. Caso deseje utilizar apenas a autenticação simples, ignore os arquivos e diretórios relacionados ao `admin` nos passos `2`,`3`, `6`, `7`, `9`, `10` e `12` do tópico `Copia de Arquivos`.

2. Ignore completamente o passo `12` e `13` do tópico `Copia de Arquivos`.
