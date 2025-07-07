
# 🥗 Cafeteria Management System

A full-featured cafeteria ordering and management system built with **Laravel** and **MySQL**. This project allows admins to manage products, users, and view orders, while regular users can browse products, place orders, and track their order history.

---

## 📌 Features

### 👤 User Role
- Register & login
- Browse available products by category
- Place orders with multiple items
- View order history with status (pending, delivered, canceled)

### 🧑‍💼 Admin Role
- Dashboard with total sales and user count
- Add, edit, delete products
- Add, edit users with roles and room numbers
- View all orders and print checks/invoices
- Filter orders by status

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11+ (PHP)
- **Frontend:** Blade, Bootstrap / Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Auth (Guard-based)
- **ORM:** Eloquent

---

## 🗂️ Database Schema

### Tables:
- `users` – name, email, password, room, extension, role
- `products` – name, price, image, category, availability
- `categories` – product categories
- `orders` – linked to user, status, total
- `order_items` – linked to order & product, quantity, price

---

## 🔧 Installation

```bash
git clone https://github.com/yourusername/cafeteria-system.git
cd cafeteria-system
composer install
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed

# Optional: link storage
php artisan storage:link

php artisan serve
```

## 📸 Screenshots

Add UI screenshots below:

![Home Page](https://github.com/user-attachments/assets/b7d2f01c-6829-42e9-9ed9-154e803a53f9)

![Menu Page](https://github.com/user-attachments/assets/0eda7adc-058d-4f80-b486-489327733f82)

![Admin Page](https://github.com/user-attachments/assets/b7bf3f00-60fc-4137-b71d-191435620224)

---

## 🎥 Demo

You can watch a short demo here:  
👉 [Watch on YouTube](https://www.youtube.com/your-demo-link)

---

## ✍️ Teams
**Abdelrhman Essam** – [@abdelrhmanessam74](https://www.linkedin.com/in/yourusername)

**Mohamed Ahmed** – [@yourusername](https://www.linkedin.com/in/yourusername)

**Ahmed Mohamed** – [@yourusername](https://www.linkedin.com/in/yourusername)

**Mohamed Ali** – [@yourusername](https://www.linkedin.com/in/yourusername)

---

## 🌟 License

This project is open source under the [MIT License](LICENSE).

