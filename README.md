# HRIS (Human Resource Information System) Application

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Pest](https://img.shields.io/badge/Pest_PHP-Testing-00D26A?style=for-the-badge&logo=pest&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

A modern, robust, and full-featured **Human Resource Information System (HRIS)** built with **Laravel 11**. This application manages employee data, department hierarchy, role-based access control, attendance with geolocation tracking, automated payroll calculations, leave requests, and task assignments.

---

## 🌟 Key Features & Modules

### 🏢 1. Employee & Department Management
- **Employee Profiles (`/employees`)**: Manage full employee credentials, department relations, roles, hire dates, contact info, and salaries.
- **Department Hierarchy (`/departments`)**: Create and manage organizational departments with status flags.
- **Role-Based Access Control (`/roles`)**: Differentiate access between **HR Administrators** and **Staff Employees** using custom middleware and Laravel Policies.

### ⏱️ 2. Attendance & Geolocation Tracking (`/presences`)
- **Self Check-In**: Employees can check in with automatic date, timestamp, and optional GPS geolocation tracking (`latitude` & `longitude`).
- **One-Click Check-Out**: Seamless check-out process with automatic timestamp recording.
- **HR Manual Override**: HR administrators can manually add or correct attendance records.

### 💰 3. Payroll Management & Service Layer (`/payrolls`)
- **Automated Salary Calculation**: Uses a dedicated `PayrollService` to compute net salary based on basic salary, bonuses, and deductions:
  $$\text{Net Salary} = \text{Salary} - \text{Deductions} + \text{Bonuses}$$
- **Role-Gated Payroll Visibility**: Staff members can view their own payroll records while HR manages company-wide payrolls.

### 🏖️ 4. Leave Request Workflow (`/leave_requests`)
- **Leave Application**: Employees can submit leave requests with date ranges and leave types.
- **HR Approval System**: HR administrators can review pending requests and mark them as **Approved** or **Rejected**.

### 📋 5. Task Assignment System (`/tasks`)
- **Task Delegation**: HR can assign tasks with due dates to specific employees.
- **Status Tracking**: Assigned employees can update task statuses (`Pending` ➔ `Done`).

---

## 🛠️ Tech Stack & Architecture

- **Framework**: Laravel 11
- **Language**: PHP 8.2+
- **Architecture**: Controller-Service-Policy Pattern
  - **Service Layer**: `PayrollService`, `PresenceService`
  - **Authorization**: `LeaveRequestPolicy`, `PayrollPolicy`, `PresencePolicy`, `TaskPolicy`
  - **Validation**: FormRequest Classes (`PresenceRequest`, `LeaveRequestRequest`, `PayrollRequest`)
- **Testing Engine**: Pest PHP (Unit & Feature Testing)

---

## 🧪 Automated Testing Suite

This repository includes a comprehensive automated test suite covering both Unit and Feature test layers.

### Run All Tests
```bash
php artisan test
```

### Run Specific Test Suite
```bash
# Feature Tests
php artisan test --filter=PayrollTest
php artisan test --filter=PresenceTest
php artisan test --filter=LeaveRequestTest
php artisan test --filter=TaskTest
php artisan test --filter=DepartmentTest

# Unit Tests
php artisan test --filter=PayrollServiceTest
php artisan test --filter=PresenceServiceTest
```

---

## 🚀 Local Installation Guide

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL / MariaDB (or Laragon / XAMPP)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/ganapurba007/hris_app.git
   cd hris_app
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   Configure your database settings in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hris_app
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start Local Development Server**
   ```bash
   php artisan serve
   ```
   Open `http://127.0.0.1:8000` in your browser.

---

## 📜 License

This project is licensed under the [MIT License](LICENSE).
