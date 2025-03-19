# Laravel API Advance - API Documentation

This document provides detailed information about the API endpoints, request/response formats, authentication, and usage examples for the Laravel API Advance project.

## Table of Contents

- [Authentication](#authentication)
- [API Versioning](#api-versioning)
- [Customers](#customers)
  - [List Customers](#list-customers)
  - [Get Customer](#get-customer)
  - [Create Customer](#create-customer)
  - [Update Customer](#update-customer)
  - [Delete Customer](#delete-customer)
- [Invoices](#invoices)
  - [List Invoices](#list-invoices)
  - [Get Invoice](#get-invoice)
  - [Create Bulk Invoices](#create-bulk-invoices)
- [Filtering](#filtering)
- [Pagination](#pagination)
- [Including Relationships](#including-relationships)

## Authentication

The API uses Laravel Sanctum for token-based authentication. All endpoints except the login endpoint require authentication.

### Login

```
POST /api/v1/login
```

#### Request Body

```json
{
  "email": "user@example.com",
  "password": "password"
}
```

#### Response

```json
{
  "token": "1|abcdefghijklmnopqrstuvwxyz1234567890"
}
```

#### Error Response (401 Unauthorized)

```json
{
  "message": "Invalid credentials"
}
```

### Using Authentication Token

For all authenticated endpoints, include the token in the Authorization header:

```
Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz1234567890
```

## API Versioning

All API endpoints are versioned under the `/api/v1` prefix to ensure backward compatibility as the API evolves.

## Customers

### List Customers

Retrieve a paginated list of customers.

```
GET /api/v1/customers
```

#### Query Parameters

| Parameter | Description |
|-----------|-------------|
| page | Page number for pagination |
| includeInvoices | Set to 'true' to include related invoices |
| name[eq] | Filter by exact name match |
| type[eq] | Filter by customer type (I=Individual, B=Business) |
| email[eq] | Filter by exact email match |
| address[eq] | Filter by exact address match |
| city[eq] | Filter by exact city match |
| state[eq] | Filter by exact state match |
| postalCode[eq] | Filter by exact postal code match |
| postalCode[gt] | Filter by postal code greater than value |
| postalCode[gte] | Filter by postal code greater than or equal to value |
| postalCode[lt] | Filter by postal code less than value |
| postalCode[lte] | Filter by postal code less than or equal to value |

#### Response

```json
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "type": "I",
      "email": "john@example.com",
      "address": "123 Main St",
      "city": "Anytown",
      "state": "CA",
      "postalCode": "12345"
    },
    {
      "id": 2,
      "name": "Acme Corp",
      "type": "B",
      "email": "info@acme.com",
      "address": "456 Business Ave",
      "city": "Commerce City",
      "state": "NY",
      "postalCode": "54321"
    }
  ],
  "links": {
    "first": "http://example.com/api/v1/customers?page=1",
    "last": "http://example.com/api/v1/customers?page=10",
    "prev": null,
    "next": "http://example.com/api/v1/customers?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 10,
    "path": "http://example.com/api/v1/customers",
    "per_page": 15,
    "to": 15,
    "total": 150
  }
}
```

### Get Customer

Retrieve a specific customer by ID.

```
GET /api/v1/customers/{id}
```

#### Query Parameters

| Parameter | Description |
|-----------|-------------|
| includeInvoices | Set to 'true' to include related invoices |

#### Response

```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "type": "I",
    "email": "john@example.com",
    "address": "123 Main St",
    "city": "Anytown",
    "state": "CA",
    "postalCode": "12345",
    "invoices": [
      {
        "id": 1,
        "customerId": 1,
        "amount": 100.50,
        "status": "P",
        "billedDate": "2023-01-15",
        "paidDate": "2023-01-20"
      },
      {
        "id": 2,
        "customerId": 1,
        "amount": 200.75,
        "status": "B",
        "billedDate": "2023-02-15",
        "paidDate": null
      }
    ]
  }
}
```

### Create Customer

Create a new customer.

```
POST /api/v1/customers
```

#### Request Body

```json
{
  "name": "Jane Smith",
  "type": "I",
  "email": "jane@example.com",
  "address": "789 Residential Blvd",
  "city": "Hometown",
  "state": "TX",
  "postalCode": "67890"
}
```

#### Response

```json
{
  "data": {
    "id": 3,
    "name": "Jane Smith",
    "type": "I",
    "email": "jane@example.com",
    "address": "789 Residential Blvd",
    "city": "Hometown",
    "state": "TX",
    "postalCode": "67890"
  }
}
```

### Update Customer

Update an existing customer.

```
PUT /api/v1/customers/{id}
```

#### Request Body

```json
{
  "name": "Jane Smith-Jones",
  "email": "jane.updated@example.com",
  "address": "789 Residential Blvd",
  "city": "Hometown",
  "state": "TX",
  "postalCode": "67890",
  "type": "I"
}
```

#### Response

```json
{
  "data": {
    "id": 3,
    "name": "Jane Smith-Jones",
    "type": "I",
    "email": "jane.updated@example.com",
    "address": "789 Residential Blvd",
    "city": "Hometown",
    "state": "TX",
    "postalCode": "67890"
  }
}
```

### Delete Customer

Delete a customer by ID.

```
DELETE /api/v1/customers/{id}
```

#### Response

```json
{
  "message": "Customer deleted successfully"
}
```

## Invoices

### List Invoices

Retrieve a paginated list of invoices.

```
GET /api/v1/invoices
```

#### Query Parameters

| Parameter | Description |
|-----------|-------------|
| page | Page number for pagination |
| customerId[eq] | Filter by exact customer ID |
| amount[eq] | Filter by exact amount |
| amount[gt] | Filter by amount greater than value |
| amount[gte] | Filter by amount greater than or equal to value |
| amount[lt] | Filter by amount less than value |
| amount[lte] | Filter by amount less than or equal to value |
| status[eq] | Filter by status (B=Billed, P=Paid, V=Void) |
| billedDate[eq] | Filter by exact billed date (YYYY-MM-DD) |
| billedDate[gt] | Filter by billed date after value |
| billedDate[gte] | Filter by billed date on or after value |
| billedDate[lt] | Filter by billed date before value |
| billedDate[lte] | Filter by billed date on or before value |
| paidDate[eq] | Filter by exact paid date (YYYY-MM-DD) |
| paidDate[gt] | Filter by paid date after value |
| paidDate[gte] | Filter by paid date on or after value |
| paidDate[lt] | Filter by paid date before value |
| paidDate[lte] | Filter by paid date on or before value |

#### Response

```json
{
  "data": [
    {
      "id": 1,
      "customerId": 1,
      "amount": 100.50,
      "status": "P",
      "billedDate": "2023-01-15",
      "paidDate": "2023-01-20"
    },
    {
      "id": 2,
      "customerId": 1,
      "amount": 200.75,
      "status": "B",
      "billedDate": "2023-02-15",
      "paidDate": null
    }
  ],
  "links": {
    "first": "http://example.com/api/v1/invoices?page=1",
    "last": "http://example.com/api/v1/invoices?page=10",
    "prev": null,
    "next": "http://example.com/api/v1/invoices?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 10,
    "path": "http://example.com/api/v1/invoices",
    "per_page": 15,
    "to": 15,
    "total": 150
  }
}
```

### Get Invoice

Retrieve a specific invoice by ID.

```
GET /api/v1/invoices/{id}
```

#### Response

```json
{
  "data": {
    "id": 1,
    "customerId": 1,
    "amount": 100.50,
    "status": "P",
    "billedDate": "2023-01-15",
    "paidDate": "2023-01-20"
  }
}
```

### Create Bulk Invoices

Create multiple invoices in a single request.

```
POST /api/v1/invoices/bulk
```

#### Request Body

```json
[
  {
    "customerId": 1,
    "amount": 150.75,
    "status": "B",
    "billedDate": "2023-03-15",
    "paidDate": null
  },
  {
    "customerId": 2,
    "amount": 300.25,
    "status": "B",
    "billedDate": "2023-03-15",
    "paidDate": null
  }
]
```

#### Response

```json
{
  "message": "Invoices created successfully"
}
```

## Filtering

The API supports filtering using query parameters with the following operators:

| Operator | Description | Example |
|----------|-------------|--------|
| eq | Equal to | `?name[eq]=John` |
| neq | Not equal to | `?status[neq]=P` |
| gt | Greater than | `?amount[gt]=100` |
| gte | Greater than or equal to | `?amount[gte]=100` |
| lt | Less than | `?amount[lt]=200` |
| lte | Less than or equal to | `?amount[lte]=200` |

You can combine multiple filters in a single request:

```
GET /api/v1/invoices?amount[gte]=100&amount[lte]=200&status[eq]=P
```

## Pagination

All list endpoints return paginated results. You can navigate through pages using the `page` query parameter:

```
GET /api/v1/customers?page=2
```

The response includes pagination metadata and links to help with navigation.

## Including Relationships

Some endpoints support including related resources using the `include` query parameter:

```
GET /api/v1/customers?includeInvoices=true
```

This will include the related invoices in the response for each customer.