# Multaqa Project GR
special thanks for Zeyad Mostafa for helping me with docker and Tailwind!

test on: https://multaqa.live

## Technologies
- HTML
- CSS
- Java Script
- JQuery
- Tailwind
- PHP
- MySQL
- Docker

## what I learnt?
- make a basic MVC project
- using @apply in css
- Tailwind
- Localization

## Database
you can read about it see documentation [here](DB.md)

# Notes for development

### to run the project, you need docker compose, use:
```bash
docker compose --build -d up
```
composer is installed in webserver docker image, run `composer install` from the image shell in `app/`.
### Tailwind CSS for development:
- initialize bun:
```bash
bun install
```

- for development:
```bash
bun run dev
```

- for production:
```bash
bun run build
```