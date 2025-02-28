<style>
    .search-menu-link-block
    {
        width: 60vw;
        max-width: 700px;
    }

    #search_menu:focus
    {
        color: var(--bs-body-color);
        background-color: var(--bs-topbar-search-bg);
        border-color: var(--bs-search-border-color);
    }

    #search_menu_autocomplete
    {
        width: 60vw;
        height: 50vh;
        max-width: 700px;
        padding: 0;
        margin: 0;
        position: fixed;
        z-index: 1;
        background-color: var(--bs-topbar-search-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: 0 0 5px 5px;
        display: none;
    }

    #search_menu_autocomplete ul
    {
        width: 100%;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #search_menu_autocomplete ul li
    {
        padding : 0;
        margin: 0;
        border-bottom: 2px solid var(--bs-border-color);
    }

    #search_menu_autocomplete ul li a{
        padding : 8px 10px;
        display: block;
    }

    #search_menu_autocomplete ul li:hover a
    {
        background-color: color-mix(in srgb,var(--bs-link-color),#FFF 70%);
    }

    [data-layout-mode=dark] #search_menu_autocomplete ul li:hover a
    {
        background-color: color-mix(in srgb,var(--bs-topbar-search-bg),#000 20%);
    }

    #search_menu_autocomplete ul li:hover a
    {
        font-weight: bold;
        transition: font-weight 0.5s;
    }
</style>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/home" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                    </span>
                </a>

                <a href="/home" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block search-menu-link-block">
                <div class="position-relative">
                    <input id="search_menu" type="text" class="form-control" placeholder="Search Menu Link">
                    <div id="search_menu_autocomplete" class="simplebar-content-wrapper">
                        <div class="simplebar-content">
                            <ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @php
                        $user = Auth::user();
                    @endphp
                    @if(isset($user->profile_image) && $user->profile_image)
                        <img class="rounded-circle header-profile-user" src="{{ FileUtility::get($user->profile_image) }}" alt="Header Avatar">
                    @endif
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">
                        {{ Auth::user()->name }}
                    </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="javascript:void(0);">
                        <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
            @endguest
        </div>
    </div>
</header>

<script>
    $(function(){
        $("#mode-setting-btn").click(function(){
            var mode = $("body").attr("data-layout-mode");
            if (mode)
            {
                localStorage.setItem("layout-mode", mode);
            }
        });
    });
</script>

<script type="text/javascript">
    //search menu link
    var menu_autocomplete_list = JSON.parse('<?= json_encode($header_menu_list) ?>');
    console.log(menu_autocomplete_list);
    $(document).ready(function()
    {
        new SimpleBar(document.getElementById('search_menu_autocomplete'));

        function search_simple(search_text)
        {
            var list = []
            for (var i in menu_autocomplete_list)
            {
                var link = menu_autocomplete_list[i];

                if (link['title'].toLowerCase().indexOf(search_text) >= 0)
                {
                    list.push(link);
                }
            }

            return list;
        }

        function search_list_in_string(search_list)
        {
            var list = [];
            for (var i in menu_autocomplete_list)
            {
                var link = menu_autocomplete_list[i];

                var is_all_part_found = true;
                for(var a in search_list)
                {
                    var part = search_list[a].trim();

                    if (part.length >= 2)
                    {
                        if (link['title'].toLowerCase().indexOf(part) == -1)
                        {
                            is_all_part_found = false;
                        }
                    }
                }

                if (is_all_part_found)
                {
                    list.push(link);
                }
            }

            return list;
        }

        function show_autocomplete_list(search_text)
        {
            var list = search_simple(search_text);

            var sub_parts = search_text.split(" ");
            if (sub_parts.length > 1)
            {
                var list2 = search_list_in_string(sub_parts);

                for (var a in list2)
                {
                    var link2 = list2[a];
                    var is_found = false;
                    for (var i in list)
                    {
                        var link = list[i];

                        if (link['title'] == link2['title'])
                        {
                            is_found = true;
                        }
                    }

                    if (!is_found)
                    {
                        list.push(link2);
                    }
                }
            }

            var html = "";
            for (var i in list)
            {
                var link = list[i];
                html += "<li>"
                    html += '<a href="' + link["url"] + '">' + link["title"] + '</a>';
                html += "</li>";
            }

            $("#search_menu_autocomplete ul").html(html);
            $("#search_menu_autocomplete").show();            
        }

        function hide_autocomplete_list()
        {
            $("#search_menu_autocomplete ul").html("");
            $("#search_menu_autocomplete").hide();
        }

        function show_or_hide_search_menu_autocomplete()
        {
            var search = $("input#search_menu").val();
            if (search.length >= 1)
            {
                search = search.trim().toLowerCase();
                show_autocomplete_list(search);
                $.blackdrop.show();
            }
            else
            {
                hide_autocomplete_list();
                $.blackdrop.hide();
            }
        }

        $("input#search_menu").keyup(function(e)
        {
            if (e.key == "Escape")
            {
                $(this).val("");
            }

            show_or_hide_search_menu_autocomplete();
        });

        $("input#search_menu").focus(function(){
            show_or_hide_search_menu_autocomplete();
        });

        $.blackdrop.init();
        $.blackdrop.onClick(function(){
            $("#search_menu_autocomplete").hide();            
        });
    });
</script>