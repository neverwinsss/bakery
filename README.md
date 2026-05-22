# Пекарня у дома

Laravel 10 сайт пекарни: каталог, корзина, оформление заказов, отзывы, статьи, контакты, личный кабинет и админ-панель.

## Запуск

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Альтернатива для MySQL: импортируйте `database/bakery.sql`.

## Доступ администратора

- Email: `admin@bakery.ru`
- Пароль: `admin123`

## Что реализовано по ТЗ

- главная, о нас, каталог, заказ, контакты, статьи, отзывы;
- регистрация, вход, выход;
- корзина и checkout;
- личный кабинет с историей и повтором заказа;
- подписка на новости;
- админ-панель: товары, категории, заказы, статьи, отзывы, контакты, пользователи, статистика;
- базовые SEO meta, человекочитаемые URL, адаптивный Tailwind UI;
- CSRF, validation, auth/admin middleware.
