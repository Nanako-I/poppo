<x-app-layout>

    <!--ヘッダー[START]-->
        <head>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
          <style>
          
          * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
            }
            
            css{
               touch-action: none;
            }
            body { 
                box-sizing: border-box;
                background: #FFF;
                font-family: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, "Helvetica Neue", YuGothic, "ヒラギノ角ゴ ProN W3", Hiragino Kaku Gothic ProN, Arial, "メイリオ", Meiryo, sans-serif;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                tap-highlight-color: rgba(0, 0, 0, 0);
                overflow-x: hidden;
            /*    overflow-y: scroll;*/
                -webkit-overflow-scrolling: touch;
            }
            a {
              color: #2196F3;
              text-decoration: none;
            }
    
            h2 {
              font-family: Arial, sans-serif; /* フォントをArialに設定 */
              font-size: 20px; /* フォントサイズを20ピクセルに設定 */
            }
            
            /*チャットボット本体*/
            #chatbot { 
                position: fixed;
                overflow: hidden;
                opacity: 1;
                transition: .4s;
                background: #FFF;
                -webkit-font-smoothing: none;
                -webkit-font-smoothing: antialiased;
                -webkit-font-smoothing: subpixel-antialiased; /* Safari での Default値 */
            }
            
            @media screen and (min-width: 700px) { /*PC*/
            #chatbot {
                height: 80vh;
                width: 100%;
                bottom: 0;
                right: 0;
                margin: 0;
                box-shadow: 0px 0 25px -5px #888;
                border-radius: 10px;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                -webkit-transform: translate(-50%, -50%);
                -moz-transform: translate(-50%, -50%);
            }
        }
        @media screen and (max-width: 700px) { /*スマホ*/
            #chatbot {
                height: 100vh;
                width: 100vw;
            }
        }
            /*チャットのフィールド*/
            #chatbot-body {
                width: 100%;
                height: calc(80vh - 110px);
                padding-top: 10px;
                background: #FFF;
                box-sizing: border-box;
                /*横向きのスクロール禁止*/
                overflow-x: hidden;
                /*縦向きのスクロール許可*/
                overflow-y: scroll;
                -webkit-overflow-scrolling: touch;
                /*IE、Edgeでスクロールバーを非表示にする*/
                -ms-overflow-style: none;
            }
            @media screen and (max-width: 700px) { /*スマホ*/
              #chatbot-body {
                height: calc(100vh - 170px);
              }
            }
            
            #chatbot-body.chatbot-body-zoom {
                width: 100%;
            }
            #chatbot-body.chatbot-body-zoom {
                height: calc(100vh - 170px);
            }
            /*Chrome、Safariでスクロールバーを非表示にする*/
            #chatbot-body::-webkit-scrollbar {
                display:none;
            }
            
            #chatbot-footer {
            width: 100%;
            height: 50px;
            display: flex;
            box-sizing: border-box;
            background: #FFF;
            border-top: 1.5px solid #EEE;
        }
        
        @media screen and (min-width: 700px) { /*PC*/
            #chatbot-footer {
                width: 80%;
                margin: 0 auto;
            }
        }
        @media screen and (min-width: 700px) { /*PC*/
            #chatbot-footer.chatbot-footer-zoom {
                margin-bottom: 0;
            }
        }
        @media screen and (max-width: 700px) { /*スマホ*/
            #chatbot-footer.chatbot-footer-zoom {
                position: fixed;
                margin-bottom: 60px;
            }
        }
        
        /*入力する場所*/
                #chatbot-text {
                    height: 40px;
                    width: 72%;
                    display: block;
                    font-size: 16px;
                    box-sizing: border-box;
                    padding-left: 10px;
                    margin: auto 10px auto 15px;
                    color: #777;
                    border: 0;
                    outline: 0;
                }
                #chatbot-text:focus{
                    border: none;
                    outline: none;
                }
                /*送信ボタン*/
                #chatbot-submit{
                    cursor: pointer;
                    height: 35px;
                    padding: 0 30px;
                    margin: auto;
                    margin-right: 15px; 
                    font-size: 16px;
                    background: #335C80;
                    color: white;
                    display: block;
                    /*デフォルトのボーダーを消す*/
                    border: none;
                    box-sizing: border-box;
                    border-radius: 7px;
                }
                #chatbot-submit:active{
                    outline: 0;
                    background: #86ABBF;
                }
                
                #chatbot-ul{
                    /*ulのデフォルの隙間を消す*/
                    padding: 0;
                    list-style: none;
                }
                
                @media screen and (min-width: 700px) { /*PC*/
              #chatbot-ul {
                max-width: 80%;
                margin: 15%;
              }
            }
            
           
                #chatbot-ul > li{
                    position: relative;
                    /* display: block; */
                    width: 100%;
                    padding-bottom: 10px;
                    word-wrap: break-word;
                }
                #chatbot-ul > li > div {
                    display: inline-block;
                    box-sizing: border-box;
                    min-height: 23px;
                    max-width: 70%;
                    padding: 7px 13px;
                    font-size: 16px;
                    line-height: 1.3em;
                    position: relative;
                }
                
                #chatbot-ul > li > div.chatbot-short {
                    width: 53%;
                }
                /*相手の吹き出しのデザイン*/
                .chatbot-left{
                    margin-left: 20px;
                    background: #E6F0F7;
                    border-radius: 0 9px 9px 9px;
                    color: #1A5F80;
                }
                .chatbot-left-rounded {
                    margin-left: 20px;
                    background: #E6F0F7;
                    border-radius: 9px;
                    color: #1A5F80;
                }
                /*自分の吹き出し*/
                .chatbot-right{
                margin-right: 20px;
                background: #456F99;
                text-align: left;
                border-radius: 9px 0 9px 9px;
                color: #FFF;
                }
                .left{
                text-align: left;
                }
                .right{
                text-align: right;
                }
                .choice-title {
                position: absolute;
                width: 100%;
                height: 25px;
                line-height: 25px;
                border-radius: 9px 9px 0 0;
                text-align: center;
                font-size: 15px;
                top: 0;
                left: 0;
                background: #456F99;
                color: #FFF;
                letter-spacing: .05em;
                }
                .choice-q {
                /*     width: 180px; */
                margin: 25px 0 .7rem;
                font-size: 15px;
                line-height: 1.3em;
                letter-spacing: .05em;
                }
                .choice-button {
                cursor: pointer;
                user-select: none;
                background: #456F99;
                color: #FFF;
                border-radius: 3px;
                /* margin-top: 8px; */
                margin-bottom: 8px;
                text-align: left;
                padding: 7px 13px;
                font-size: 16px;
                line-height: 1.3em;
                letter-spacing: .05em;
                border: none;
                display: block;
                width: 100%;
                }
                .choice-button:active {
                background: #B8D1E6;
                }
                .choice-button-disabled {
                background: #B8D1E6;
                }
                
                @media screen and (max-width: 700px) { /*スマホ*/
                #chatbot-start-button {
                    margin: 30px 40px;
                }
                #chatbot-logo {
                    font-size: 17px;
                }
                /*入力する場所*/
                #chatbot-text {
                    height: 45px;
                    font-size: 17px;
                }
                /*送信ボタン*/
                #chatbot-submit {
                    height: 40px;
                    font-size: 16px;
                }
                #chatbot-ul > li > div {
                    min-height: 30px;
                    padding: 10px 16px;
                    font-size: 17px;
                }
                .choice-title {
                    height: 30px;
                    line-height: 30px;
                    font-size: 17px;
                }
                .choice-q {
                    margin: 30px 0 1rem;
                    font-size: 17px;
                }
                .choice-button {
                    margin-bottom: 10px;
                    padding: 10px 16px;
                    font-size: 16.5px;
                }
            }


            /*  .other::before {*/
            /*    content: "";*/
            /*    position: absolute;*/
            /*    top: 90%;*/
            /*    left: -15px;*/
            /*    margin-top: -30px;*/
            /*    border: 5px solid transparent;*/
            /*    border-right: 15px solid #c7deff;*/
            /*    max-width: 72rem;*/
            /*    overflow-wrap: break-word;*/
            /*    display: inline-block;     /* 横幅を自動で変更 */
            /*}*/

            /*.self::after {*/
            /*    content: "";*/
            /*    position: absolute;*/
            /*    top: 50%;*/
            /*    left: 100%;*/
            /*    margin-top: -15px;*/
            /*    border: 3px solid transparent;*/
            /*    border-left: 9px solid #c7deff;*/
            /*    max-width: 72rem;*/
            /*    overflow-wrap: break-word;*/
            /*    display: inline-block;     /* 横幅を自動で変更 */
            /*}*/
            
          </style>
          </head>
    <div id= "chatbot">
        <div class="flex flex-col items-center">
            <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                @method('PATCH')
                @csrf  
                <div class ="flex items-center justify-center text-center">
                    <h2 class="text-center">{{$person->person_name}}さんの連絡</h2>
                </div>
            </form>
        </div>
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
    
        <div id= "chatbot-body">
            <ul id= "chatbot-ul">
                <ul>
                    @foreach ($chats as $chat)
                    <p class="text-base font-bold @if($chat->user_identifier == session('user_identifier')) text-right @endif">
                        {{ $chat->created_at }} ＠{{ $chat->user_name }}
                    </p>
                    <!-- ユーザーのメッセージ -->
                    <li class="@if($chat->user_identifier == session('user_identifier')) self ml-auto @else other @endif">
                        <li style="overflow-wrap: break-word; max-width: 70%;" class="w-max mx-3 mb-3 p-2 text-lg font-bold rounded-lg
                            @if($chat->user_identifier == session('user_identifier')) bg-blue-200 text-gray-900 border-blue-500 @else bg-teal-100 text-gray-950 border-black @endif
                            relative @if($chat->user_identifier == session('user_identifier')) self ml-auto @else other @endif">
                            <div style="overflow-wrap: break-word;">
                                <p style="overflow-wrap: break-word;" class="text-gray-900">{{ $chat->message }}</p>
                                @if($chat->filename && $chat->path)
                                <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/chat_photo/' . $chat->filename) }}">
                                    <!--<img src="{{ asset($chat->path) }}" alt="Chat Image">-->
                                @endif
                            </div>
                        </li>
                    </li>
                    @endforeach
                </ul>
            </ul>
        </div>
        
        <form action="{{ url('chat/'.$person->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <form onsubmit= "return false">
                <div id= "chatbot-footer">
                    <input type="hidden" name="user_identifier" value={{session('user_identifier')}}>
                    <input class="hidden py-1 px-2 rounded text-center mb-2 md:mb-0 md:mr-2 md:ml-0 md:flex-initial" type="text" name="user_name" placeholder="UserName" maxlength="20" value="{{$user_name}}" required>
                    <!--画像保存↓-->
                    <label for="filename"  style="cursor: pointer;">
                        <i class="fa-regular fa-image mt-2" style="font-size: 2em;"></i> <!-- FontAwesomeのアイコンを追加 -->
                        <input name="filename" id="filename" type="file" style="display: none;" onChange="uploadFile1()">
                    </label>
                    <input type= "text" id= "chatbot-text" class= "browser-default" name="message" placeholder= "テキストを入力" required style="word-wrap: break-word;">
                    <input type= "submit" value= "送信" id= "chatbot-submit">
                </div>
            </form>
         </form>  
    </div>
    <script>
    function uploadFile1() {
            var filename = document.getElementById('filename').value;
            if (filename.trim() !== '') {
                document.getElementById('chatbot-text').value = '写真が送信されました';
            }
        }
      
        function chatToBottom() {
        const chatField = document.getElementById('chatbot-body');
        chatField.scroll(0, chatField.scrollHeight - chatField.clientHeight);
    }
    
    const userText = document.getElementById('chatbot-text');
    const chatSubmitBtn = document.getElementById('chatbot-submit');
    </script>
</x-app-layout>