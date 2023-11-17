<x-app-layout>

    <!--ヘッダー[START]-->
    
  <div class="flex items-center justify-center">
   <div class="flex flex-col items-center">
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
                        
        <style>
        h2 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          font-weight: bold;
          text-decoration: underline;
        }
      </style>
    <h2>{{$person->person_name}}さんのトイレ記録</h2>
    </form>
   </div>
  </div>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ url('toilet/'.$person->id.'/edit') }}" method="POST">
         
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
                        @csrf
                        
                    
<body>                    
<div style="display: flex; flex-direction: column;">
     <style>
     body {
          font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
          background: linear-gradient(135deg, rgb(253, 219, 146,0), rgb(209, 253, 255,1));
          }
     h3 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          /*font-weight: bold;*/
          text-decoration: underline;
        }
        </style>
 <div style="display: flex; flex-direction: column; align-items: center;">
  <h3>尿</h3>
 </div>
  <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'urine_one')">
      <i class="material-icons md-48" id="urine_one">check_box</i>
    </span>
    <input name="urine_one" type="text" id="urine_one_input" class="w-300 h-10px flex-shrink-0 break-words" placeholder="トイレ">
  </div>
  <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'urine_two')">
      <i class="material-icons md-48" id="urine_two">check_box</i>
    </span>
    <input name="urine_two" type="text" id="urine_two_input" class="w-300 h-10px flex-shrink-0 break-words" placeholder="おむつ">
  </div>
  <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'urine_three')">
      <i class="material-icons md-48" id="urine_three">check_box</i>
    </span>
    <input name="urine_three" type="text" id="urine_three_input" class="w-300 h-10px flex-shrink-0 break-words" placeholder="尿漏れ">
  </div>
  
  <div style="display: flex; flex-direction: column; align-items: center;">
        <h3>尿の色</h3>
        <div style="display: flex; justify-content: center; align-items: center;">
            <!--<p class ="text-2.5xl">うすい</p>-->
            <!--<p class ="text-2.5xl">⇔</p>-->
            <!--<p class ="text-2.5xl">濃い</p>-->
            
        </div>
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
        <i class="fa-solid fa-droplet text-yellow-200" id="urine_color_1" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
        <i class="fa-solid fa-droplet text-yellow-300"  id="urine_color_2" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
        <i class="fa-solid fa-droplet text-yellow-500"  id="urine_color_3" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
    </div>
    <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'urine_three')">
      <i class="material-icons md-48 hidden" id="urine_three">check_box</i>
    </span>
    <input name="urine_color" type="text" id="urine_color_input" class="w-300 h-8px flex-shrink-0 break-words mt-px mb-1.5">
  </div>
</div>



<div style="display: flex; flex-direction: column;">
 
 
 <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px; my-2;">
  <h3 class="my-2;">便</h3>
 </div>
  <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'ben_one')">
      <i class="material-icons md-48" id="ben_one">check_box</i>
    </span>
    <input name="ben_one" type="text" id="ben_one_input" class="w-300 h-10px flex-shrink-0 break-words" placeholder="トイレ">
  </div>
  <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'ben_two')">
      <i class="material-icons md-48" id="ben_two">check_box</i>
    </span>
    <input name="ben_two" type="text" id="ben_two_input" class="w-300 h-10px flex-shrink-0 break-words" placeholder="おむつ">
  </div>
  <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
    <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'ben_three')">
      <i class="material-icons md-48" id="ben_three">check_box</i>
    </span>
    <input name="ben_three" type="text" id="ben_three_input" class="w-300 h-10px flex-shrink-0 break-words" placeholder="付着あり">
  </div>
    

  </div>
  　<div style="display: flex; flex-direction: column; align-items: center; my-2;">
        <h3>便の色</h3>
        <div style="display: flex; justify-content: center; align-items: center;">
            <!--<p class ="text-2.5xl">白</p>-->
            <!--<p class ="text-2.5xl">茶</p>-->
            <!--<p class ="text-2.5xl">黒</p>-->
        </div>
        <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
           <i class="fa-solid fa-circle text-gray-300" id="ben_color_1" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
            <i class="fa-solid fa-circle text-amber-800" id="ben_color_2" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
    
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
            <i class="fa-solid fa-circle text-black" id="ben_color_3" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
        </div>
        <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
        <span class="text-gray-400 text-6xl" onclick="changeColor(this, 'urine_three')">
          <i class="material-icons md-48 hidden" id="urine_three">check_box</i>
        </span>
        <input name="ben_color" type="text" id="ben_color_input" class="w-300 h-8px flex-shrink-0 break-words mt-px mb-1.5">
        </div>
    </div>

