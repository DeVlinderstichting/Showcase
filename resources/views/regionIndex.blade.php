@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

@section('title')
Admin home
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Search region <a class="btn btn-primary btn-sm" role="button" href="/regionCreate">Create new region</a>
            </h5>
            <div class="card-body">
                Search: <br>
                <table id="searchableTable" class="table table-sm table-striped table-hover vertical-align">
                    <thead>
                        <th><input id='searchId' onkeyup="searchTable()" type="text" name=""></th>
                        <th><input id='searchName' onkeyup="searchTable()" type="text" name=""></th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Region id</th>
                            <th>Region name</th>
                            <th>Edit</th>
                        </tr>
                        @foreach ($regions as $region)
                            <tr onclick="location.href = '/region/{{$region->id}}';" style="cursor: pointer;">
                                <td>{{$region->id}}</td>
                                <td>{{$region->name}}</td>
                                <td><a href='/region/{{$region->id}}'><i class='fa fa-pencil' style='font-size:24px;'></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/adminHome" class="btn btn-secondary m-1">Back</a>
            </div>
        </div>
    </div>
    <script>
        function searchTable()
        {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchId");
            filter = input.value.toUpperCase();
            input1 = document.getElementById("searchName");
            filter1 = input1.value.toUpperCase();
            table = document.getElementById("searchableTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) 
            {
                td = tr[i].getElementsByTagName("td")[0];
                td1 = tr[i].getElementsByTagName("td")[1];
                if (td) 
                {
                    txtValue = td.textContent || td.innerText;
                    txtValue1 = td1.textContent || td1.innerText;
                    if ((txtValue.toUpperCase().indexOf(filter) > -1) && (txtValue1.toUpperCase().indexOf(filter1) > -1))
                    {
                        tr[i].style.display = "";
                    } 
                    else 
                    {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        
    </script>
@endsection
