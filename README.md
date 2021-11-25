# データベース名

twitter

## テーブル情報

# ユーザ情報
table : user
mail, user_id, name, password

## リファレンス情報
table : reference
reference_id, user_id, word, definition, image

## 返信情報
table : reply
reference_id, user_id, comment

## ブックマーク情報
table : bookmark
user_id, reference_id