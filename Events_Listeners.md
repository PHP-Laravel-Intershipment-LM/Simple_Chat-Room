I.  **Giới thiệu Events và Listeners**

Events và Listeners trong Laravel sẽ cung cấp cho người dùng một công cụ
để quan sát và lắng nghe những hành động đơn giản xảy ra trong ứng dụng.

Events và Listeners phải được lưu trữ trong hai thư mục App/Events và
App/Listeners.

II. **Đăng ký, khởi tạo Events và Listeners**

   a.  **Đăng ký**

   Để đăng ký Events và Listeners, ta tiến hành chỉnh sửa trong file
   > App/Providers/EventServiceProvider.php

   Provider này cấp cho ta một mảng _\$listen_ để ta đăng ký events và listeners. Với key là event và value tương ứng là listener.

   Chú ý tên event và listener phải chứa đường dẫn đến thư mục _App/Events_ và _App/Listeners_

   Ngoài ra, người dùng còn có thể đăng ký ở phương thức _boot_ của _provider_ này. Cú pháp đăng ký cho mọi event, người dùng chỉ cần chèn code xử lý tương ứng cho từng event ở bên dưới:

   ```
   Event::listen('event.\*', function(\$eventName, array \$data) {
       // Insert code here
   });
   ```

   b.  **Khởi tạo**

   Thay vì phải tạo thủ công các file event và listener tương ứng đã khai báo trong provider. Laravel đã cung cấp lệnh artisan để có thể tự động tạo các file này.

   Sau khi thêm events và listeners xong, chúng ta dùng lệnh sau để tạo:
   > php artisan event:generate

III. **Event Discovery**

Là một cách khác để đăng ký một events và listeners. Người dùng không
cần thêm thủ công từng file event và listener vào providers nữa. Thay
vào đó, "event discovery" sẽ tự động quét thư mục Listeners của ứng dụng
và sẽ đăng ký tất cả event và listener mà nó phát hiện (listener chưa
method handle)

Mặc định khi tạo một ứng dụng, Event Discovery được tắt. Để mở nó, người
dùng cần override lại phương thức _shouldDiscoverEvents_ ở
**EventServiceProvider** và cho phương thức trả về true.

Để chỉ định thư mục mà **EventDiscovery** sẽ quét, người dùng phải override
lại phương thức _discoverEventWithin_ và trả về mảng chứa danh sách đường
dẫn mà nó sẽ quét. Ví dụ như:

```
protected function discoverEventsWithin()
{
    return [
        $this->app->path('Listeners'),
    ];
}
```

Có một điều, cứ mỗi khi người dùng request thì ứng dụng lại quét một
lần. Điều này sẽ làm giảm tốc độ và hiệu suất của ứng dụng. Do đó, trong
lúc triển khai ứng dụng ra thực tế, người dùng cần chạy lệnh php artisan
event:cache. Lệnh này giúp lưu lại tất cả các event và listener có trong
ứng dụng. Khi muốn xóa cache, người dùng chỉ cần chạy lệnh:
> php artisan event:clear.

IV. **Khai báo Listeners**

Listener là thành phần chuyên xử lý những event xảy ra trong ứng dụng.
Khi được tạo bằng lệnh artisan, nó sẽ được tự động thêm vào một phương
thức là handle, phương thức chính là nơi sẽ được gọi trước tiên khi
event xảy ra.

V.  **Điều hướng đến Event:**

Các event helper được khai báo toàn cục, do đó để gọi một event ở bất kỳ
đâu trong ứng dụng, người dùng chỉ cần dùng phương thức event và truyền
vào một sự kiện cần gọi là được. 

Ví dụ: 
> event(new OrderShipped(\$order))

VI. **Event Subscribers**

   a.  **Khai báo event subscribers**

   Event Subscribers là một class có khả năng chứa nhiều sự kiện cùng một lúc. 
   
   Ví dụ:
   ```
   <?php
   namespace App\\Listeners;

   class UserEventSubscriber
   {
       public function handleUserLogin($event) {}

       public function handleUserLogout($event) {}

       public function subscribe($events)
       {
           $events->listen('Illuminate\Auth\Events\Login\', 'App\Listeners\UserEventSubscriber\@handleUserLogin\');

           $events->listen('Illuminate\Auth\Events\Logout\',
           'App\\Listeners\\UserEventSubscriber\@handleUserLogout\');
       }
   }
```

   Trong đó, phương thức subscribe(\$event) sẽ gọi đến các event mà nó bao hàm.

   b.  **Đăng ký event subscribers**

   Để đăng ký event subscribers, người dùng chỉ cần thêm subscriber đó vào mảng _$subscribe_ mà **EventServiceProvider** đã cấp sản
