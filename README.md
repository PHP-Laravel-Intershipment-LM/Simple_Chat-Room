# Simple Chat Room

I. **Nội dung nghiên cứu**

Xây dựng một chat room đơn giản bằng Laravel. Có sử dụng một số chức năng mà Laravel đã cung cấp là:

- Laravel Listeners & Events: [Link](https://github.com/PHP-Laravel-Intershipment-LM/Simple_Chat-Room/blob/master/Events_Listeners.md)
- Laravel Broadcasting: [Link](https://github.com/PHP-Laravel-Intershipment-LM/Simple_Chat-Room/blob/master/Broadcasting.md)

II. **Các bước cài đặt**

Tải bộ mã nguồn về giải nén ra thư mục htdocs của webserver.

Mở terminal lên, chạy lần lượt các lệnh sau để cài đặt project:

- Cài đặt các thư viện composer cần thiết:

> composer install

- Cài đặt các module javascript hỗ trợ một số tác vụ quản lý mã nguồn:

> npm install

- Tạo trước một csdl trong mysql, cập nhật các thông tin cơ sở dữ liệu vào file env, chạy lệnh tiếp theo để tạo các bảng và insert dữ liệu mẫu cho csdl

> php artisan migrate --seed