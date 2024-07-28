<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PT. PAS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div id="app">
        <promosi></promosi>
        <navbar
            :user="{{ auth()->user() ? auth()->user() : 'null' }}"
            login-route="{{ route('login') }}"
            register-route="{{ route('register') }}"
            logout-route="{{ route('logout') }}"
        ></navbar>
        <cta></cta>
        <product></product>
        <foot></foot>
    </div>
  </body>
</html>
