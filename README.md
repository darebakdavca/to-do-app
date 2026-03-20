# To-Do App (Laravel)

A collaborative to-do list web application built with Laravel. Users can create private and shared task lists, assign tasks, invite others, and manage their productivity together.

---

## Features

- **User Authentication**: Register, log in, and manage your account securely.
- **Task Lists**: Create, edit, and delete private or shared task lists.
- **Tasks**: Add, edit, assign, and complete tasks within lists.
- **Sharing**: Invite users to shared lists via email invitation links.
- **Task Assignment**: Assign tasks to one or more users.
- **Access Control**: Only authorized users can view or modify lists and tasks.
- **Responsive UI**: Clean, modern interface using Blade components and Tailwind CSS.
- **Notifications**: Toast messages for actions and errors.

---

## Local Development

1. Install dependencies:
   `brew install composer php@8.4`
2. Bootstrap the app:
   `cp .env.example .env`
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" composer install`
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" php artisan key:generate`
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" php artisan migrate`
   `npm install`
3. Start the app:
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" php artisan serve`
   `npm run dev`

This repo now assumes Postgres everywhere. For local development, point `.env` at Supabase or another Postgres instance before running migrations.

---

## Laravel Cloud Deployment

This application is intended to run on Laravel Cloud with Supabase Postgres.

Important deployment notes:

- Local, test, and production environments should all use Postgres.
- Runtime traffic should use the exact Supabase Supavisor transaction pooler connection string from the Supabase dashboard in `DATABASE_URL`.
- Do not use `db.<project-ref>.supabase.co:5432` for Laravel Cloud runtime traffic. The transaction pooler is the correct fit for application traffic.
- Supabase transaction mode does not support prepared statements, so this repo uses `DB_DISABLE_PREPARES=true` for the `pgsql` connection.
- `APP_KEY`, `APP_URL`, `DATABASE_URL`, and any real `MAIL_*` settings must be configured as Laravel Cloud environment variables.
- For migrations, `psql`, `pg_dump`, and other long-lived admin tasks, use Supabase's direct connection or session pooler when appropriate.
- This repo commits `public/build`, so Laravel Cloud can serve the production JS/CSS bundle even if no Node build runs during deploy.
- When frontend code changes, run `npm run build` locally and deploy the updated `public/build` files.

Testing note:

- `phpunit.xml` no longer forces SQLite. Tests now use whatever Postgres connection you provide in the environment.

Suggested Laravel Cloud commands:

Build Commands:
`composer install --no-dev --optimize-autoloader`

Deploy Command:
`php artisan migrate --force`

---

## License

[MIT](LICENSE)
