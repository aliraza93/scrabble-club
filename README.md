## Tech Stack

- PHP 8.3
- Composer 2.7.6
- Node 20.14.0
- NPM 10.7.0
- Vue 3
- Tailwind CSS 3.4.4
- Inertia

## Steps to run the project

``git clone https://github.com/mhsyharis/scrabble-club.git``

``cd/scrabble-club``

``composer install``

``cp .env.example .env``

``php artisan key:generate``

Open the .env file and configure the database connection details:

``php artisan migrate:fresh --seed``

``npm install``

``npm run dev``

``php artisan serve``

## Project Summary

A system for a scrabble club to manage and view members' scores and contact details.

### Key Features

1. **Member Profile Page:**
   - Date joined
   - Average score
   - Highest score (details)
   - Total games played
   - Recent games

2. **Leaderboard Page:**
   - Top 10 members by average score, their ranking and number of games played.

3. **Game Recording:**
   - At least 2 players per game
   - Highest score wins

### Functional Requirements

- Eloquent relationships
- Migrations
- Validation
- CRUD operations
- Simple UI (Vue.js, Inertia and Tailwind CSS)
- Seeders/Factories
- Regular Git commits

### Goals

- Maintainable and scalable
- User-friendly interface

### Best Coding Standards

- **Validations:** All data input is validated using Laravel's robust validation features to ensure data integrity and security.
- **Store/Update Requests:** Using Form Request classes to encapsulate the validation logic and authorization checks for storing and updating records.
- **CRUD Operations:** Implemented with pagination and search functionality to enhance the user experience and handle large datasets efficiently.
- **Code Quality:** Adhering to PSR-12 coding standards, using meaningful variable names, and maintaining clean and readable code.
- **Regular Commits:** Frequent commits with clear messages to track progress and changes systematically.