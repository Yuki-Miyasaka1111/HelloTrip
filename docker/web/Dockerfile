# ベースイメージの指定
FROM nginx:stable-alpine
# 作成した設定ファイルをコンテナ内にコピー
COPY ./docker/web/default.conf /etc/nginx/conf.d/default.conf

# ユーザーとグループのIDを変更
RUN apk --no-cache add shadow && \
    usermod -u 1000 nginx && \
    groupmod -g 1000 nginx && \
    apk del shadow