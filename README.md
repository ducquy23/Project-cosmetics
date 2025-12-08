# Project Cosmetics - Hệ thống quản lý mỹ phẩm

Dự án web quản lý mỹ phẩm được xây dựng bằng Laravel 10 với PHP 8.1+.

## 📋 Yêu cầu hệ thống

- **PHP**: >= 8.1
- **Composer**: >= 2.0
- **Node.js**: >= 18.x
- **MySQL**: >= 8.0
- **Docker** & **Docker Compose** (nếu sử dụng Docker)

## 🚀 Cài đặt và chạy dự án

### Phương án 1: Sử dụng Docker (Khuyến nghị)

#### Bước 1: Clone dự án
```bash
git clone <repository-url>
cd Project-cosmetics
```

#### Bước 2: Chạy script setup tự động
```bash
# Trên Linux/Mac
chmod +x docker-setup.sh
./docker-setup.sh

# Trên Windows (PowerShell)
# Chạy các lệnh trong docker-setup.sh thủ công hoặc sử dụng Git Bash
```

#### Bước 3: Cấu hình môi trường
```bash
# Copy file .env.example thành .env (nếu chưa có)
cp .env.example .env

# Hoặc tạo file .env mới với cấu hình sau:
```

#### Bước 4: Cấu hình file .env
Mở file `.env` và cấu hình như sau:

```env
APP_NAME="Project Cosmetics"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8001

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

#### Bước 5: Chạy các lệnh Laravel trong container
```bash
# Generate application key
docker compose exec php php artisan key:generate

# Chạy migrations
docker compose exec php php artisan migrate

# (Tùy chọn) Chạy seeders
docker compose exec php php artisan db:seed

# Cài đặt dependencies Composer
docker compose exec php composer install

# Cài đặt dependencies NPM
docker compose exec php npm install

# Build assets (nếu có)
docker compose exec php npm run build
```

#### Bước 6: Truy cập ứng dụng
- **Website**: http://localhost:8001
- **phpMyAdmin**: http://localhost:8080
  - Server: `mysql`
  - Username: `laravel`
  - Password: `secret`

### Phương án 2: Cài đặt thủ công (Local)

#### Bước 1: Clone và cài đặt dependencies
```bash
git clone <repository-url>
cd Project-cosmetics

# Cài đặt Composer dependencies
composer install

# Cài đặt NPM dependencies
npm install
```

#### Bước 2: Cấu hình môi trường
```bash
# Copy file .env.example
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### Bước 3: Cấu hình Database trong file .env
Mở file `.env` và cấu hình database:

```env
APP_NAME="Project Cosmetics"
APP_ENV=local
APP_KEY=base64:... (đã được generate ở bước trên)
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cosmetics_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### Bước 4: Tạo database
Đăng nhập vào MySQL và tạo database:

```sql
CREATE DATABASE cosmetics_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Hoặc sử dụng command line:
```bash
mysql -u root -p -e "CREATE DATABASE cosmetics_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

#### Bước 5: Chạy migrations
```bash
# Chạy migrations
php artisan migrate

# (Tùy chọn) Chạy seeders
php artisan db:seed
```

#### Bước 6: Tạo symbolic link cho storage
```bash
php artisan storage:link
```

#### Bước 7: Cấu hình quyền thư mục
```bash
# Trên Linux/Mac
chmod -R 775 storage bootstrap/cache
chmod -R 775 public/uploads

# Trên Windows, đảm bảo thư mục có quyền ghi
```

#### Bước 8: Chạy ứng dụng
```bash
# Chạy development server
php artisan serve

# Trong terminal khác, chạy Vite dev server (nếu có frontend assets)
npm run dev
```

Truy cập: http://localhost:8000

## 🗄️ Cấu hình Database

### Thông tin Database mặc định (Docker)

- **Host**: `mysql` (trong Docker) hoặc `127.0.0.1` (local)
- **Port**: `3306`
- **Database**: `laravel`
- **Username**: `laravel`
- **Password**: `secret`

### Cấu hình Database cho môi trường Production

Trong file `.env`, cập nhật:

```env
DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Các bảng trong Database

Dự án bao gồm các bảng sau (từ migrations):

- `users` - Người dùng
- `admins` - Quản trị viên
- `brands` - Thương hiệu
- `categories` - Danh mục sản phẩm
- `origins` - Xuất xứ
- `products` - Sản phẩm
- `product_images` - Hình ảnh sản phẩm
- `orders` - Đơn hàng
- `order_product` - Chi tiết đơn hàng
- `favorites` - Sản phẩm yêu thích
- `post_types` - Loại bài viết
- `posts` - Bài viết

## 📝 Các lệnh hữu ích

### Docker Commands

```bash
# Khởi động containers
docker compose up -d

# Dừng containers
docker compose down

# Xem logs
docker compose logs -f
docker compose logs -f php    # Chỉ xem logs của PHP
docker compose logs -f mysql  # Chỉ xem logs của MySQL

# Vào shell của container PHP
docker compose exec php bash

# Chạy Artisan commands
docker compose exec php php artisan [command]

# Chạy Composer commands
docker compose exec php composer [command]

# Chạy NPM commands
docker compose exec php npm [command]

# Rebuild containers
docker compose build --no-cache
docker compose up -d

# Xem trạng thái containers
docker compose ps

# Xóa volumes (cảnh báo: sẽ mất dữ liệu)
docker compose down -v
```

### Laravel Artisan Commands

```bash
# Chạy migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Reset database (xóa tất cả và chạy lại migrations)
php artisan migrate:fresh

# Reset và seed database
php artisan migrate:fresh --seed

# Tạo migration mới
php artisan make:migration create_table_name

# Tạo model
php artisan make:model ModelName

# Tạo controller
php artisan make:controller ControllerName

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize (production)
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### NPM Commands

```bash
# Development mode
npm run dev

# Build for production
npm run build

# Watch mode
npm run dev -- --watch
```

## 🔧 Xử lý lỗi thường gặp

### Lỗi kết nối Database

1. Kiểm tra database đã được tạo chưa
2. Kiểm tra thông tin trong file `.env` có đúng không
3. Kiểm tra MySQL service đã chạy chưa
4. Kiểm tra firewall/port 3306 có bị chặn không

### Lỗi permissions (Linux/Mac)

```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

### Lỗi Composer

```bash
# Clear cache và cài lại
composer clear-cache
composer install --no-cache
```

### Lỗi Docker

```bash
# Restart Docker service
# Trên Linux
sudo systemctl restart docker

# Xóa và rebuild containers
docker compose down
docker compose build --no-cache
docker compose up -d
```

## 📦 Cấu trúc dự án

```
Project-cosmetics/
├── app/                    # Application code
│   ├── Http/Controllers/   # Controllers
│   ├── Models/             # Eloquent Models
│   └── ...
├── config/                 # Configuration files
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── public/                 # Public assets
├── resources/
│   ├── views/              # Blade templates
│   └── ...
├── routes/                 # Route definitions
├── storage/                # Storage files
└── tests/                  # Tests
```

## 🧪 Chạy Tests

```bash
# Chạy tất cả tests
php artisan test

# Hoặc sử dụng PHPUnit
vendor/bin/phpunit
```

## 📄 License

Dự án này sử dụng [MIT license](https://opensource.org/licenses/MIT).

## 👥 Đóng góp

Mọi đóng góp đều được chào đón! Vui lòng tạo issue hoặc pull request.

## 📞 Liên hệ

Nếu có thắc mắc, vui lòng tạo issue trên repository.
