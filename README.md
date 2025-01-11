# Welcome to SpeakSmarter

SpeakSmarter is a cutting-edge online course platform designed to enhance your learning experience through engaging and structured educational content. Built using Laravel and Vue.js, this project serves as a personal endeavor to deepen technical expertise in these powerful frameworks.

## Key Features

- **User Registration and Authentication**: Secure and user-friendly sign-up and login functionalities.
- **Course Management**: Explore, enroll in, and complete a variety of online courses.
- **Interactive User Interface**: Seamlessly navigate through an intuitive interface powered by Vue.js.
- **Backend API**: A robust Laravel-based API ensures smooth platform operations.
- **Responsive Design**: Fully optimized for all devices, delivering a consistent user experience.

## Technologies Used

- **Frontend**: Vue.js
- **Backend**: Laravel
- **Database**: PostgreSQL
- **Styling**: Vuetify
- **Version Control**: Git

## Getting Started

Follow these steps to set up the project locally and start exploring:

### Clone the Repository

```bash
git clone https://github.com/Adriel-1994/speaksmarter.git
cd speaksmarter
```

### Install Dependencies

- **Backend (Laravel):**
  ```bash
  composer install
  ```

- **Frontend (Vue.js):**
  ```bash
  npm install
  ```

### Configure Environment Variables

Create a `.env` file in the root directory and configure the required variables. Example:

```
APP_NAME=SpeakSmarter
APP_ENV=local
APP_KEY=base64:yourkeyhere
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=speaksmarter
DB_USERNAME=yourusername
DB_PASSWORD=yourpassword
```

### Run Database Migrations

```bash
php artisan migrate
```

### Serve the Application

- **Backend (Laravel):**
  ```bash
  php artisan serve
  ```

- **Frontend (Vue.js):**
  ```bash
  npm run dev
  ```

### Access the Application

Open your browser and navigate to `http://localhost` to explore the platform.

## Contributing to SpeakSmarter

Contributions are welcome and appreciated! Here are the steps to contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit your changes with clear and concise descriptions.
4. Push your branch and submit a pull request.

## License

This project is licensed under the MIT License. Refer to the LICENSE file for more details.

## Acknowledgments

Special thanks to the Laravel and Vue.js communities for their exceptional documentation, tools, and support, which made this project possible.

---

Thank you for checking out SpeakSmarter! Feel free to reach out with questions, suggestions, or feedback. Happy coding!

