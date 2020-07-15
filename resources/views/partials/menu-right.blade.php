 <!--
<li class="hide-for-small-only">
    <a href="#" data-toggle-search-trigger>
        <i class="fas fa-search"></i>
    </a>
</li>
-->
@if (Auth::guest())

<li class="trasparen" >
    <a class="trasparen header-logo float-left" style="margin-right: 0px !important;" href="{{ route('login') }}">Inicio de Seccion</a>
 <!--
    <a href="#">Seller</a>
    <ul class="menu">
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        <li><a href="#">How does it work ?</a></li>
        <li><a href="#">FAQ</a></li>
    </ul>
-->
</li>
<!--
<li>
    <a href="#">Reviewer</a>
    <ul class="menu">
        <li><a href="#">delete</a></li>
    </ul>
</li>

<li>
    <a href="#" style="padding-top:0px;padding-bottom:0px;">
        <span class="fa-stack fa-lg">
           <i class="fa fa-ban fa-stack-1x text-danger" style="color:red;"></i>
        </span>
    </a>

      <ul class="menu">
          <li><a href="#">P</a></li>
      </ul>
</li> -->
@else
    <li>
        <a href="#">My Account</a>
        <ul class="menu">
            <li>
                <a href="{{ route('voyager-frontend.account') }}">Update Account</a>
            </li>
            <li>
                @if (Session::has('original_user.id'))
                    <a href="#"
                       onclick="document.getElementById('impersonate-form').submit();return false;">
                        Switch back to {{ Session::get('original_user.name') }}
                    </a>
                    <form id="impersonate-form"
                          action="{{ route('voyager-frontend.account.impersonate', Session::get('original_user.id')) }}"
                          method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="#" onclick="document.getElementById('logout-form').submit();return false;">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            </li>
        </ul>
    </li>
@endif
