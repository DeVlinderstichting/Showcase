@isset($menuActive)
@else
    @php
        $menuActive = '';
    @endphp
@endisset


    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/home/logoff">
                        Logoff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($menuActive=='users') active @endif" href="/user">
                        Users
                    </a>
                </li>
            </ul>

            <a class="text-muted" style="text-decoration: none !important" href onclick="toggleProjectsNav(); return false;"><h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            Regions<i class='fa fa-plus'></i>
            </h6></a>
            <ul class="nav flex-column mb-2d d-none" id="projectNavigation">
                @foreach(\App\Models\Region::all()->sortBy('id') as $p)
                    <li class="nav-item">
                        <a href="/project/{{$p->id}}"  class="nav-link @if($menuActive=='p_'. $p->id) active @endif">{{$p->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <script>
        var storageVal = localStorage.getItem("projExp");
        function toggleProjectsNav () 
        {
            if ($('#projectNavigation').hasClass('d-none'))
            {
                $('#projectNavigation').removeClass('d-none');
                localStorage.setItem("projExp", true);
            }
            else 
            {
                $('#projectNavigation').addClass('d-none');
                localStorage.setItem("projExp", false);
            }
        }
        $(document).ready(function ()
        {
            if (storageVal == 'true')
            {
                $('#projectNavigation').removeClass('d-none');
            }
            else 
            {
                $('#projectNavigation').addClass('d-none');
            }
        });
    </script>

