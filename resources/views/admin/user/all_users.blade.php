@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Danh sách phân quyền
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs text-danger">
        <?php
                      $message = Session::get('message');
                      if($message){
                    echo $message;
                    Session::put('message',NULL);
                      }
                      ?>
                   
      </div>
      
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="UserTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên user</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Administrator</th>
            <th>Manager</th>
            <th>Editor</th>
            <th>Accountant</th>
            <th>Shipper</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($admin as $key => $user)
          @php
            $i++;
          @endphp
            
            <tr>
              <form action="{{url('/assign-roles')}}" method="POST">
                @csrf
              <td>{{$i}}</td>
              <td>{{$user->admin_name}}</td>
              <td>
                {{$user->admin_email}}
                <input type="hidden" name="admin_email" value="{{$user->admin_email}}">
                <input type="hidden" name="admin_id" value="{{$user->admin_id}}">
              </td>
              <td>{{$user->admin_phone}}</td>
              <td>
                <input type="checkbox" name="administrator_role" {{$user->hasRole('administrator') ? 'checked' : ''}}>
              </td>
              <td>
                <input type="checkbox" name="manager_role" {{$user->hasRole('manager') ? 'checked' : ''}}>
              </td>
              <td>
                <input type="checkbox" name="editor_role" {{$user->hasRole('editor') ? 'checked' : ''}}>
              </td>
              <td>
                <input type="checkbox" name="accountant_role"{{$user->hasRole('accountant') ? 'checked' : ''}}>
              </td>
              <td>
                <input type="checkbox" name="shipper_role"{{$user->hasRole('shipper') ? 'checked' : ''}}>
              </td>

              <td>
                <button type="submit" class="btn btn-sm btn-default">Phân quyền</button>
                <a style="margin: 5px 0px;width: 85px" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này không?')" class="btn btn-sm btn-danger"href="{{url('/delete-user-roles/'.$user->admin_id)}}">Xóa user</a>
              </td>
            </form>
            </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
            $('#UserTable').DataTable();
</script>
@endsection