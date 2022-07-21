# 課題：書籍管理アプリ（PHPアプリ）
- 2022.7.19　検索画面に表示される属性を増やしたら検索が機能しなくなったので修正


  別テーブルに同名の属性があるとphpでsqlを使用するとき都合が悪いので属性名を変更（type.name→type_name, user.name→user_name）
- 2022.7.11 とりあえず機能部分が粗方できた


- 今後やること
  - ~~テキストエリアを広げる~~ ←7.11できた
  - ~~表示される属性を増やす~~ ←7.12できた
- やれたらいい
    - 無限に進むのをどうやって阻止するか

## 使い方
- ログイン（login.html / login.php）
  - localhost/login.htmlを開きuser_idとpasswordを入力してログインする
------------------
- 閲覧（select.php / ViewSelect_tpl.php）
  - 登録されている書籍情報を5件ずつ見ることができる
------------------
- 検索（search.php / ViewSearch_tpl.php）
  - 誰でも利用可能(権限1, 2)
  - 本のタイトルの一部やジャンルで検索をすることができる
  - 検索結果の書籍情報を5件ずつ見ることができる
  - タイトルの一部を入力せず検索をすると初めの画面に戻る（ViewSelect_tpl.php）
------------------
- 検索（add.php / ViewAdd_tpl.php）
  - 誰でも利用可能(権限1, 2)
  - 書籍情報を登録することができる
------------------
- 修正（ViewUpdate_Select.php / update.php / ViewUpdate_tpl.php）
  - **権限1のユーザーのみ利用可能**
  - 登録した書籍情報の修正と削除ができる
  - 閲覧・検索画面で修正したい書籍をラジオボタンで選択し、ボタンを押すと修正画面に移る（権限が無いとラジオボタンを選択できない）
  - 修正画面で修正か削除か選べる

## ユーザー情報(DB)
- ログイン時はuser_idとpasswordを使用する
- 検索機能・追加機能は誰でも利用可能、修正（＋削除）機能は権限1のユーザーのみ利用可能
------------------
|user_id|user_name|password|email|permission|
|:----|:----|:----|:----|:----|
|ringo|青森りんご|ringo1111|ringo@ib.yic.ac.jp|1|
|mikan|愛媛みかん|mikan2222|mikan@ib.yic.ac.jp|2|
|momo|長野もも|momo3333|momo@ib.yic.ac.jp|2|

## 参考サイト
Markdown表変換ツール：https://markdown-convert.com/ja/tool/table

テキストエリアのラベルの揃え方：https://rainbow-engine.com/jsp-text-right-align/

DBの属性変更：https://took.jp/post-781/

ボタンを横並びにする：https://teratail.com/questions/51456

ラジオボタンのお話： https://codeforfun.jp/reference-html-tag-input-type-radio/

一つのフォーム内にあるどのボタンが押されたかの判定：https://moewe-net.com/php/which-submit-button

inputタグのValue属性の初期値について：https://webukatu.com/wordpress/blog/39366/

かわいい見出し①：https://pa-tu.work/category/1?page=2

かわいい見出し②： https://www.webtan.cc/wp/htmlcssjquery-%E3%82%B3%E3%83%BC%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0/%E3%80%90css%E3%80%91%E7%B7%9A%E3%81%AB%E9%87%8D%E3%81%AA%E3%82%8B%E8%A6%8B%E5%87%BA%E3%81%97%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%BB%98%E3%81%8D%E3%81%AE%E6%9E%A0%E7%B7%9A%E3%81%A7%E5%9B%B2/