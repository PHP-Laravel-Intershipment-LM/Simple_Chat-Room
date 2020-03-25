# Broadcasting

I. **Tìm hiểu Broadcasting**

Broadcasting được Laravel phát triển để hỗ trợ người dùng xây dựng các ứng dụng realtime thông qua các kết nối WebSocket.

   1. **Cấu hình Broadcasting**

   Tất cả thông tin cấu hình của broadcasting nằm trong file _config/broadcasting.php_.

   Laravel hỗ trợ broadcasting thông qua các driver như: Pusher Channel, Redis hay log (local driver). Mặc định, giá trị driver bằng *null* tương ứng với disable broadcasting.

   Trước khi bắt đầu broadcast các event, tiến hành mở comment provider của nó là _BroadcastServiceProvider_ trong file _config/app.php_.

   2. **Cài đặt driver (Pusher)**

   Cài đặt gói thư viện pusher thông qua composer bằng lệnh sau composer
   > require pusher/pusher-php-server \"\~4.0\"

   Cài đặt javascript dependencies bằng lệnh 
   > npm install

   Cài đặt thư viện phía client là Laravel Echo và Pusher JS bằng lệnh
   > npm install \--save laravel-echo pusher-js

   Tạo một ứng dụng pusher (trên trang pusher.com), chú ý thông tin các key sau đăng ký. Sau đó chỉnh sửa thông tin cấu hình trong file .env bao gồm:

   - BROADCAST\_DRIVER=pusher
   - PUSHER\_APP\_ID=YOUR\_APP\_ID
   - PUSHER\_APP\_KEY=YOUR\_APP\_KEY
   - PUSHER\_APP\_SECRET=YOUR\_APP\_SECRET

   Mở file boostrap.js trong thư mục _resources/assets/js_ bỏ comment các dòng dưới đây, điền pusher app key và cluster vào.

   ```
   import Echo from laravel-echo';
   window.Pusher = require('pusher-js');
   window.Echo = new Echo({
       broadcaster: 'pusher',
       key: process.env.MIX_PUSHER_APP_KEY,
       cluster: process.env.MIX_PUSHER_APP_CLUSTER,
       forceTLS: true
   });
   ```

   3. **Khởi tạo Broadcast Events**

   Để một event có thể được broadcast, event đó phải implements file **ShouldBroadcast**.

   Trong laravel, mỗi event được tạo bằng artisan command đều tự động implement interface này và được override lại phương thức _broadcastOn_ trả về một channel mà event sẽ được broadcast.

   Trong laravel hỗ trợ 3 channel: Channel (public), PrivateChannel (private), PresenceChannel (private). Trong đó, 2 kênh private yêu cầu người dùng phải xác thực mới có thể truy cập. Ví dụ:

   ```
   public function broadcastOn()
   {
       return new PrivateChannel('user.'.$this->user->id);
   }
   ```

   Mặc định, channel sau khi tạo sẽ có tên theo tên event tương ứng. Tuy nhiên, người dùng có thể chỉnh sửa lại tên channel bằng cách override lại phương thức _broadcastAs_. Phương thức này trả về tên mới của channel.

   4. **Authorizing Channels**
