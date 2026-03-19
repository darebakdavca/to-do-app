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
   `touch database/database.sqlite`
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" composer install`
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" php artisan key:generate`
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" php artisan migrate`
   `npm install`
3. Start the app:
   `PATH="/opt/homebrew/opt/php@8.4/bin:$PATH" php artisan serve`
   `npm run dev`

The tracked local example uses SQLite and `MAIL_MAILER=log`, so the app runs without MySQL or Mailpit.

---

## License

[MIT](LICENSE)
