<div class="trasparen off-canvas position-right" id="offCanvas" data-off-canvas data-transition="push">
    <a href="#" class="close-button off-canvas-menu-icon-close" data-close="offCanvas">
        <span aria-hidden="true">&times;</span>
    </a>

    <ul class="vertical menu">         
        <li >
            <a class="header-logo float-left" style="margin-right: 0px !important;" href="{{ route('home') }}">Premium</a>
        
        </li>     
        
    </ul>

    <hr>

    <ul class="trasparen vertical menu">
        @include('partials.menu-right') 
              
    </ul>

    <hr>

    <ul class="menu social-icons align-center">
        {{ menu('social', 'partials.social') }}
    </ul>
</div>

<div class="background-banner off-canvas-content" data-off-canvas-content>
    <div class="header-site-search" data-toggle-search>
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell medium-8 medium-offset-2">
                    @include('partials.search-box')
                </div>
            </div>
        </div>
    </div>


    <div class="top-bar trasparen" style="border-bottom: 1px !important;padding-bottom: 0px;">
        <div class="top-bar-left">
            <a href="#" class="off-canvas-menu-icon float-right hide-for-medium" data-open="offCanvas">
                <i class="fas fa-bars"></i> <span>Menu</span>
            </a>

            <a href="#" class="search-icon-mobile float-right hide-for-medium" data-toggle-search-trigger>
                <i class="fas fa-search"></i>
            </a>

            

           <!-- <ul class="dropdown menu show-for-medium" data-dropdown-menu>
                {{ menu('primary', 'partials.menu-left') }}
            </ul>  /.menu -->
        </div>

        <div class="top-bar-right show-for-medium">
            <ul class="trasparen dropdown menu" data-dropdown-menu>
                @include('partials.menu-right')
            </ul>
        </div>
    </div>
