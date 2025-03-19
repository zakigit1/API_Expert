# Laravel API Advance

A comprehensive Laravel API project demonstrating advanced API development techniques including filtering, pagination, resource handling, and relationship loading. This project serves as a learning resource for building robust and scalable APIs with Laravel.

## Project Overview

This project implements a RESTful API for managing customers and invoices, showcasing best practices for API development in Laravel. It's designed to demonstrate how to structure APIs with versioning (V1), implement advanced filtering, handle pagination, and efficiently manage resources and relationships.

## Key Features

### API Versioning
- Organized API endpoints under versioned namespaces (V1)
- Structured controllers, resources, and filters by version

### Advanced Filtering
- Custom filter implementation for query parameters
- Support for various operators (eq, neq, gt, gte, lt, lte)
- Column mapping for translating API fields to database columns

### Pagination
- Built-in pagination for all collection endpoints
- Preserving query parameters across paginated results

### Resource Handling
- Transformation of database models to API resources
- Consistent JSON response structure
- Camel case field naming convention for API responses

### Relationship Loading
- Conditional relationship loading with `whenLoaded`
- Query parameter control for including relationships
- Efficient loading of related resources

### Authentication
- Sanctum-based API authentication
- Protected routes with middleware

### Bulk Operations
- Support for bulk creation of resources

## Installation

1. Clone the repository
   ```bash
   git clone <repository-url>
   cd Laravel_API_Advance
   ```

2. Install dependencies
   ```bash
   composer install
   ```

3. Create and configure environment file
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in the `.env` file
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Run migrations and seeders
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Start the development server
   ```bash
   php artisan serve
   ```

## API Usage

### Authentication

```bash
# Login to get access token
POST /api/v1/login
```

### Customers

```bash
# Get all customers (with pagination)
GET /api/v1/customers

# Get all customers with their invoices
GET /api/v1/customers?includeInvoices=true

# Filter customers
GET /api/v1/customers?name[eq]=John
GET /api/v1/customers?postalCode[gt]=10000

# Get a specific customer
GET /api/v1/customers/{id}

# Create a customer
POST /api/v1/customers

# Update a customer
PUT /api/v1/customers/{id}

# Delete a customer
DELETE /api/v1/customers/{id}
```

### Invoices

```bash
# Get all invoices (with pagination)
GET /api/v1/invoices

# Filter invoices
GET /api/v1/invoices?amount[gt]=100
GET /api/v1/invoices?status[eq]=paid

# Get a specific invoice
GET /api/v1/invoices/{id}

# Create an invoice
POST /api/v1/invoices

# Create multiple invoices
POST /api/v1/invoices/bulk

# Update an invoice
PUT /api/v1/invoices/{id}

# Delete an invoice
DELETE /api/v1/invoices/{id}
```

## Filter Operators

The API supports the following filter operators:

- `eq`: Equal to
- `neq`: Not equal to
- `gt`: Greater than
- `gte`: Greater than or equal to
- `lt`: Less than
- `lte`: Less than or equal to

Example: `/api/v1/customers?postalCode[gte]=10000&postalCode[lte]=20000`

## API Documentation

Detailed API documentation is available in the [API_DOCUMENTATION.md](API_DOCUMENTATION.md) file. This documentation includes:

- Complete list of all API endpoints
- Request and response formats with examples
- Authentication instructions
- Query parameter options for filtering and pagination
- Instructions for including related resources

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
