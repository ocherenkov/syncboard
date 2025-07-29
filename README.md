# SyncBoard

This Laravel-based project simulates the integration of two external systems - **Firma** (warehouse) and **Linker** (
CRM) - and displays analytical product data in a single dashboard.

## System Requirements

- PHP 8.2 or higher
- Composer

## Installation

1. Clone the repository:
   ```bash
   git clone git@github.com:ocherenkov/syncboard.git
   cd syncboard
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Configure the `.env` file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up the database connection. By default SQLite is used. Make sure to create a SQLite database file before
   proceeding:
   ```bash
   touch database/database.sqlite
   ```
   Update the `.env` file with the following configuration:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/full/path/to/database/database.sqlite
   ```
   Alternatively, you can configure another database driver, such as MySQL or PostgreSQL:
    - **MySQL**:
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=your_username
      DB_PASSWORD=your_password
      ```
    - **PostgreSQL**:
      ```
      DB_CONNECTION=pgsql
      DB_HOST=127.0.0.1
      DB_PORT=5432
      DB_DATABASE=your_database_name
      DB_USERNAME=your_username
      DB_PASSWORD=your_password
      ```
   Be sure to install and configure the selected database server properly before proceeding.

5. Run migrations and seeders to generate test data:
   ```bash
   php artisan migrate --seed
   ```

6. Start the local development server:
   ```bash
   php artisan serve
   ```

   The application will be available at: http://127.0.0.1:8000

## Test Data

To populate the database with test data, you can either run the command:

   ```bash
   php artisan sync:data
   ```

## Running the Scheduled Task (Cron)

To synchronize data between the systems, you need to set up a cron job to run hourly:

1. Open the cron table for editing:
   ```bash
   crontab -e
   ```

2. Add the following line to run the command every hour:
   ```
   * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
   ```

## Viewing the Product Table

After starting the application, navigate to: http://127.0.0.1:8000/products

On the page, you will see a table displaying products with the following features:

- Data from both systems (Firma and Linker) is displayed.
- Differences in price or quantity are highlighted in red.
- Filtering by categories is available.
- Sales information from the last 7 days is displayed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
