
# Triển khai Website PHP lên AWS

## Mục lục:
- Giới thiệu
- Mục tiêu
- Yên cầu tiên quyết
- Cài đặt
- Triển khai
- Kiểm tra

### 1. Giới thiệu
Readme này hướng dẫn cách triển khai webapp PHP lên Amazon Web Services(AWS) sử dụng EC2, VPC, RDS.
### 2. Mục tiêu
- Triển khai webapp PHP lên AWS EC2.
- Cấu hình VPC để bảo vệ mạng
- Sử dụng RDS để quản lý cơ sở dữ liệu
### 3. Yêu cầu tiên quyết
- Tài khoản AWS.
- Mã nguồn webapp PHP.
- Công cụ dòng lệnh AWS (AWS CLI).
### 4. Cài đặt
#### 4.1. Tạo VPC:
- Truy cập Truy cập vào AWS Management Console và chọn "VPC".
- Nhấp vào "Create VPC".
- Chọn CIDR block cho VPC của bạn.
- Tạo subnet public và private cho VPC.
- Lưu ý VPC ID, subnet IDs và routing table ID.
#### 4.2. Tạo RDS:
- Truy cập vào AWS Management Console và chọn "RDS".
- Nhấp vào "Create Database".
- Chọn engine database MySQL hoặc PostgreSQL.
- Cấu hình instance class, storage và database name.
- Tạo master username và password.
- Chọn VPC và subnet public.
- Lưu ý DB instance identifier (DB Instance ID).
#### 4.3. Tạo EC2 instance:
- Truy cập vào AWS Management Console và chọn "EC2".
- Nhấp vào "Launch Instance".
- Chọn AMI phù hợp với hệ điều hành và phiên bản PHP của bạn.
- Chọn instance type.
- Chọn subnet private của bạn.
- Cấu hình security group để cho phép truy cập HTTP và SSH từ subnet public.
- Lưu ý instance ID.
### 5. Triển khai
#### 5.1 Kết nối với EC2 instance:
- Vào Instance chọn vào Instance đã tạo click Connect để chuyển sang cửa sổ Console.
- Sử dụng SSH để kết nối với EC2 instance của bạn.
#### 5.2 Cài đặt webserver:
- Cài đặt PHP: 
  - Kiểm tra các phiên bản PHP đã được cài đặt:
  ```bash
    sudo amazon-linux-extras | grep php
  ```
  - Cài đặt PHP phiên bản 8.0:
  ```bash
    sudo amazon-linux-extras enable php8.0
  ```
  - Xóa bộ nhớ đệm:
  ```bash
    sudo yum clean metadata
  ```
  - Cài đặt các gói hỗ trợ:
  ```bash
    sudo yum install php-cli php-pdo php-fpm php-mysqlnd -y
  ```
  - Khởi động dịch vụ HTTP:
    - Khởi động dịch vụ HTTP ngay lập tức.
    ```bash
      sudo systemctl start httpd
    ```
    - Bật dịch vụ HTTP để tự động khởi động khi hệ thống khởi động lại.
    ```bash
    sudo systemctl enable httpd
    ```
- Cài đặt Apache:
  - Để đặt quyền truy cập tệp cho máy chủ web Apache
  ```bash
    sudo usermod -a -G apache ec2-user
  ```
  - Đăng xuất để làm mới quyền của bạn và bao gồm nhóm apache mới.
  ```bash
    exit
  ```
  - Đăng nhập lại và xác minh rằng nhóm apache tồn tại bằng lệnh nhóm.
  ```bash
    groups
  ```
  - Thay đổi quyền sở hữu nhóm của thư mục /var/www và nội dung của nó thành nhóm apache.
  ```bash
    sudo chown -R ec2-user:apache /var/www
  ```
  - Thay đổi quyền thư mục của /var/www và các thư mục con của nó để thêm quyền ghi nhóm và đặt ID nhóm trên các thư mục con được tạo trong tương lai.
  ```bash
    sudo chmod 2775 /var/www
    find /var/www -type d -exec sudo chmod 2775 {} \;
  ```
  - Thay đổi đệ quy quyền đối với các tệp trong thư mục /var/www và các thư mục con của nó để thêm quyền ghi nhóm.
  ```bash
    find /var/www -type f -exec sudo chmod 0664 {} \;
  ```
- Cài đặt MySQL:
  - Kiểm tra kết nối đến RDS từ EC2
  ```bash
    sudo yum install telnet -y
    telnet {RDS ID} 3306
  ```
  - Cài đặt MySQL
  ```bash
    sudo yum install mysql -y
  ```
  - Kết nối tới RDS
  ```bash
    mysql -h{RDS ID} -uadmin -p
  ```
  - Thực hiện cài đặt database theo dự án của bản thân.
  ```bash
    CREATE DATABASE user_management;

    USE user_management;

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

  ```
- Cài đặt Github:
```bash
  sudo yum install git
```
### 6.Triển khai webapp
- Di chuyển đến thư mục html
```bash
  cd /var/www/html
```
- Thực hiện các câu lệnh git để lấy dự án về máy
```bash
  git init
  git clone master {link}
```
- Website sẽ được triển khai.
### 7. Kiểm tra
- Truy cập địa chỉ IP public của EC2 instance trong trình duyệt web của bạn.
- Kiểm tra xem webapp PHP của bạn có hoạt động chính xác hay không.
