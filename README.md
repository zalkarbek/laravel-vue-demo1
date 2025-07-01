
# 🏠 House Listings API & Frontend (Laravel + Vue)

Тестовое задание PHP-разработчика. Реализация API и frontend-интерфейса поиска по базе данных домов.

---

## 📦 Стек технологий

- **Backend:** Laravel 12 (PHP 8.2)
- **Frontend:** Vue 3 + Vite + Inertia.js
- **UI:** Tailwind + shadcn/ui
- **База данных:** MySQL / PostgreSQL
- **Дополнительно:** CSV-загрузка, поиск с фильтрами, JSON API

---

## 🚀 Установка и запуск

1. **Клонируй репозиторий:**

```bash
git clone https://github.com/zalkarbek/laravel-vue-demo1.git
cd laravel-vue-demo1
```

2. **Установи зависимости PHP:**

```bash
composer install
```

3. **Установи зависимости JS:**

```bash
npm install
```

4. **Сконфигурируй `.env`:**

```bash
cp .env.example .env
php artisan key:generate
```

Укажи настройки БД в `.env`:

### 💾 Использование SQLite (альтернатива)

Если ты не хочешь настраивать полноценную базу данных, можно использовать SQLite:

1. Создай файл базы данных:

```bash
touch database/database.sqlite
```

2. В `.env` укажи следующие параметры:

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

3 **Выполни миграции и сидеры:**

```bash
php artisan migrate --seed
```

4 **Собери фронтенд в продакшен-бандл:**

```bash
npm run build
```

5 **Запусти сервер Laravel:**

```bash
php artisan serve
```

---

Теперь приложение доступно по адресу: [http://localhost:8000](http://localhost:8000)  
Фронтенд будет обслуживаться Laravel из собранных статики — запускать `npm run dev` не нужно.

---

## 🔍 Возможности

- Поиск домов по полям:
    - `name` (поиск по части названия)
    - `price` (в диапазоне)
    - `bedrooms`, `bathrooms`, `storeys`, `garages` (по точному совпадению)
- Все фильтры необязательны и могут комбинироваться
- Vue-интерфейс с формой поиска
- Динамическая таблица результатов
- Индикация загрузки и сообщение, если ничего не найдено
- Кнопка **сброса фильтров**

---

## 📂 Структура

- `app/Models/House.php` — модель
- `app/Http/Controllers/HouseController.php` — контроллер API
- `database/seeders/HouseSeeder.php` — загрузка из `storage/app/houses.csv`
- `resources/js/Pages/Houses.vue` — страница поиска (Vue)

---

## 📝 Комментарии

- Использован подход **API-first** — фронтенд полностью отделён от логики на бэкенде
- Использован `fetch()` для взаимодействия между Vue и Laravel API
- Все коммиты логически разделены (см. `.git`)

---

## 📎 CSV Структура

Пример строки в `houses.csv`:

```
Name,Price,Bedrooms,Bathrooms,Storeys,Garages
The Victoria,374662,4,2,2,2
```
