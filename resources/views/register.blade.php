<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <form action="{{route('registered')}}" method="POST">
        @csrf
        @method('post')
        <input type="text" name="name" placeholder="Name">
        @error('name')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="referral_code" placeholder="Referral code">

        
        <input type="password" name="password">
        {{-- <input type="password" name="password_confirmation"> --}}

        <button type="submit">Submit</button>
    </form>
</body>
</html>