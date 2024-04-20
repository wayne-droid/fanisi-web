@extends('bars')
@section('body_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5" style="width: 60%;">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                    </div>
                    
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
                            <input type="text" class="form-control form-control-user" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label>Company</label><br>
                            <input type="text" class="form-control form-control-user" name="company" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label><br>
                            <input type="number" class="form-control form-control-user" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label><br>
                            <input type="email" class="form-control form-control-user" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label><br>
                            <input type="password" class="form-control form-control-user" id="pass" name="password" required><br>
                                <input type="checkbox" onclick="myFunction()">  Show Password
                        </div>
                        <input type="button" name="submit" onclick="create()" style="background-color:#ff5900;color:#fff" class="btn btn-user btn-block" value="Create Account"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        let base_api_url = '{{ env("BASE_API_URL") }}';

        $(".chosen").chosen();

        function myFunction() 
        {
            var x = document.getElementById("pass");
            if (x.type === "password") 
            {
                x.type = "text";
            } 
            else 
            {
                x.type = "password";
            }
        }

        function create()
        {
            let name = $('input[name="user_name"]').val();
            let email = $('input[name="email"]').val();
            let phone = $('input[name="phone"]').val();
            let password = $('input[name="password"]').val();
            let company = $('input[name="company"]').val();
            let is_admin = $('#dropdown').val();

            console.log('Input name:', name);
            console.log('Input email:', email);
            console.log('Input phone:', phone);
            console.log('Input password:', password);
            console.log('Input company:', company);
            console.log('Input is_admin:', is_admin);

            let post_body = {
                "name":name,
                "phone_number":phone,
                "email":email,
                "password":password,
                "is_admin":is_admin,
                "company":company
            }

            fetch(base_api_url + '/new/user', {
                method: "POST",
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

    </script>
@endsection()