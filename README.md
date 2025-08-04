# CabsOnline Project 1 - README

## Project URL
http://localhost/Project1/register.php

## System Overview
CabsOnline is a web-based taxi booking system that allows customers to register, login, and book taxi services online. The system also includes an admin interface for managing bookings.

## How to Use the System

### 1. Customer Registration (New Users)
- Navigate to `http://localhost/Project1/register.php`
- Fill in all required fields:
  - Name
  - Password (enter twice for confirmation)
  - Email (must be unique)
  - Phone number
- Click "Send to server" to register
- Upon successful registration, you'll be redirected to the booking page

### 2. Customer Login (Existing Users)
- Navigate to `http://localhost/Project1/login.php`
- Enter your registered email and password
- Click "Log In"
- Upon successful login, you'll be redirected to the booking page

### 3. Booking a Taxi
- After login/registration, you'll be on the booking page
- Fill in all required fields:
  - Passenger name
  - Passenger contact phone
  - Pick-up address (unit number is optional)
  - Destination suburb
  - Pick-up date and time (must be at least 40 minutes from current time)
- Click "Book" to submit your booking
- You'll receive a booking reference number and confirmation message

### 4. Admin Functions
- Navigate to `http://localhost/Project1/admin.php`
- No authentication required (as per project requirements)
- Two main functions:
  1. **View unassigned bookings**: Click "List all" to see bookings with pick-up time within 3 hours
  2. **Assign taxi**: Enter a booking reference number and click "update" to assign a taxi

## System Requirements
- XAMPP with Apache web server
- MySQL database server (MySQL Workbench or XAMPP MySQL)
- PHP 7.0 or higher
- Web browser (Chrome, Firefox, Safari, or Edge)

## Database Configuration
- Database name: cabsOnline
- Two tables required: customer and booking
- Connection details are configured in each PHP file

## List of Files
1. **register.php** - Customer registration page
2. **login.php** - Customer login page
3. **booking.php** - Taxi booking form
4. **admin.php** - Admin interface for managing bookings
5. **mysql_tables.txt** - SQL commands for creating database tables
6. **readme.doc** - This documentation file
7. **checklist.doc** - Task completion checklist

## Important Notes
- Email addresses must be unique in the system
- Passwords are stored in plain text (for educational purposes only)
- Pick-up time must be at least 40 minutes from the current time
- The email function may not work on localhost without SMTP configuration
- Admin page has no authentication as per project requirements

## Troubleshooting
- If you get database connection errors, check your MySQL credentials in the PHP files
- Ensure MySQL service is running before accessing the system
- Make sure the database name matches exactly: "cabsOnline" (case-sensitive)
- All files must be in the "Project1" folder under your web server's document root
