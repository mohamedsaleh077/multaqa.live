# Architecture Documentation 🏗️

This document outlines the high-level technical architecture of the Multaqa project. It is designed for developers who wish to understand the internal workings of the platform.

---

## 🧱 Core MVC Framework

Multaqa is powered by a custom-built PHP MVC (Model-View-Controller) framework. This "No-Framework" approach ensures maximum performance, a small footprint, and complete control over the application lifecycle.

### 1. Request Lifecycle & Routing (`core\App`)
The `App` class serves as the Front Controller.
- **Bootstrapping:** It parses the `url` parameter from the GET request.
- **Mapping:** It maps the URL components to controllers and methods.
- **Execution:** It dynamically instantiates the appropriate controller and calls the requested method with optional parameters.
- **Convention:** Controllers are expected in `website/app/controllers/` and must follow the naming convention `ucfirst(name)`.

### 2. Base Controller (`core\Controller`)
The foundation of all application controllers.
- **Dependency Management:** Provides the `model()` method to cleanly instantiate models.
- **Template Rendering:** The `view()` method handles passing data to PHP templates.
- **Global Utilities:** Includes shared logic like `dateDiff()` and rate-limiting via `canProcess()`.

### 3. Database Layer & Query Builder
We prioritize security and abstraction without the overhead of a heavy ORM.

- **`core\Database` (Singleton):** Manages a single PDO connection. It uses `config.ini` for environment-specific settings.
- **`core\QueryBuilder`:** A fluent API for safe SQL construction.
  - **Security:** It enforces the use of prepared statements for all dynamic values.
  - **Syntax:** Supports `select`, `insert`, `update`, `delete`, `join`, `where`, and `order`.

### 4. Security & Validation (`core\Validation`)
Security is baked into the core.
- **`Validation` Class:** A centralized service for checking input constraints (length, format, existence).
- **CSRF Mitigation:** Integrated CSRF token generation and verification for all state-changing operations.
- **Captcha Engine:** A custom-built, lightweight captcha system to defend against automated registration and spam.

### 5. Authentication Logic (`core\traits\AuthHelper`)
Uses PHP Traits to provide reusable authentication logic across different controllers (e.g., `Signup`, `Login`, `Profile`).
- Handles secure password verification, session management, and common user-related queries.

---

## 🌐 Frontend & Localization

### Multi-language Support
Multaqa is designed for a global audience with a focus on RTL (Right-to-Left) support.
- **Internationalization (i18n):** Translations are decoupled from the code and stored in `website/public/lang/` as JSON files.
- **Client-Side:** `website/public/scripts/lang.js` provides real-time translation capabilities without page reloads where necessary.

### Modern Styling with Tailwind CSS
- **Tailwind CSS v4:** We utilize the latest Tailwind engine for a utility-first styling approach.
- **Optimization:** Styles are compiled using **Bun**, ensuring a minimal CSS bundle for production.
- **Design System:** Custom components and layouts are defined in `website/public/styles/app.css` using the `@apply` directive to maintain consistency.

---

## 🐳 Infrastructure & Deployment

The entire stack is containerized to ensure "it works on my machine" for every developer.

- **Services:**
  - `webserver`: Apache 2.4 with PHP 8.4-fpm.
  - `database`: MySQL 8.0 with persistent volume storage.
- **Environment Management:** Docker Compose manages the orchestration, networking, and volume mapping between the host and containers.

---

## 🛠️ Development Philosophy

1. **Simplicity over Complexity:** Avoid unnecessary dependencies.
2. **Security by Default:** Sanitize everything, trust nothing.
3. **Performance:** Keep the core lean; only load what is needed.
4. **Transparency:** Code should be easy to read and document.
