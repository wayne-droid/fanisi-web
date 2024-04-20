@extends('bars')
@section('body_content')

    <style>
        .profile_card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            margin: auto;
            text-align: center;
        }
        
        .title {
            color: grey;
            font-size: 18px;
        }
        
        /* .profile_button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        
        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }
        
        button:hover, a:hover {
            opacity: 0.7;
        } */
    </style>

    <div id="wrapper" style="font-size: 12px;">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="mb-2 text-gray-800">Users</h3>
                    @if(session('user')->is_admin == '0')
                        <a href="/new/user" class="btn btn-sm" style="background-color: #EE1D52; color: #fff"><i class="fa fa-plus"></i> New User</a>
                    @endif()
                    <br><br>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th hidden="hidden">#</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Created</th>
                                            <th>Last Login</th>
                                            <th>View User</th>
                                            <th>Edit User</th>
                                            <th>Delete User</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="exampleViewUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewUserTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="viewModalBody">
                        
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>

        let base_api_url = '{{ env("BASE_API_URL") }}';
        let userList = null;

         $(document).ready(function()
        {
            swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            $('#dataTable').DataTable({
                "pageLength":100,
                "bDestroy": true,
                processing: true,
                ajax:
                {
                    type: "GET",
                    url: base_api_url + '/fetch/users',
                    dataSrc: function ( json )
                    {
                        if(json != null)
                        {
                            userList = json['users'];
                            return json['users'];
                        }
                    }
                },
                'columnDefs' : [
                    //hide column
                    { 'visible': false, 'targets': [0] }
                ],
                columns: [
                    {'data': 'id'},
                    {'data': 'name'},
                    {'data': 'company'},
                    {'data': 'email'},
                    {'data': 'phone_number'},
                    {
                        'data': ({created_at}) => moment(created_at).format("llll")
                    },
                    {
                        'data': ({last_login}) => moment(last_login).format("llll")
                    },
                    { 
                        'data': null, 
                        wrap: true, "render": function (item) 
                        {
                             return '<div class="btn-group"> <button onclick="viewUserModal('+item.id+')" class="btn btn-success"><i class="fa fa-eye fa-sm mr-1"></i></button></div>' 
                        } 
                    },
                    { 
                        'data': null, 
                        wrap: true, "render": function (item) 
                        {
                             return '<div class="btn-group"> <button onclick="editUserModal('+item.id+')" class="btn btn-primary"><i class="fa fa-edit fa-sm mr-1"></i></button></div>' 
                        } 
                    },
                    { 
                        'data': null, 
                        wrap: true, "render": function (item) 
                        {
                             return '<div class="btn-group"> <button onclick="deleteUser('+item.id+')" class="btn btn-danger"><i class="fa fa-trash fa-sm mr-1"></i></button></div>' 
                        } 
                    },
                ],
            });
        });

        function viewUserModal(user_id)
        {
            let user = userList.filter(e => e.id == user_id)[0];

            let body_input = `
                <div class="profile_card">
                    <img src="img/man.png" alt="John" style="width:70%">
                    <h1>${user.name}</h1>
                    <p class="title">Company: ${user.company}</p>
                    <p>Email: ${user.email}</p>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <p><button>Contact</button></p>
                </div>
            `

            document.getElementById('viewModalBody').innerHTML = body_input;

            $("#viewUser").modal('show')
        }

        function editUserModal(user_id)
        {
            document.getElementById('viewUserTitle').innerText = 'Edit User Details';

            let user = userList.filter(e => e.id == user_id)[0];

            let body_input = `
                <form class="user" method="post">
                    <div class="form-group">
                        <label>Is Admin</label><br>
                        <select name="role" style="width:100%;" id="dropdown" class="chosen" required>
                            <option value="0">Administrator</option>
                            <option value="1">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label><br>
                        <input type="text" class="form-control form-control-user" name="user_name" value="${user.name}" required>
                    </div>
                    <div class="form-group">
                        <label>Company</label><br>
                        <input type="text" class="form-control form-control-user" name="company" value="${user.company}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label><br>
                        <input type="number" class="form-control form-control-user" name="phone" value="${user.phone_number}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label><br>
                        <input type="email" class="form-control form-control-user" name="email" value="${user.email}" required>
                    </div>
                    
                    <input type="button" name="submit" onclick="update(${user.id})" style="background-color:#ff5900;color:#fff" class="btn btn-user btn-block" value="Update Account"/>
                </form>
            `

            document.getElementById('viewModalBody').innerHTML = body_input;

            $("#viewUser").modal('show')
        }

        function update(id)
        {
            let name = $('input[name="user_name"]').val();
            let email = $('input[name="email"]').val();
            let phone = $('input[name="phone"]').val();
            let company = $('input[name="company"]').val();
            let is_admin = $('#dropdown').val();

            console.log('Input name:', name);
            console.log('Input email:', email);
            console.log('Input phone:', phone);
            console.log('Input company:', company);
            console.log('Input is_admin:', is_admin);

            let post_body = {
                "name":name,
                "phone_number":phone,
                "email":email,
                "is_admin":is_admin,
                "company":company
            }

            fetch(base_api_url + '/update/user/'+id, {
                method: "PUT",
                body:JSON.stringify(post_body),
                headers: {
                    "Content-type": "application/json;",
                    'Authorization': '<?php echo session('token') ?>',
                }
            })
            .then(response => 
            {
                if (!response.ok) 
                {
                    Swal.fire("Failed!", `${response.status}`, "error");
                }
                // Retrieve the status code
                console.log('Status code:', response.status);
                // Continue processing the response
                return response.json();
            })
            .then((json) =>
            {
                console.log('response ' + json);

                if ( json.status_code == 0)
                {
                    Swal.fire("Done!", `${json.message}`, "success");
                }
                else
                {
                    Swal.fire("Failed!", `${json.message}`, "error");
                }
            });
        }

        function deleteUser(id)
        {
            swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "User will be deleted from the system",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) =>
                {
                    if (result.isConfirmed)
                    {
                        fetch(base_api_url + '/delete/user/'+id, {
                        method: "GET",
                        headers: {
                            "Content-type": "application/json;",
                            'Authorization': '<?php echo session('token') ?>',
                        }
                        })
                        .then(response => 
                        {
                            if (!response.ok) 
                            {
                                Swal.fire("Failed!", `${response.status}`, "error");
                            }
                            // Retrieve the status code
                            console.log('Status code:', response.status);
                            // Continue processing the response
                            return response.json();
                        })
                        .then((json) =>
                        {
                            console.log('response ' + json);

                            if ( json.status_code == 0)
                            {
                                Swal.fire("Done!", `${json.message}`, "success");
                            }
                            else
                            {
                                Swal.fire("Failed!", `${json.message}`, "error");
                            }
                        });
                    }
                    else if (result.dismiss === Swal.DismissReason.cancel)
                    {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            ':)',
                            'error'
                        )
                    }
                })
        }
    </script>
@endsection()
