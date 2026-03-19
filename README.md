# Quadque Admin

The centralized administration panel for **Quadque Technologies**. Built with Laravel 8 and Vue 3, this application provides the master control interface for managing all aspects of the Quadque digital platform, with Docker support for streamlined deployment.

Part of the **Quadque digital platform ecosystem**.

---

## Features

- Centralized admin panel for full platform management
- Vue 3 SPA with Vue Router for client-side navigation
- Vuex state management for consistent application data flow
- Laravel Sanctum API authentication and CORS support
- Docker and Docker Compose support for containerized deployment
- MySQL database with automated container orchestration
- Modular Vue component architecture with single-file components
- Axios HTTP client for API communication
- Laravel Mix build pipeline for asset compilation
- Blade template integration for server-rendered shell

## Tech Stack

| Layer        | Technology                                       |
|--------------|---------------------------------------------------|
| Backend      | PHP 7.3+/8.0, Laravel 8                          |
| Frontend     | Vue 3, Vue Router 4, Vuex 4                      |
| Auth         | Laravel Sanctum                                   |
| HTTP Client  | Axios                                             |
| Build        | Laravel Mix 6, Webpack                            |
| Containers   | Docker, Docker Compose                            |
| Database     | MySQL                                             |
| Testing      | PHPUnit 9, Mockery, Faker                         |

## Getting Started

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js >= 14
- MySQL (or Docker)

### Installation

```bash
git clone https://github.com/mhmalvi/quadque-admin.git
cd quadque-admin
composer install
npm install
```

### Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials and application settings.

### Docker Deployment

```bash
docker-compose up -d
```

This starts the application on port **13000** with a MySQL instance on port **13336**.

### Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### Development

```bash
php artisan serve
npm run dev
```

### Production Build

```bash
npm run production
```

## Project Structure

```
quadque-admin/
├── app/                 # Application logic (Models, Controllers, Middleware)
├── bootstrap/           # Framework bootstrap
├── config/              # Configuration files
├── database/
│   ├── factories/       # Model factories
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── public/              # Compiled assets and entry point
├── resources/
│   ├── js/              # Vue 3 components, router, and store
│   ├── views/           # Blade templates
│   ├── css/             # Stylesheets
│   └── lang/            # Localization files
├── routes/
│   ├── api.php          # API routes
│   └── web.php          # Web routes
├── storage/             # Logs, cache, and uploads
├── tests/               # Test suites
├── Dockerfile           # Container build definition
├── docker-compose.yml   # Multi-container orchestration
└── webpack.mix.js       # Laravel Mix configuration
```

## License

Proprietary — Quadque Technologies. All rights reserved.
