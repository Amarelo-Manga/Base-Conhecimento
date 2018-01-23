###  Força a utilizar Cache-Control e Expires header
```
<IfModule mod_headers.c>
Cabeçalho ETag unset
</ IfModule>
FileETag Nenhum
<IfModule mod_expires.c>
ExpiresActive em
ExpiresDefault "acesso mais 1 month"
texto ExpiresByType / cache-manifest "acesso acrescido 0 segundos"
# Html
texto ExpiresByType / html "acesso mais 0 segundos"
# dados
texto ExpiresByType / xml "acesso acrescido 0 segundos"
aplicação ExpiresByType / xml "acesso acrescido 0 segundos"
aplicação ExpiresByType / json "acesso acrescido 0 segundos"
# Alimentação
aplicação ExpiresByType / rss + xml "acesso mais 1 hora"
ExpiresByType aplicação / átomo + xml "acesso mais 1 hora"
# Favicon
imagem ExpiresByType / x-icon "acesso mais 1 semana"
# Suporte: imagens, vídeo, áudio
imagem ExpiresByType / gif "acesso mais 1 month"
imagem ExpiresByType / png "acesso mais 1 month"
imagem ExpiresByType / jpg "acesso mais 1 month"
imagem ExpiresByType / jpeg "acesso mais 1 month"
ExpiresByType video / ogg "acesso mais 1 month"
ExpiresByType "acesso mais 1 month" áudio / ogg
vídeo ExpiresByType / mp4 "acesso mais 1 month"
ExpiresByType vídeo / WebM "acesso mais 1 month"
# arquivos HTC
ExpiresByType text / x-componente "acesso mais 1 month"
# Webfonts
aplicação ExpiresByType / x-font-ttf "acesso mais 1 month"
fonte ExpiresByType / OpenType "acesso mais 1 month"
aplicação ExpiresByType / x-fonte woff "acesso mais 1 month"
ExpiresByType image / svg + xml "acesso mais 1 month"
ExpiresByType application / vnd.ms-fontobject "acesso mais 1 month"
# CSS / JS
texto ExpiresByType / css "acesso mais um ano"
aplicação ExpiresByType / "acesso mais um ano" javascript
ExpiresByType application / x-javascript "acesso mais um ano"
</ IfModule>
#Força o IE a sempre carregar utilizando a última versão disponível
<IfModule mod_headers.c>
conjunto de cabeçalho X-UA-Compatible "IE = Edge, chrome = 1"
<FilesMatch "\ (js |. Css | gif | png | jpeg | pdf | xml | oga | ogg | m4a | ogv | mp4 | m4v | webm | svg | SVGZ | EOT | ttf | OTF | woff | ico | webp | AppCache | manifesto | HTC | crx | oex | xpi | safariextz | vcf) $">
Cabeçalho unset X-UA-Compatible
</ FilesMatch>
</ IfModule>
```	