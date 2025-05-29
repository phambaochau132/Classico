 @extends('header')
 @section('content')
 <style>
     .home-bg {
         padding: 20px 0;
     }

     .cart .col-md,
     .cart .col-md-3 {
         text-align: center;
     }

     .product .col-md,
     .product .col-md-3 {
         margin: auto;
         text-align: center;
     }

     .product .col-md a,
     .product .col-md-3 a {
         color: #212529;
     }

     i.fa.fa-trash {
         font-size: 25px;
     }

     body {
         background-color: #f8f9fa;
     }

     .form-container {
         max-width: 600px;
         margin: 60px auto;
         background: #fff;
         padding: 30px;
         border-radius: 10px;
         box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
     }

     .avatar-box {
         width: 120px;
         height: 120px;
         border-radius: 10px;
         overflow: hidden;
         border: 2px solid #ddd;
     }

     .avatar-box img {
         width: 100%;
         height: 100%;
         object-fit: cover;
     }

     .modal-header h5 {
         font-weight: bold;
     }
 </style>

 <body>
     <div class="form-container">
         <h4 class="mb-4 text-center">Thông tin cá nhân</h4>
         <div class="text-center mb-3">
             <div class="avatar-box mx-auto">
                 <img src="{{ asset($customer->avatar) }}" alt="Avatar">
             </div>
         </div>
         <p><strong>Họ tên:</strong> {{ $customer->name }}</p>
         <p><strong>Email:</strong> {{ $customer->email }}</p>
         <p><strong>Giới tính:</strong>
             @if ($customer->gender == 'male')
             Nam
             @elseif ($customer->gender == 'female')
             Nữ
             @else
             Khác
             @endif
         </p>
         <p><strong>Số điện thoại:</strong> {{ $customer->phone }}</p>
         <p><strong>Địa chỉ:</strong> {{ $customer->address }}</p>
         <button class="btn btn-primary btn-block mt-3" data-bs-toggle="modal" data-bs-target="#updateChoiceModal">Cập nhật</button>
     </div>
     <div class="modal fade" id="updateChoiceModal" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Bạn muốn cập nhật gì?</h5>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                 </div>
                 <div class="modal-body text-center">
                     <button class="btn btn-info m-2" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#updateInfoModal">Thông tin cá nhân</button>
                     <button class="btn btn-warning m-2" data-dismiss="modal" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">Mật khẩu</button>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal fade" id="updateInfoModal" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <form class="modal-content" action="{{ route('customer.updateProfile') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="action" value="update_info">
                 <div class="modal-header">
                     <h5 class="modal-title">Cập nhật thông tin cá nhân</h5>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <label>Họ tên</label>
                     <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                     @if($errors->has('name'))
                     <span class="text-danger">{{$errors->first('name')}}</span>
                     @endif
                     <label>Email</label>
                     <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
                     @if($errors->has('email'))
                     <span class="text-danger">{{$errors->first('email')}}</span>
                     @endif
                     <label>Giới tính</label>
                     <select name="gender" class="form-control">
                         <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Nam</option>
                         <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                     </select>
                     @if($errors->has('gender'))
                     <span class="text-danger">{{$errors->first('gender')}}</span>
                     @endif
                     <label>Điện thoại</label>
                     <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
                     @if($errors->has('phone'))
                     <span class="text-danger">{{$errors->first('phone')}}</span>
                     @endif
                     <label>Địa chỉ</label>
                     <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
                     @if($errors->has('address'))
                     <span class="text-danger">{{$errors->first('address')}}</span>
                     @endif
                     <label>Ảnh đại diện mới</label>
                     @if ($customer->avatar)
                     <img src="{{ asset('images/avatar/' . $customer->avatar) }}" alt="" style="max-width: 150px; margin-bottom: 10px;">
                     @endif
                     <input type="file" id="avatar" name="avatar" class="form-control">
                     @if($errors->has('avatar'))
                     <span class="text-danger">{{$errors->first('avatar')}}</span>
                     @endif
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Lưu</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                 </div>
             </form>
         </div>
     </div>
     <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <form class="modal-content" action="{{ route('customer.updateProfile') }}" method="POST">
                 @csrf
                 <input type="hidden" name="action" value="update_password">

                 <div class="modal-header">
                     <h5 class="modal-title">Đổi mật khẩu</h5>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group mb-3">
                         <label>Mật khẩu cũ</label>
                         <input type="password" name="current_password" class="form-control">
                         @if($errors->has('current_password'))
                         <span class="text-danger">{{ $errors->first('current_password') }}</span>
                         @endif
                     </div>

                     <div class="form-group mb-3">
                         <label>Mật khẩu mới</label>
                         <input type="password" name="password" class="form-control">
                         @if($errors->has('password'))
                         <span class="text-danger">{{ $errors->first('password') }}</span>
                         @endif
                     </div>

                     <div class="form-group mb-3">
                         <label>Xác nhận mật khẩu</label>
                         <input type="password" name="password_confirmation" class="form-control">
                         @if($errors->has('password_confirmation'))
                         <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                         @endif
                     </div>
                 </div>

                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Lưu</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                 </div>
             </form>
         </div>
     </div>
 </body>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 @if ($errors->any())
 <script>
     $(document).ready(function() {
         const action = "{{ old('action') }}"; // Truyền từ PHP vào JS
         if (action === 'update_info') {
             $('#updateInfoModal').modal('show');
         } else if (action === 'update_password') {
             $('#updatePasswordModal').modal('show');
         }
     });
 </script>
 @endif
 @endsection