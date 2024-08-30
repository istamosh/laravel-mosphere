<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World!</h1>

    <!-- adding a form -->
    <form action="/" method="post">
        <!-- Cross Site Request Forgery (no CSRF will return error 419) -->
        @csrf
        <input type="text" name="username" id="">
        <button type="submit">Submit</button>
    </form>

    <!-- adding a put form -->
    <form action="/istamosh" method="post">
        @csrf
        <!-- <input type="hidden" name="_method" value="PUT"> -->
        @method('PUT')
        <input type="text" name="username" id="">
        <button type="submit">Submit Put</button>
    </form>

    <!-- adding a delete request form for articles route -->
    <form action="/articles" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Submit Delete</button>
    </form>
</body>
</html>