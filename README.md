# Library Book Tracking Application

This application allows two libraries to track their books and loan them to their registered users. The books can be marked as either available or loaned to a member, making them unavailable to other users.

## Features

- Database models and migrations (with indexing and constraints where appropriate)
- Relationships between data models
- Routing (both web and API based)
- Request validation
- Security (users can only borrow a book belonging to their library)
- API endpoint to retrieve all books with usage of `JsonResource`
- Scalability

I needed clarification on what was meant by "Centralisation of logic where applicable (e.g. ISBN assignment)"

## Installation

1. Clone the repository: `git clone https://github.com/your-repo.git`
2. Run `composer install` to install dependencies
3. Create a new database and update the `.env` file with the correct credentials
4. Run database migrations: `php artisan migrate`

## Usage

### Web Routes

- `GET /libraries` - show a list of libraries
- `GET /libraries/{library}` - show a specific library
- `GET /books` - show a list of all books
- `GET /books/{book}` - show a specific book
- `GET /users` - show a list of all registered users
- `GET /users/{user}` - show a specific user
- `GET /loans` - show a list of all book loans
- `GET /loans/{loan}` - show a specific book loan
- `POST /loans` - create a new book loan
- `PUT /loans/{loan}` - update a book loan
- `DELETE /loans/{loan}` - delete a book loan

### API Routes

- `GET /api/libraries` - show a list of libraries
- `GET /api/libraries/{library}` - show a specific library
- `GET /api/books` - show a list of all books
- `GET /api/books/{book}` - show a specific book
- `GET /api/users` - show a list of all registered users
- `GET /api/users/{user}` - show a specific user
- `GET /api/loans` - show a list of all book loans
- `GET /api/loans/{loan}` - show a specific book loan
- `POST /api/loans` - create a new book loan
- `PUT /api/loans/{loan}` - update a book loan
- `DELETE /api/loans/{loan}` - delete a book loan

## Request Validation

The following fields are required for each request:

### Books

- `title`
- `author`
- `isbn`
- `library_id`

### Users

- `name`
- `email`
- `password`
- `library_id`

### Loans

- `book_id`
- `user_id`
- `status`

## Security

- Users can only borrow books from their associated library.
- Users cannot borrow books that are already out with another user.
- Users cannot borrow books that are not available in their library.

## JsonResource

The `BookResource` class is used to format book data as JSON.

## Presets / Starter Kits

The Laravel framework and its default configuration were used as a starting point for this application.

## Automation

- Migrations are automated using Laravel's migration system.

## Scalability

The application has been built with scalability in mind, and can handle a large number
