# Laravel Medium Clone

## Getting Started

Follow these steps to set up and run the application locally:

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- SQLite (or another supported database)

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/thibault-castelli/laravel-medium-clone.git
   cd laravel-medium-clone
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```sh
   npm install
   ```

4. **Copy the example environment file and configure:**
   ```sh
   cp .env.example .env
   ```
   Edit `.env` to set your database and other environment variables.

5. **Generate application key:**
   ```sh
   php artisan key:generate
   ```

6. **Run migrations and seed the database:**
   ```sh
   php artisan migrate --seed
   ```

7. **Build frontend assets:**
   ```sh
   npm run build
   ```

8. **Start the development server:**
   ```sh
   php artisan serve
   ```

9. **Access the app:**
   Open [http://localhost:8000](http://localhost:8000) in your browser.
