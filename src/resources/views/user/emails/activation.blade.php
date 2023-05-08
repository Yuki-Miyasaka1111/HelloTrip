<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メールアドレスを確認してください</title>
</head>
<body>
    <h1>メールアドレスを確認してください</h1>

    <p>こんにちは {{ $user->name }} さん、</p>

    <p>以下のリンクをクリックしてアカウントを有効化してください。</p>

    <a href="{{ url('/activate/' . $token) }}">アカウントを有効化する</a>

    <p>このメールにお心当たりがない場合、お手数ですが破棄していただければ幸いです。</p>

    <p>よろしくお願いいたします。</p>
</body>
</html>