<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Reset Password
                </button>
            </div>
        </form>

        <!-- Display errors if any -->
        @if ($errors->any())
            <div class="mt-4">
                <ul class="text-red-500 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</body>

</html>
