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

## Notes for development
- to run the project, you need docker compose, use:
```bash
docker compose --build -d up
```

- Tailwind CSS for development:
```bash
npm run dev 
```
or 
```bash
bun run dev
```
to install bun on linux: `curl -fsSL https://bun.com/install | bash` or use `npm` whatever

- tailwind for production:
```bash
npm run build
```
or
```bash
bun run build
```