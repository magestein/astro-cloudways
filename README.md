# Astro Starter Kit: Basics

```sh
npm create astro@latest -- --template basics
```

[![Open in StackBlitz](https://developer.stackblitz.com/img/open_in_stackblitz.svg)](https://stackblitz.com/github/withastro/astro/tree/latest/examples/basics)
[![Open with CodeSandbox](https://assets.codesandbox.io/github/button-edit-lime.svg)](https://codesandbox.io/p/sandbox/github/withastro/astro/tree/latest/examples/basics)
[![Open in GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/withastro/astro?devcontainer_path=.devcontainer/basics/devcontainer.json)

> 🧑‍🚀 **Seasoned astronaut?** Delete this file. Have fun!

![just-the-basics](https://github.com/withastro/astro/assets/2244813/a0a5533c-a856-4198-8470-2d67b1d7c554)

## 🚀 Project Structure

Inside of your Astro project, you'll see the following folders and files:

```text
/
├── public/
│   └── favicon.svg
├── src/
│   ├── layouts/
│   │   └── Layout.astro
│   └── pages/
│       └── index.astro
└── package.json
```

To learn more about the folder structure of an Astro project, refer to [our guide on project structure](https://docs.astro.build/en/basics/project-structure/).

## 🧞 Commands

All commands are run from the root of the project, from a terminal:

| Command                   | Action                                           |
| :------------------------ | :----------------------------------------------- |
| `npm install`             | Installs dependencies                            |
| `npm run dev`             | Starts local dev server at `localhost:4321`      |
| `npm run build`           | Build your production site to `./dist/`          |
| `npm run preview`         | Preview your build locally, before deploying     |
| `npm run astro ...`       | Run CLI commands like `astro add`, `astro check` |
| `npm run astro -- --help` | Get help using the Astro CLI                     |

## 👀 Want to learn more?

Feel free to check [our documentation](https://docs.astro.build) or jump into our [Discord server](https://astro.build/chat).

## 🚀 Publicación en Cloudways

Sigue estos pasos para publicar tu aplicación Astro en Cloudways:

### 1. Preparación del servidor

Asegúrate de que PM2 esté instalado en el servidor. Conéctate como usuario master o root y ejecuta:

```sh
curl -s https://raw.githubusercontent.com/ThakurGumansingh/scripts/main/pm2.sh | bash
```

### 2. Preparación de archivos locales

1. Ejecuta `npm run build` en tu proyecto Astro local
2. Prepara los siguientes archivos para subir al servidor

### 3. Subida de archivos al servidor

Sube los siguientes archivos a la carpeta `private_html` del servidor:

- La carpeta `dist` completa (generada por el build)
- `ecosystem.config.cjs`
- `astro.config.mjs`
- `package.json`

Sube los siguientes archivos a la carpeta `public_html` del servidor:

- `.htaccess`
- `index.php`
- `test.php`

### 4. Instalación de dependencias

En el servidor, navega a la carpeta `private_html` y ejecuta:

```sh
npm install
```

### 5. Iniciar la aplicación con PM2

Como usuario master del servidor, dentro de `private_html`, ejecuta:

```sh
pm2 start ecosystem.config.cjs
```

### 6. Verificar el estado

Comprueba que la aplicación está funcionando correctamente:

```sh
pm2 status
```

Guardar configuracion si todo esta corriendo, ejecutar:

```sh
pm2 save
```

También puedes verificar la conexión accediendo a `test.php` desde tu navegador.
