<x-app-layout>

    <!--ヘッダー[START]-->
        <head>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
          <style>
            h2 {
              font-family: Arial, sans-serif; /* フォントをArialに設定 */
              font-size: 20px; /* フォントサイズを20ピクセルに設定 */
            }
              .other::before {
                content: "";
                position: absolute;
                top: 90%;
                left: -15px;
                margin-top: -30px;
                border: 5px solid transparent;
                border-right: 15px solid #c7deff;
                max-width: 72rem;
                overflow-wrap: break-word;
                display: inline-block;     /* 横幅を自動で変更 */
            }

            .self::after {
                content: "";
                position: absolute;
                top: 50%;
                left: 100%;
                margin-top: -15px;
                border: 3px solid transparent;
                border-left: 9px solid #c7deff;
                max-width: 72rem;
                overflow-wrap: break-word;
                display: inline-block;     /* 横幅を自動で変更 */
            }
            
          </style>
          </head>
        <div class="flex items-center justify-center">
  <!--<div style="display: flex; flex-direction: column;">-->
     <div class="flex flex-col items-center">
         <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                            @method('PATCH')
                            @csrf  
        <div class ="flex items-center justify-center">
        <h2>{{$person->person_name}}さんの連絡</h2>
        </div>
        </form>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
    
    
        <body class="w-4/5 md:w-3/5 lg:w-2/5 m-auto">
        
        <div class="my-4 p-4 rounded-lg w-11/12">
            <ul>
              @foreach ($chats as $chat)
                <p class="text-base font-bold @if($chat->user_identifier == session('user_identifier')) text-right @endif">
                    {{ $chat->created_at }} ＠{{ $chat->user_name }}
                </p>
                <li style="overflow-wrap: break-word;" class="w-max mb-3 p-2 text-lg font-bold rounded-lg bg-blue-200 text-gray-950 relative @if($chat->user_identifier == session('user_identifier')) self ml-auto @else other @endif">
                    <div style="overflow-wrap: break-word;">
                    <p style="overflow-wrap: break-word;">{{ $chat->message }}</p>
                    </div>
                </li>
            @endforeach


            </ul>
        </div>
        <!--<form class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow" action="/chat" method="POST">-->
        
        <div class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow">
        <!--<div class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow flex items-center justify-center">-->
            <form action="{{ url('chat/'.$person->id) }}" method="POST">
            @csrf
           
            <input type="hidden" name="user_identifier" value={{session('user_identifier')}}>
            
            <!--<div class="flex items-center justify-center">-->
               
                <input class="py-1 px-2 rounded text-center mb-2 md:mb-0 md:mr-2 md:ml-0 md:flex-initial" type="text" name="user_name" placeholder="UserName" maxlength="20" value="{{ session('user_name') }}" required>
               
                    <!--<input class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded flex-auto" type="text" name="message" placeholder="Input message." maxlength="200">-->
                <textarea class="w-full h-20 mt-2 ml-2 py-1 px-2 rounded flex-auto" type="text" name="message" placeholder="メッセージを入力" autofocus required></textarea>
            
                <button type="submit" class="my-2 inline-flex items-center px-5 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    送信
                </button>
                <!--<button class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded text-center bg-gray-500 text-white" type="submit">送信</button>-->
            <!--</div>-->
        </div>    
        </form>
        </body>
    </div>
    </div>
    
</x-app-layout>