　　<div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
     <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
       送信
     </button>
    </div>
  
  
        </form>
    <!--右側エリア[START]-->
            <!--<div class="flex-1 text-gray-700 text-left bg-blue-100 px-4 py-2 m-2">-->
         <!-- 現在の本 -->
         
    <!--右側エリア[[END]--> 
</div>
 <!--全エリア[END]-->
 <script>
 
 const urineOneIcon = document.querySelector('#urine_one');

// add a click event listener to the icon
urineOneIcon.addEventListener('click', () => {
  // update the input value
  const urineOneInput = document.querySelector('#urine_one_input');
  urineOneInput.value = 'トイレ';

  // change the icon color
  //urineOneIcon.classList.replace('text-gray-400', 'text-yellow-400');
  urineOneIcon.classList.remove('text-gray-400');
  urineOneIcon.classList.add('text-yellow-400');
});

 const urineTwoIcon = document.querySelector('#urine_two');

// add a click event listener to the icon
urineTwoIcon.addEventListener('click', () => {
  // update the input value
  const urineTwoInput = document.querySelector('#urine_two_input');
  urineTwoInput.value = 'おむつ';

  // change the icon color
  //urineOneIcon.classList.replace('text-gray-400', 'text-yellow-400');
  urineTwoIcon.classList.remove('text-gray-400');
  urineTwoIcon.classList.add('text-yellow-400');
});

const urineThreeIcon = document.querySelector('#urine_three');

// add a click event listener to the icon
urineThreeIcon.addEventListener('click', () => {
  // update the input value
  const urineThreeInput = document.querySelector('#urine_three_input');
  urineThreeInput.value = '尿漏れ';

  // change the icon color
  //urineOneIcon.classList.replace('text-gray-400', 'text-yellow-400');
  urineThreeIcon.classList.remove('text-gray-400');
  urineThreeIcon.classList.add('text-yellow-400');
});

const benOneIcon = document.querySelector('#ben_one');

// add a click event listener to the icon
benOneIcon.addEventListener('click', () => {
  // update the input value
  const benOneInput = document.querySelector('#ben_one_input');
  benOneInput.value = 'トイレ';

  // change the icon color
  //benTwoIcon.classList.replace('text-gray-400', 'text-yellow-400');
  benOneIcon.classList.remove('text-gray-400');
  benOneIcon.classList.add('text-yellow-400');
});

 const benTwoIcon = document.querySelector('#ben_two');

// add a click event listener to the icon
benTwoIcon.addEventListener('click', () => {
  // update the input value
  const benTwoInput = document.querySelector('#ben_two_input');
  benTwoInput.value = 'おむつ';

  // change the icon color
  //benTwoIcon.classList.replace('text-gray-400', 'text-yellow-400');
  benTwoIcon.classList.remove('text-gray-400');
  benTwoIcon.classList.add('text-yellow-400');
});

 const benThreeIcon = document.querySelector('#ben_three');

// add a click event listener to the icon
benThreeIcon.addEventListener('click', () => {
  // update the input value
  const benThreeInput = document.querySelector('#ben_three_input');
  benThreeInput.value = '付着あり';

  // change the icon color
  //benTwoIcon.classList.replace('text-gray-400', 'text-yellow-400');
  benThreeIcon.classList.remove('text-gray-400');
  benThreeIcon.classList.add('text-yellow-400');
});

// 尿の色↓
const urine_color_1 = document.getElementById("urine_color_1");
urine_color_1.addEventListener("click", () => {
const UrinColorInput = document.querySelector('#urine_color_input');
UrinColorInput.value = 'うすい';
});

const urine_color_2 = document.getElementById("urine_color_2");
urine_color_2.addEventListener("click", () => {
const UrinColorInput = document.querySelector('#urine_color_input');
UrinColorInput.value = '普通';
});

const urine_color_3 = document.getElementById("urine_color_3");
urine_color_3.addEventListener("click", () => {
const UrinColorInput = document.querySelector('#urine_color_input');
UrinColorInput.value = '濃い';
});

// 便の色↓
const ben_color_1 = document.getElementById("ben_color_1");
ben_color_1.addEventListener("click", () => {
const BenColorInput = document.querySelector('#ben_color_input');
BenColorInput.value = '白';
});

const ben_color_2 = document.getElementById("ben_color_2");
ben_color_2.addEventListener("click", () => {
const BenColorInput = document.querySelector('#ben_color_input');
BenColorInput.value = '茶色';
});

const ben_color_3 = document.getElementById("ben_color_3");
ben_color_3.addEventListener("click", () => {
const BenColorInput = document.querySelector('#ben_color_input');
BenColorInput.value = '黒';
});


</script>
</body> 
</x-app-layout>