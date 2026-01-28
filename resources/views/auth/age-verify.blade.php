<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>age verify</title>
    <style>
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif
    
    <form action="/auth/age/check" method="POST">
        @csrf
        <div>
            <label for="age">Nhập tuổi của bạn:</label>
            <input type="text" id="age" name="age" required>
        </div>
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>