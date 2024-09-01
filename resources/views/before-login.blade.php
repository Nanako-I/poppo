@vite(['resources/css/app.css', 'resources/js/app.js'])
<!-- Card Blog -->
<body class="bg-gradient-to-r from-red-200 via-red-50 to-orange-50">
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="grid lg:grid-cols-2 gap-6">
    <!-- Card -->
    	<a class="group relative block rounded-xl transform transition-transform duration-300 ease-in-out shadow-xl hover:-translate-y-2 hover:shadow-lg" href="{{ url('auth.login') }}">
    	  <!--<div class="flex-shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">-->
       <!-- <img class="size-full absolute top-0 start-0 object-cover" src="{{ asset('storage/sample/before-login_photo/staff-before-login.jpg')}}" alt="Image Description">-->
      <div class="relative rounded-xl overflow-hidden w-full h-[350px]">
        <img class="w-full h-full object-cover" src="{{ asset('storage/sample/before-login_photo/staff-before-login.jpg')}}" alt="Image Description">
      </div>

      <div class="absolute top-0 inset-x-0 z-10">
        <div class="p-4 flex flex-col h-full sm:p-6">
          <h3 class="text-lg sm:text-3xl font-semibold text-black group-hover:text-black/80">
                職員の方はこちら
          </h3>
          <!-- Avatar -->
          <div class="flex items-center">
            <div class="ms-2.5 sm:ms-4">
            </div>
          </div>
          <!-- End Avatar -->
        </div>
      </div>

      <div class="absolute bottom-0 inset-x-0 z-10">
        <div class="flex flex-col h-full p-4 sm:p-6">
         </div>
      </div>
    </a>
    <!-- End Card -->

    <!-- Card -->
    <a class="group relative block rounded-xl transform transition-transform duration-300 ease-in-out shadow-xl hover:-translate-y-2 hover:shadow-lg"  href="{{ url('/hogoshalogin') }}">
      <!--<div class="flex-shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">-->
      <!--  <img class="size-full absolute top-0 start-0 object-cover" src="{{ asset('storage/sample/before-login_photo/family-before-login.jpg')}}" alt="Image Description">-->
      <div class="relative rounded-xl overflow-hidden w-full h-[350px]">
        <img class="w-full h-full object-cover" src="{{ asset('storage/sample/before-login_photo/family-before-login.jpg')}}" alt="Image Description">
      </div>

      <div class="absolute top-0 inset-x-0 z-10">
        <div class="p-4 flex flex-col h-full sm:p-6">
          <h3 class="text-lg sm:text-3xl font-semibold text-black group-hover:text-black/80">
                ご家族の方はこちら
          </h3>
          <!-- Avatar -->
          <div class="flex items-center">
           
            <div class="ms-2.5 sm:ms-4">
            </div>
          </div>
          <!-- End Avatar -->
        </div>
      </div>

      <div class="absolute bottom-0 inset-x-0 z-10">
        <div class="flex flex-col h-full p-4 sm:p-6">
        </div>
      </div>
    </a>
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Card Blog -->
</body>