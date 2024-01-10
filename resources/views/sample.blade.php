@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
     
  <section class="text-gray-600 body-font" _msthidden="10">
  <div class="container px-5 py-24 mx-auto flex flex-wrap" _msthidden="10">
    <!--<div class="lg:w-1/2 w-full mb-10 lg:mb-0 rounded-lg overflow-hidden" _msthidden="1">-->
    <!--  <img alt="feature" class="object-cover object-center h-full w-full" src="https://dummyimage.com/460x500" _msthidden="A" _mstalt="97799" _msthash="739">-->
    <!--</div>-->
    <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center" _msthidden="9">
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
          <!--<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">-->
            <i class="fa-solid fa-thermometer text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
          <!--</svg>-->
          
        </div>
        <!--<h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">体温</h2>-->
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">体温</h2>
          
            <div class="flex justify-around text-left items-start">
              <p class="text-gray-900 font-bold text-xl px-3">21：47</p>
              <p class="text-gray-900 font-bold text-xl px-3">36.7℃</p>
            </div>
         <p class="text-gray-900 font-bold text-xl p-4">健康面問題なし</p>
          <!--<a class="mt-3 text-indigo-500 inline-flex items-center" _msthidden="1">-->
          <!--  <font _mstmutation="1" _msttexthash="130533" _msthidden="1" _msthash="742">Learn More</font>-->
          <!--  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">-->
          <!--    <path d="M5 12h14M12 5l7 7-7 7"></path>-->
          <!--  </svg>-->
          <!--</a>-->
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">

      </div>
      <!--<hr width="600" style="border: 1px solid #666; margin: 0 auto;"> <!-- 左右中央に横線を配置 --> 
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
          <!--<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">-->
            <!--<circle cx="6" cy="6" r="3"></circle>-->
            <!--<circle cx="6" cy="18" r="3"></circle>-->
            <!--<path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>-->
            <i class="fa-solid fa-bowl-rice text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
          <!--</svg>-->
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">食事</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">昼食</p>
                <p class="text-gray-900 font-bold text-xl px-3">カレーライス</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">おやつ</p>
                <p class="text-gray-900 font-bold text-xl px-3">マンハッタン</p>
            </div>
            
          <!--<a class="mt-3 text-indigo-500 inline-flex items-center" _msthidden="1">-->
          <!--  <font _mstmutation="1" _msttexthash="130533" _msthidden="1" _msthash="745">Learn More</font>-->
          <!--  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">-->
          <!--    <path d="M5 12h14M12 5l7 7-7 7"></path>-->
          <!--  </svg>-->
          <!--</a>-->
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
          <!--<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">-->
            <!--<path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>-->
            <i class="fa-solid fa-toilet-paper text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
            <circle cx="12" cy="7" r="4"></circle>
          <!--</svg>-->
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="96746" _msthidden="1" _msthash="746">トイレ</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">尿</p>
                <p class="text-gray-900 font-bold text-xl px-3">あり</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">便</p>
                <p class="text-gray-900 font-bold text-xl px-3">あり</p>
            </div>
            <p class="text-gray-900 font-bold text-xl p-4">自分で便器に座ってトイレできました</p>
            
          <!--<a class="mt-3 text-indigo-500 inline-flex items-center" _msthidden="1">-->
          <!--  <font _mstmutation="1" _msttexthash="130533" _msthidden="1" _msthash="748">Learn More</font>-->
          <!--  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">-->
          <!--    <path d="M5 12h14M12 5l7 7-7 7"></path>-->
          <!--  </svg>-->
          <!--</a>-->
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-person-walking text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">トレーニング</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">コミュニケーション</p>
                <p class="text-gray-900 font-bold text-xl px-3">運動</p>
                <p class="text-gray-900 font-bold text-xl px-3">宿題</p>
                <p class="text-gray-900 font-bold text-xl px-3">その他</p>
                <p class="text-gray-900 font-bold text-xl px-3">SSTを行いました</p>
            </div>
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
        </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-broom text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">生活習慣</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">荷物整理</p>
                <p class="text-gray-900 font-bold text-xl px-3">掃除</p>
                <p class="text-gray-900 font-bold text-xl px-3">その他</p>
                <p class="text-gray-900 font-bold text-xl px-3">備考</p>
            </div>
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-brush text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">創作活動</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">図画工作</p>
                <p class="text-gray-900 font-bold text-xl px-3">料理</p>
                <p class="text-gray-900 font-bold text-xl px-3">その他</p>
            </div>
           
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-person text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">個人活動</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">課題</p>
                <p class="text-gray-900 font-bold text-xl px-3">余暇</p>
                <!--<p class="text-gray-900 font-bold text-xl px-3">その他</p>-->
            </div>
             <p class="text-gray-900 font-bold text-xl p-4">宿題・パズル・図鑑</p>
            
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-people-group text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">集団活動</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">レクリエーション</p>
                <p class="text-gray-900 font-bold text-xl px-3">地域交流</p>
                <!--<p class="text-gray-900 font-bold text-xl px-3">その他</p>-->
            </div>
             <p class="text-gray-900 font-bold text-xl p-4">ごっこ遊び・トランプ</p>
            
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
    </div>
  </div>
</section>
    
    
    
</x-app-layout>