<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Jalongjang Motor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white h-screen flex items-center justify-center">
    <!-- Login Card -->
    @if ($errors->any())
        <div class="mb-4 text-red-500 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login</h2>

        <!-- Login Form -->
        <form action="{{ route('login.proccess') }}" method="POST">
            <!-- Username Field -->
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="username" name="email"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email" required>
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your password" required>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Login
                </button>
            </div>
            <div class="text-center mt-3">
                Lupa password? <a href="password/reset" class="text-indigo-500">disini</a>
            </div>
        </form>
    </div>
</body>

</html>
