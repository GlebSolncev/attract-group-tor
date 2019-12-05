<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Laravel 6

Выполнение Технического задания. Задачи

- Зарегестрироваться (имейл сразу подтвержден)
- Авторизоваться(получить токены, если oauth)
- Может получить список других юзеров сключая себя.
- Может написать сообщение другому юзеру.
- Может посмотреть сообщения, полученые от конкретного юзера.

## Инструкция

- [x] **Зарегестрироваться**: [POST] /api/register , параметры: password, email, name;
- [x] **Авторизоваться**: [POST] /api/login , параметры: email, password
- [x] **Список пользователей**:  [POST] /api/users/list , параметры: (HEADERS) Authorization(Bearer <TOKEN_FROM_LOGIN>)
- [x] **Написать сообщение другому юзеру**: [POST] /api/chat/<ID_USER>/write , параметры: message, +Authorization
- [x] **Посмотреть сообщения полученные от конкретного юзера**: [POST] /api/chat/<ID_USER>>/show параметры: Authorization




 