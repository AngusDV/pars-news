<!DOCTYPE html>
<html>
<head>
    <title>مقاله جدید در وبسایت</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            direction: rtl;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>مقاله جدید اضافه شد!</h1>
    <p>سلام،</p>
    <p>مقاله جدیدی به وبسایت اضافه شده است.</p>
    <p><strong>عنوان:</strong> {{ $article->title }}</p>
    <p><strong>توضیحات:</strong> {{ $article->description }}</p>
    <p><strong>نویسنده:</strong> {{ $article->creator->name }}</p>
    <p>برای مشاهده مقاله به وبسایت مراجعه کنید.</p>
    <p>با تشکر،</p>
    <p>تیم Pars News</p>
</div>
</body>
</html>
