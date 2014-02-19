# Sayit API


## List articles

Show a list of articles

GET `/api/article`

#### Parameters

Key           | Description                  | Default   | Available
------------- | ---------------------------- | --------- | ---------------------------------
with          | add relational data          |           | user, channel
limit         | limit to number of results   | 100       | number between 1 and 1000
offset        | start results with an offset | 0         | number between 1 and 1000
search        | narrow down results          |           | @users, #tags, $channels, words

## Show article

Display one article

GET `/api/article/{article}`

> {article} can be the article ID or the slug.

#### Parameters

Key           | Description                  | Default   | Available
------------- | ---------------------------- | --------- | ---------------------------------
with          | add relational data          |           | user, channel
limit         | limit to number of results   | 100       | number between 1 and 1000
offset        | start results with an offset | 0         | number between 1 and 1000

## Store article
Create a new article.
If a key is provided, then an article with the same key will be updated.

POST `/api/article/{article}` 

> {article} can be the article ID or the slug.

#### Parameters

Key           | Description                               | Default   | Format
------------- | ----------------------------------------- | --------- | ---------------------------------
title         | article title                             |           | string     
key           | unique key to overwrite existing article  |           | string
markdown      | article body as with markdown format      |           | text
user          | email address of the writer               |           | string
channel       | channel slug                              |           | string


## Update article
Update an existing article with new data.

PUT `/api/article/{article}` 

> {article} can be the article ID or the slug.

#### Parameters

Key           | Description                               | Default   | Format
------------- | ----------------------------------------- | --------- | ---------------------------------
title         | article title                             |           | string     
key           | unique key to overwrite existing article  |           | string
markdown      | article body as with markdown format      |           | text
user          | email address of the writer               |           | string
channel       | channel slug                              |           | string


## Delete article
Delete an existing article.

DELETE `/api/article/{article}` 

> {article} can be the article ID or the slug.

# TODO

- [ ] tags
- [ ] [text analysis] (https://github.com/yooper/php-text-analysis) for autogenerating tags
- [ ] user system
- [ ] public/private articles
- [ ] oAuth2 for API
- [ ] user can follow user, channel or tags
- [ ] notifications
