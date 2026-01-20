<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - AutoMate</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
      <!-- Logo -->
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900">AutoMate</h1>
        <p class="text-gray-600 mt-2">Reset your password</p>
      </div>

      <!-- Card -->
      <div class="bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
          <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-gray-900">Forgot Password?</h2>
          <p class="text-sm text-gray-600 mt-2">No worries! Enter your email and we'll send you reset instructions.</p>
        </div>

        <form action="#" method="POST" class="space-y-6">
          @csrf
          
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              placeholder="your.email@example.com"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
              required
            >
          </div>

          <button 
            type="submit" 
            class="w-full bg-orange-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-orange-600 transition shadow-lg"
          >
            Send Reset Link
          </button>
        </form>

        <div class="mt-6 text-center">
          <a href="{{ route('login') }}" class="text-sm text-orange-600 hover:text-orange-800 font-semibold">
            ← Back to Login
          </a>
        </div>

        <!-- Info Box -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
          <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
              <p class="text-sm text-blue-900 font-semibold">Need help?</p>
              <p class="text-xs text-blue-700 mt-1">If you don't receive the email within 5 minutes, check your spam folder or contact support.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Alternative Options -->
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          Don't have an account? 
          <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-800 font-semibold">Sign up</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
