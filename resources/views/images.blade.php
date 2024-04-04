<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Images Gallery</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
<h1>Хранилище Изображений</h1>
<p class="centered-link">
    <a href="{{ route("form") }}">Добавить</a>
</p>
<form action="{{route("searchByName")}}" method="get">
    <input type="text" name="name" placeholder="Название">
    <button type="submit">Поиск</button>
</form>
<p class="centered-link">
    <a href="{{route("sortByDate")}}">Отсортировать по времени</a>
</p>
<p class="centered-link">
    <a href="{{ route("sortByFileName") }}">Отсортировать по алфавиту</a>
</p>
@foreach($images as $image)
    <div>
        <p>Имя файла: {{ $image->fileName }}</p>
        <p>Загруженно: {{ $image->uploaded_at }}</p>
        <img src="{{ asset('uploads/'.$image->fileName) }}" alt="{{ $image->fileName }}" width="100">
        <a href="{{ asset('uploads/'.$image->fileName) }}" target="_blank">Посмотреть оригинал</a>
        <a href="{{ route("download", ['filename' => $image->fileName]) }}">Скаать</a>
        <hr>
    </div>
@endforeach
</body>
</html>
