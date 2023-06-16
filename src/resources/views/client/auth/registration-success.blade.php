<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
    <!-- ここにCSSやBootstrapのリンクを追加することができます -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>登録完了</h3>
                    </div>
                    <div class="card-body">
                        <p>ご登録ありがとうございます。アカウントの有効化メールが送信されました。メール内のリンクをクリックしてアカウントを有効化してください。</p>
                        <a href="{{ route('client.home.index') }}" class="btn btn-primary">ホームページに戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>