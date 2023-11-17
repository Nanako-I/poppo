<!-- resources/views/books.blade.php -->
<x-app-layout>

    <!--ヘッダー[START]-->
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
    <h2>{{$person->person_name}}さんの画面</h2>
    </form>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
        @if (count($errors) > 0)
            <!-- Form Error List -->
            <div class="flex justify-between p-4 items-center bg-red-500 text-white rounded-lg border-2 border-white">
                <div><strong>入力した文字を修正してください。</strong></div> 
                <div>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endif
    
    
        <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
                        
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center" _msthidden="5">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center" _msthidden="4">
                    <h1 class="title-font sm:text-4xl text-5xl mb-4 font-medium text-gray-900" _msttexthash="1004770" _msthidden="1" _msthash="63">{{$person->person_name}}
                    </h1>
                            <p class="mb-8 leading-relaxed" _msttexthash="26864591" _msthidden="1" _msthash="64">{{$person->date_of_birth}}生まれ</p>
                            <p class="mb-8 leading-relaxed" _msttexthash="26864591" _msthidden="1" _msthash="64">{{$person->gender}}</p>
                            <p class="mb-8 leading-relaxed" _msttexthash="26864591" _msthidden="1" _msthash="64">{{$person->disability_name}}</p>
                </div>      
    
            </div>          
                      
                        <!--<div class="flex flex-col px-2 py-2">-->
                           <!-- カラム１ -->
                            <!--<div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">-->
            
                       
        </form>
        </div>
    </div>
        <!--左エリア[END]--> 
         
         <form action="{{ url('temperature/'.$person->id.'/edit') }}" method="GET">
            @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
                体温をはかる
                </button>
        </form>       
                      
                                            
       <form action="{{ url('food/'.$person->id.'/edit') }}" method="GET">
            @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
                食事のきろく
                </button>
        </form>  
        
         <form action="{{ url('toilet/'.$person->id.'/edit') }}" method="GET">
            @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
                トイレのきろく
                </button>
        </form> 
        
         <form action="{{ url('speech/'.$person->id.'/edit') }}" method="GET">
            @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
                活動きろく
                </button>
        </form> 
        
        <form action="{{ url('record/'.$person->id.'/edit') }}" method="GET">
            @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
                ケースきろく
                </button>
        </form> 
        
        
    <!--右側エリア[START]-->
    <div class="flex-1 text-gray-700 text-left bg-blue-100 px-4 py-2 m-2">
         <!-- 現在の本 -->
        
    <!--右側エリア[[END]--> 
</div>
 <!--全エリア[END]-->
 
</x-app-layout>