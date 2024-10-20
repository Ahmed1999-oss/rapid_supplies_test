
# Book Management API

This is a RESTful API for managing a collection of books using Laravel.

## Setup Instructions

### Prerequisites

- PHP (version 8.0 or higher)
- Composer
- Laravel (latest stable version)
- MySQL or any other database supported by Laravel

### Installation Steps

1. **Clone the Repository**

   Clone the repository from GitHub:

   ```bash
   git clone https://github.com/Ahmed1999-oss/rapid_supplies_test.git
   cd rapid_supplies_test
   ```

2. **Install Dependencies**

   Run the following command to install the required dependencies:

   ```bash
   composer install
   ```

3. **Set Up the Environment**

   Copy the `.env.example` file to a new file named `.env`:

   ```bash
   cp .env.example .env
   ```

   Then, set up your database configuration in the `.env` file:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Generate Application Key**

   Generate the application key by running:

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Run the migrations to set up the database:

   ```bash
   php artisan migrate
   ```

6. **Seed the Database**

   Optionally, you can seed the database with sample data:

   ```bash
   php artisan db:seed
   ```

7. **Set Up Authentication**

   If using Laravel Sanctum, run the following command to publish the Sanctum configuration:

   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   ```

   Then, run the migrations for Sanctum:

   ```bash
   php artisan migrate
   ```

8. **Run the Application**

   Start the local development server:

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`.


## API Endpoint Descriptions

### Base URL
```
http://localhost:8000/api
```

### Endpoints

| Method | Endpoint           | Description                     |
|--------|--------------------|---------------------------------|
| GET    | /books             | Retrieve all books (with pagination and search filters) |
| POST   | /books             | Create a new book              |
| GET    | /books/{id}        | Retrieve a specific book by ID |
| PUT    | /books/{id}        | Update a specific book         |
| DELETE | /books/{id}        | Delete a specific book         |
| GET    | /books/search       | Search books by genre or author |


## Request/Response Formats

### Creating a Book

**Request:**
```http
POST /api/books
Content-Type: application/json

{
    "title": "Test Book",
    "author": "John Doe",
    "published_date": "2024-01-01",
    "genre": "Fiction"
}
```

**Response:**
```http
HTTP/1.1 201 Created
Content-Type: application/json

{
    "id": 1,
    "title": "Test Book",
    "author": "John Doe",
    "published_date": "2024-01-01",
    "genre": "Fiction",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Retrieving All Books

**Request:**
```http
GET /api/books
```

**Response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
    "data": [
        {
            "id": 1,
            "title": "Test Book",
            "author": "John Doe",
            "published_date": "2024-01-01",
            "genre": "Fiction",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        },
        // Other books...
    ],
    "meta": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 1
    }
}
```

### Updating a Book

**Request:**
```http
PUT /api/books/{id}
Content-Type: application/json

{
    "title": "Updated Book Title",
    "author": "Jane Doe",
    "published_date": "2024-02-01",
    "genre": "Non-Fiction"
}
```

**Response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
    "id": 1,
    "title": "Updated Book Title",
    "author": "Jane Doe",
    "published_date": "2024-02-01",
    "genre": "Non-Fiction",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-02T00:00:00.000000Z"
}
```

### Deleting a Book

**Request:**
```http
DELETE /api/books/{id}
```

**Response:**
```http
HTTP/1.1 204 No Content
```

### Searching for Books

**Request:**
```http
GET /api/books/search?genre=Fiction
```

**Response:**
```http
HTTP/1.1 200 OK
Content-Type: application/json

{
    "data": [
        {
            "id": 1,
            "title": "Test Book",
            "author": "John Doe",
            "published_date": "2024-01-01",
            "genre": "Fiction",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        },
        // Other matching books...
    ]
}
```

## Authentication Requirements

- All routes except for retrieving the list of books (`GET /api/books`) require authentication.
- The API uses **Laravel Sanctum** for authentication. You need to obtain an access token by logging in or registering a user.
- Include the token in the `Authorization` header for requests requiring authentication:

```http
Authorization: Bearer your-access-token
```

## Testing

### Running Tests

To run the tests for the API, use the following command:

```bash
php artisan test
```

This will execute all the tests defined in the `tests` directory.

## Conclusion

This README provides the necessary details to set up, use, and understand the Book Management API. For any issues or contributions, please refer to the project's GitHub repository.
