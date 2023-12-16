@extends('layout.default')
@section('manageUsersActive')
active
@endsection
@section('breadcrumb')
Manage Users
@endsection
@section('content')
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Manage users</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Position</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last login</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tools</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{$key+1}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-xs font-weight-bold mb-0">{{$user['name']}}</p>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0">{{$user['email']}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{$user['position']['name']??'Empty'}}</span>
                          </td>
                          <td class="align-middle text-center">

                            <span class="badge badge-sm {{$user['login_at']?'bg-gradient-success':'bg-gradient-danger'}}">{{$user['login_at']??'Never login'}}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span>
                                <a href="#" class="edit-user-modal-button text-secondary font-weight-bold text-xs" user-id="{{$user['id']}}" data-toggle="modal" data-target="#editUserModal">
                              Edit
                                </a>
                            </span>
                            <span>
                                <a href="javascript:void(0)" class="delete-user-button text-secondary font-weight-bold text-xs" user-id="{{$user['id']}}" data-toggle="tooltip" data-original-title="Delete user">
                              Delete
                            </a>
                            </span>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                      <input type="hidden" id="userIdDelete" name="userIdDelete" value="">
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
@endsection
@section('modal')
<div class="modal fade show" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form role="form"id="editUserForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="userId" id="hiddenUserId" value="">
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" required id="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <label>Name</label>
                    <div class="mb-3">
                      <input type="text" required id="name" name="name" class="form-control" placeholder="Name" aria-label="Password" aria-describedby="password-addon">
                    </div>
                     <label>Position</label>
                    <div class="mb-3">
                      <select class="form-control" id="position" name="position">
                            @foreach ($positions as $position)
                              <option value="{{$position['id']}}">{{$position['name']}}</option>
                            @endforeach
                      </select>
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="first_password" id="first_password" class="form-control" placeholder="New Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="mb-3">
                      <input type="password" name="second_password" id="second_password" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="button" id="saveEditUserButton" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade show" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Are you sure to delete user?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">No</button>
                <button type="button" id="comfirmDelete" class="btn btn-primary">Yes</button>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('js')
<script type="text/javascript">
    let users = <?php echo json_encode($users); ?>;
    let positions = <?php echo json_encode($positions); ?>;
    $(document).ready(function(){
        $('.edit-user-modal-button').click(function(){
            let userId = $(this).attr('user-id');
            let user = users.filter(user=>user.id==userId)[0];
            $('#hiddenUserId').val(userId);
            $('#email').val(user.email);
            $('#name').val(user.name);
            $(`#position [value=${user.position?.id}]`).attr('selected','true');

            $('#editUserModal').modal('toggle')
        });
        $('#editUserModal .close').click(()=>{
            $('#editUserModal').modal('toggle')
        });
        $('.delete-user-button').click(function(){
            if(confirm('Are you sure to delete user?')){
                let userId = $(this).attr('user-id');
                $('#userIdDelete').val(userId);
                $('#deleteUserForm').submit();
            }
        });
        $('#saveEditUserButton').click(function(){
            validateEditUser();
        });
    });

    let validateEditUser = ()=>{
        if($('#email').val()==''){
            alert('Email not empty!');
            return;
        }else if($('#name').val()==''){
            alert('Name not empty!');
            return;
        }else if($('#first_password').val()!=''&&$('#second_password').val()==''){
            alert('Please enter confirm password!');
            return;
        }else if($('#first_password').val()==''&&$('#second_password').val()!=''){
            alert('Please enter new password before!');
            return;
        }else if($('#first_password').val()!=''&&$('#second_password').val()!=''){
            if($('#first_password').val()!=$('#second_password').val()){
                alert('New password and confirm password not match!');
                return;
            }
        }
        $('#editUserForm').submit();
    }

</script>

@endsection