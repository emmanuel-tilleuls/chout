# Application de chat (Chout)

## Utilisation
- dans répertoire `infrastructure`
  - `docker compose up --wait`

- dans répertoire `api`
  - `symfony console doctrine:schema:create`
  - `symfony console doctrine:fixture:load`
  - `symfony serve --no-tls -d`

- dans répertoire `pwa`
  - `npm install`
  - `npm run dev`

- avec des navigateurs web aller sur http://localhost:5173
- entrer un nom dans «Author» et cliquer sur «Login»
- entrer un message en bas de la liste des messages et cliquer sur «Post»
