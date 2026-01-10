# Multaqa (ملتقى) 🤝

Multaqa is a professional, community-driven social platform built with a commitment to simplicity, privacy, and meaningful interactions. Developed with a modern custom MVC architecture, it aims to revive the essence of classic online forums while delivering a sleek, high-performance experience.

[![Test Site](https://img.shields.io/badge/Test--Site-multaqa.live-blue?style=for-the-badge)](https://multaqa.live)
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg?style=for-the-badge)](https://www.gnu.org/licenses/gpl-3.0)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

---

## 🚀 Key Features

- **Custom MVC Engine:** A lightweight, high-performance PHP framework built from the ground up.
- **Spaces (Communities):** Dedicated areas for focused discussions, each with its own identity.
- **Privacy First:** Designed with anonymity options and secure data handling.
- **Localization:** Robust multi-language support, featuring a seamless Arabic experience.
- **Modern Security:** Built-in CSRF protection, secure password hashing (BCrypt), and custom Captcha systems.
- **Developer Friendly:** Fully containerized with Docker for "one-command" setup.

---

## 🛠️ Technology Stack

- **Backend:** PHP 8.4 (Custom MVC Framework)
- **Database:** MySQL 8.0
- **Frontend:** HTML5, Tailwind CSS v4, JavaScript (ES6+), jQuery
- **Infrastructure:** Docker & Docker Compose
- **Tooling:** Bun (Frontend Assets), Composer (PHP Dependencies)

---

## 🏗️ Architecture & Design

Multaqa follows a strict Model-View-Controller separation to ensure maintainability and scalability.

- **Routing:** Intelligent URL parsing and controller dispatching.
- **Query Builder:** A fluent, secure interface for database interactions to prevent SQL Injection.
- **Validation:** Centralized input validation layer with security-first principles.

For a deep dive, see [ARCHITECTURE.md](ARCHITECTURE.md).

---

## 📦 Self-Hosting Guide

Hosting your own Multaqa instance is designed to be straightforward.

### Prerequisites
- [Docker](https://www.docker.com/get-started) and Docker Compose.
- (Optional) [Bun](https://bun.sh/) if you wish to modify frontend styles.

### Deployment Steps

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-repo/multaqa.git
   cd multaqa
   ```

2. **Environment Configuration:**
   Copy the example configuration (if available) or ensure `website/app/config.ini` is set up correctly for your environment.

3. **Launch with Docker:**
   ```bash
   docker compose up -d --build
   ```

4. **Install Dependencies:**
   ```bash
   docker exec -it multaqa-webserver-1 composer install
   ```

5. **Database Initialization:**
   The database schema is automatically applied via the Docker volume mounts in the `db/` directory.

The platform should now be accessible at `http://localhost`.

---

## 💻 Development Guide

We've optimized the workflow for developers to get started quickly.

### Frontend Workflow
We use **Tailwind CSS v4** managed by **Bun**.
- **Install JS deps:** `bun install`
- **Watch Mode:** `bun run dev` (automatically recompiles CSS on changes).
- **Production Build:** `bun run build`.

### Backend Workflow
- Controllers are located in `website/app/controllers/`.
- Models are in `website/app/models/`.
- Views use standard PHP templating in `website/app/views/`.

### Coding Standards
- Follow PSR-12 for PHP.
- Use the built-in `QueryBuilder` for all DB operations.
- Ensure all POST requests include a CSRF token.

---

## 🤝 Contributing & Acknowledgments

Multaqa is a community effort. We are incredibly grateful to those who have helped shape this project.

### Featured Contributors
- **ZeyadMostafaKamal**: Mastermind behind the **Docker** infrastructure and **Tailwind CSS** integration.
- **mahmoudochrom**: Instrumental in driving the **localization** and translation efforts.

See our full [Hall of Fame](CONTRIBUTORS.md) for more details.

---

## 📜 License

This project is licensed under the **GPLv3 License**. See the [LICENSE](LICENSE) file for details.

---
*Developed with passion 🇪🇬 by the Multaqa Community.*