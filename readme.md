# Sayit API


## List articles
URI: `/api/article`

#### Parameters

Key           | Description                  | Default   | Available
------------- | ---------------------------- | --------- | ---------------------------------
with          | add relational data          |           | user, channel
limit         | limit to number of results   | 100       | number between 1 and 1000
offset        | start results with an offset | 0         | number between 1 and 1000
search        | narrow down results          |           | @users, #tags, $channels, words

## Show article
URI: `/api/article/{article}` where {article} can be the article ID or the slug.

#### Parameters

Key           | Description                  | Default   | Available
------------- | ---------------------------- | --------- | ---------------------------------
with          | add relational data          |           | user, channel
limit         | limit to number of results   | 100       | number between 1 and 1000
offset        | start results with an offset | 0         | number between 1 and 1000
