# Order and Delivery Management System

## Project Description

The **Order and Delivery Management System** is a web application built with the Laravel framework. It provides an efficient way to manage orders and deliveries through an intuitive user interface and a robust API. The system is designed to help users track and manage their orders and delivery locations in real-time.

---

## Features

### Order Management
- **View Orders**: Display a list of orders with filtering and search capabilities.
- **Order Details**: View detailed information about an order, including associated products and shipping addresses.
- **Delete Orders**: Soft delete orders, moving them to a trash bin.
- **Restore Orders**: Restore deleted orders from the trash bin.
- **Permanently Delete Orders**: Permanently delete orders from the system.

### Delivery Management
- **View Delivery Details**: Display delivery details, including the current location.
- **Update Delivery Location**: Update the current location of a delivery using latitude and longitude coordinates.

---

## Requirements

- **PHP**: Version 7.4 or higher.
- **Composer**: Dependency manager for PHP.
- **MySQL**: Database for storing application data.
- **Laravel**: Version 8 or higher.

---

## Installation

1. **Clone the Repository**:
    Clone the project from GitHub:
    ```bash
    git clone https://github.com/username/project-name.git
    cd project-name
    ```

2. **Install Dependencies**:
    Install the required dependencies using Composer:
    ```bash
    composer install
    ```

3. **Set Up Environment File**:
    Create a `.env` file based on the `.env.example` file and update the database configuration:
    ```bash
    cp .env.example .env
    ```

4. **Create the Database**:
    Create a new database in MySQL and update the `.env` file with the database credentials.

5. **Run Migrations**:
    Set up the database tables by running the migrations:
    ```bash
    php artisan migrate
    ```

6. **Start the Development Server**:
    Start the Laravel development server:
    ```bash
    php artisan serve
    ```

---

## API Endpoints

### Get Delivery Details
- **Endpoint**: `GET /api/deliveries/{id}`
- **Response**:
    ```json
    {
        "id": 1,
        "order_id": 123,
        "status": "in_transit",
        "lat": 24.7136,
        "lng": 46.6753
    }
    ```

### Update Delivery Location
- **Endpoint**: `PUT /api/deliveries/{id}`
- **Parameters**:
    - `lat` (required): The new latitude of the delivery.
    - `lng` (required): The new longitude of the delivery.
- **Response**:
    ```json
    {
        "id": 1,
        "order_id": 123,
        "status": "in_transit",
        "current_location": "POINT(46.6753 24.7136)"
    }
    ```

---

## Usage

- **Order Management**: Use the dashboard to view, delete, restore, or permanently delete orders.
- **Delivery Management**: Use the API to track and update delivery locations.

---

## Contributors

- **Your Name** - Developer of the project.

---

## License

This project is licensed under the [MIT License](LICENSE).
