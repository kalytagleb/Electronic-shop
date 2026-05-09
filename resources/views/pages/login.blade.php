<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In - Electronic shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
  </head>
  <body class="bg-white text-gray-900 min-h-screen flex flex-col">
    @include('components.navbar')


    <main class="flex-1 flex flex-col items-center justify-center px-6 py-12">
      <h1 class="text-3xl font-extrabold tracking-tight mb-8">Electronic shop</h1>
      <div class="w-full max-w-md border border-gray-200 rounded-2xl px-10 py-10">
        <h2 class="text-3xl font-extrabold tracking-tight mb-1">Welcome back</h2>
        <p class="text-sm text-gray-500 mb-8">
          No account yet?
          <a href="{{ route('register') }}" class="font-bold text-gray-900 underline underline-offset-2"
            >Create one</a
          >
        </p>

        <form action="{{ route('login.post') }}" method="POST" class="w-full max-w-md">
          @csrf <div class="mb-4">
            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email</label>
            <input
              type="email"
              name="email"  id="loginEmail"
              placeholder="admin@gmail.com"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
              required
            />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
              <label class="block text-xs font-bold uppercase tracking-widest">Password</label>
              <a href="#" class="text-xs text-gray-400 hover:text-gray-900 transition-colors"
                >Forgot password?</a
              >
            </div>
            <input
              type="password"
              name="password" id="loginPassword"
              placeholder="Your password"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
              required
            />
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <button
            type="submit"
            class="w-full bg-black text-white font-bold text-sm py-4 rounded-xl hover:opacity-80 transition-opacity mb-6"
          >
            Log in
          </button>
        </form>

        <div class="flex items-center gap-3 mb-6">
          <div class="flex-1 h-px bg-gray-200"></div>
          <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">or</span>
          <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <button
          class="w-full flex items-center justify-center gap-3 border border-gray-200 rounded-xl py-3 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all"
        >
          <img src="{{ asset('static/google.svg') }}" class="w-[18px] h-[18px]" alt="" />
          Continue with Google
        </button>
      </div>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
