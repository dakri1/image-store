<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Images</title>
    <link rel="stylesheet" href="{{ asset('form.css') }}">

</head>
<body>
<div class="upload-form">
    <h2>Загрузить изображение</h2>
    <form action="{{route("upload")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="images">Максимум 5 изображений</label><br>
            <input type="file" name="images[]" accept="image/*" multiple>
        </div>
        <button type="submit">Отправить</button>
    </form>
    @if($error)
        <p>{{$error}}</p>
    @endif
</div>
</body>
</html>
