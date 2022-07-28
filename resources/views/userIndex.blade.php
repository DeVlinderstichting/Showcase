@extends('layouts.app')

@section('title')
Users
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Search user
                <a class="btn btn-primary btn-sm float-right" role="button" href="/user/create/-1">Create new user</a>
            </h5>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" onkeyup="searchUsers();" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{old('name')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email address</label>
                    <div class="col-sm-10">
                       <input type="text" onkeyup="searchUsers();" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" value="{{old('email')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Search user
            </h5>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover vertical-align">
                    <thead>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Login</th>
                    </thead>
                    <tbody id="searchResultTable">
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            function searchUsers()
            {
                var email = document.getElementById('email').value;
                var name = document.getElementById('name').value;

                $.ajax({
                    type:'POST',
                    url: '/user/indexAjax',
                    data: 
                    {
                        "email": email, 
                        "name": name
                    },
                    success:function(data) 
                    {
                        //$("#searchResultTable tr").remove(); 
                        var resTable = document.getElementById('searchResultTable');
                        resTable.innerHTML = "";
                        var max = data.length; if (max>200){max=200;}
                        for(var i = 0; i < max; i++)
                        {
                            var email = data[i]['email']; if (data[i]['email'] == null){email='-';}
                            var name = data[i]['name']; if (data[i]['name'] == null){name='-';}
                            name = name.replace(/^\w/, c => c.toUpperCase());

                            resTable.innerHTML += "<tr onclick='goToEditUser(" + data[i]['id'] + ")'>" + 
                            "<td>" + data[i]['name'] + "</td>" +
                            "<td>" + email + "</td>" +
                            "<td> <a class='btn btn-primary btn-sm' role='button' href='/admin/loginAsUser/" + data[i]['id'] + "'>Login as user</a></td>" + "</tr>";
                        }
                    }
                });
            }
            function goToEditUser(uid)
            {
                window.location.href = "/user/create/" + uid; 
            }
        </script>
    </div>
@endsection