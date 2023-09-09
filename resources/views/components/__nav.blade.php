<div>
    <div class="container pt-1 md:py-2 px-5 md:px-10 lg:px-15 mx-auto flex justify-between">
        <div>
            <a href="dashboard">
                <p class="text-xl font-bold font-poppins_bold flex items-center"><i
                        class="bx bx-md bx-list-check m-0"></i> To
                    Do</p>
            </a>
        </div>
        <div class="hidden md:flex items-center justify-around space-x-20">
            @guest
                <a href="{{ route('login') }}" class="hover:text-purple-400 font-bold flex items-center"><i
                        class="bx bx-xs bx-log-in-circle mr-2 -ml-0.5"></i>Login</a>
            @endguest

            @auth
                <a href="javascript:;"
                    class="logout-link hover:text-purple-400 font-bold flex items-center">
                    <i class="bx bx-xs bx-log-out-circle mr-2 -ml-0.5"></i>Logout
                </a>
            @endauth
        </div>
        @auth
            <div class="md:hidden">
                <a href="#" class="mobile-menu hover:text-purple-400"><i class="bx bx-md bx-menu"></i></a>
            </div>
        @endauth
    </div>
    @auth
        <div id="sub-nav" class="hidden">
            <hr class="opacity-10">
            <a href="javascript:;" id="" 
                class="logout-link hover:text-purple-400 font-bold flex items-center">
                <div class="nav-options relative w-full py-1.5 px-5 items-center">
                    <span class="">Logout</span>
                    <span class="absolute right-6"><i class="bx bx-sm bx-log-out-circle"></i></span>
                </div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    @endauth
</div>
