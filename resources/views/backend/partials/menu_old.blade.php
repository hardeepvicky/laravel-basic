<style>
    #sidebar-menu ul li.mm-active a.active{
        background-color: var(--primary-bg-color);
        color: var(--primary-color);
    }
    #sidebar-menu ul li.mm-active a.active *{
        color: var(--primary-color);
    }

    .metismenu > li.mm-active {
        border-right: 1px solid var(--primary-bg-color);        
    }
</style>
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        @foreach($menus as $sub_menu)
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="{{ $sub_menu['icon'] }}"></i>
                <span>{{ $sub_menu['title'] }}</span>
            </a>
            <ul class="sub-menu">
                
                @isset($sub_menu['links'])
                    @foreach($sub_menu['links'] as $sub_menu2)                                    
                    <li>
                        @isset($sub_menu2['links'])
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="{{ $sub_menu2['icon'] }}"></i>
                                <span>{{ $sub_menu2['title'] }}</span>
                            </a>
                            <ul class="sub-menu">
                                @foreach($sub_menu2['links'] as $sub_menu3)                                                
                                <li>
                                    <a href="{{ route($sub_menu3['route_name']) }}" class="{{ $sub_menu3['is_active'] ? 'active' : '' }}">
                                        <i class="{{ $sub_menu3['icon'] }}"></i>
                                        <span>{{ $sub_menu3['title'] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @endisset
                        @isset($sub_menu2['route_name'])                                                            
                            <a href="{{ route($sub_menu2['route_name']) }}" class="{{ $sub_menu2['is_active'] ? 'active' : '' }}">
                                <i class="{{ $sub_menu2['icon'] }}"></i>
                                <span>{{ $sub_menu2['title'] }}</span>
                            </a>                            
                        @endisset                            
                                        
                    </li>
                    @endforeach 
                    
                @endisset
                @isset($sub_menu['route_name'])                    
                    <a href="{{ route($sub_menu['route_name']) }}" class="$sub_menu['is_active'] ? 'active' : '' }}">
                        <i class="{{ $sub_menu['icon'] }}"></i>
                        <span>{{ $sub_menu['title'] }}</span>
                    </a>
                @endisset
                </li>
            </ul>
        </li>
        @endforeach
        <li>        
    </ul>
</div>

<script>
    $(function(){
        $("a.active").parents("li").addClass("mm-active");
        $("a.active").parents("ul").addClass("mm-show");
    });
</script>