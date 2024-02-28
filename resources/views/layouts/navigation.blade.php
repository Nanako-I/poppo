<div class = "top_total">
<nav x-data="{ open: false }" class="dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
     <style>
    .top_total{
                background-image: linear-gradient(to right, rgb(255, 195, 160,0.5), rgb(255,175,189,1));
            }
    </style>
</div> 
    <!-- Primary Navigation Menu -->
    <div class="top_bar mx-auto px-4 sm:px-6 lg:px-8 bg-orange-200">
        <style>
            .top_bar{
                background-image: linear-gradient(to right, rgb(255, 195, 160,0.5), rgb(255,175,189,1));
            }
            
        </style>
       
        <div class="flex justify-between h-16">
            <div class="flex ml-1">
                <!-- Logo -->
                @if (!request()->is('pdf/*/edit')) 
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('people') }}" >
                       
                        <img src="{{ asset('storage/sample/pink-heart.png') }}" width ="60" height="60">
                    </a>
                </div>
                @endif
                
                

                <!-- Navigation Links -->
                <!--<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">-->
                <!--    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">-->
                <!--        {{ __('Dashboard') }}-->
                <!--    </x-nav-link>-->
                <!--</div>-->
                
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex {{ request()->is('people') ?  ' text-black' : '' }} px-4 py-2 rounded-md text-3xl font-bold max-w-4xl text-black">
                     
                     <x-nav-link :href="url('people')" :active="request()->is('people')">
                    {{ __('利用者一覧') }}
                    </x-nav-link>
                </div>
                
                  <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex {{ request()->is('peopleregister') ? ' text-black' : '' }} px-4 rounded-md text-xl font-bold items-center justify-center">
                     <!--<i class="material-icons md-48" id="face">face</i>-->
                     <x-nav-link :href="url('peopleregister')" :active="request()->is('peopleregister')">
                        {{ __('新規登録') }}
                    </x-nav-link>
                </div>
                
                <!--<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex {{ request()->is('temperaturelist') ? 'bg-custom-pink text-black' : '' }} px-4 rounded-md text-xl font-bold hover:bg-custom-hover-pink items-center justify-center">-->
                <!--     <i class="material-icons md-48" id="face">face</i>-->
                <!--     <x-nav-link :href="url('temperaturelist')" :active="request()->is('temperaturelist')">-->
                <!--        {{ __('体温登録') }}-->
                <!--    </x-nav-link>-->
                <!--</div>-->
            
                <!--<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex {{ request()->is('foodlist') ? 'bg-custom-pink text-black' : '' }} px-4 rounded-md text-xl font-bold hover:bg-custom-hover-pink items-center justify-center">-->
                <!--     <i class="material-icons md-48" id="face">face</i>-->
                <!--     <x-nav-link :href="url('foodlist')" :active="request()->is('foodlist')">-->
                <!--        {{ __('食事登録') }}-->
                <!--    </x-nav-link>-->
                <!--</div>-->
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <!--<div class="-mr-2 flex items-center sm:hidden">-->
            <!--    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">-->
            <!--        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">-->
            <!--            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />-->
            <!--            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />-->
            <!--        </svg>-->
            <!--    </button>-->
            <!--</div>-->
            
                
                    <!--Qiitaの記事↓-->
                    <div class="hamburger" id="hamburger">
                      <div class="row"></div>
                      <div class="row"></div>
                      <div class="row"></div>
                    </div>
                    <div class="hamburger-menu" id="hamburger-menu">
                      <div class="close" id="close">
                        <span class="square_btn"></span>
                      </div>
                      <ul>
                        <li><a href="{{ url('people') }}" >利用者一覧</a></li>
                        <li><a href="{{ url('peopleregister') }}" >新規登録</a></li>
                      </ul>
                    </div>
               </div>
        </div>
        <style>
        
        * {
              margin: 0;
              padding: 0;
            }
            
            body {
              overflow-x: hidden;
              position: relative;
            }
            
            @media screen and (max-width: 640px) {
            .hamburger {
              margin-top: 10px;
              margin-right: 30px;
              cursor: pointer;
              position: absolute;
              top: 5px;
              right: 5px;
              /*display: none;*/
            }
            }
            
            @media screen and (min-width: 641px) {
              .hamburger {
                display: none;
              }
            }
            
            .row {
              margin: 5px;
              width: 20px;
              height: 2px;
              background-color: black;
            }
            
            li {
              list-style: none;
              margin-top: 5px;
              color: #fff;
              padding: 0 10px;
            }
            
            .hamburger-menu {
              /*position: absolute;*/
              top: 0;
              right: -200px;
              background-color: gray;
              padding: 20px 50px;
              transition: all 0.5s 0s ease;
              display: flex;
              flex-direction: column;
              z-index: 10; /*people.blade.phpの要素よりも上に表示させる
              /*display: none;*/
            }
            
            .show {
              position: absolute;
              top: 0;
              right: 0;
              background-color: gray;
              padding: 20px 50px;
            }
            
            .close {
              margin-bottom: 20px;
              cursor: pointer;
            }
            
            .square_btn {
              display: block;
              position: relative;
            }
            
            .square_btn::before,
            .square_btn::after {
              content: "";
              position: absolute;
              top: 0;
              left: 0;
              width: 1px; /* 棒の幅（太さ） */
              height: 20px; /* 棒の高さ */
              background: #fff; /* バツ印の色 */
            }
            
            .square_btn::before {
              transform: translate(-50%, -50%) rotate(45deg);
            }
            
            .square_btn::after {
              transform: translate(-50%, -50%) rotate(-45deg);
            }
        </style>
        
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<!-- JavaScript 部分 -->
<script>
// ハンバーガーメニュー↓

let hamburger = document.getElementById("hamburger");
let hamburgerMenu = document.getElementById("hamburger-menu");
let close = document.getElementById("close");

// ページが読み込まれたときには何もしない
document.addEventListener("DOMContentLoaded", function() {
    hamburgerMenu.style.display = "none";
});

hamburger.addEventListener('click', function () {
    hamburgerMenu.classList.toggle('show');
    
    // hamburger-menuの表示状態に合わせてdisplayプロパティを切り替える
    if (hamburgerMenu.classList.contains('show')) {
        hamburgerMenu.style.display = "flex";
    } else {
        hamburgerMenu.style.display = "none";
    }
});

close.addEventListener('click', function () {
    hamburgerMenu.classList.remove('show');
    hamburgerMenu.style.display = "none"; // closeボタンが押されたら非表示にする
    hamburger.style.display = "block";
});
</script>



<!--<style>-->
<!--.fade-enter-active, .fade-leave-active, .slide-enter-active, .slide-leave-active {-->
<!--  transition: opacity 0.3s, transform 0.3s;-->
<!--}-->
<!--.fade-enter, .fade-leave-to, .slide-enter, .slide-leave-to {-->
<!--  opacity: 0;-->
<!--}-->
<!--.slide-enter, .slide-leave-to {-->
<!--  transform: translateX(-100%);-->
<!--}-->
<!--</style>-->