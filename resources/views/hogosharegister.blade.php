<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録画面</title>
</head>
@if (isset($error))
    <div style="color: red;">
        {!! $error !!}
    </div>
@endif

<body>
    <h1>登録画面</h1>
    <!--<form action="" method="post">-->
    <form action="{{ url('/hogosharegister') }}" method="post">
        @csrf
        <label for="name">名前</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        @error('password_confirmation')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="submit">送信</button>
    </form>
</body>
</html>
