<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Electronic shop</title>
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
      <form id="registerForm" class="w-full max-w-md border border-gray-200 rounded-2xl px-10 py-10">
        <h2 class="text-3xl font-extrabold tracking-tight mb-1">Create account</h2>
        <p class="text-sm text-gray-500 mb-8">
          Already have one?
          <a href="{{ route('login') }}" class="font-bold text-gray-900 underline underline-offset-2"
            >Log in</a
          >
        </p>

        <div class="grid grid-cols-2 gap-3 mb-4">
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest mb-2">First name</label>
            <input
              type="text"
              id="regFirstName"
              placeholder="Gleb"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
            />
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Last name</label>
            <input
              type="text"
              id="regLastName"
              placeholder="Kalyta"
              class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
            />
          </div>
        </div>

        <div class="mb-4">
          <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email</label>
          <input
            type="email"
            id="regEmail"
            placeholder="kalytagleb@gmail.com"
            class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
          />
        </div>

        <div class="mb-4">
          <label class="block text-xs font-bold uppercase tracking-widest mb-2">Password</label>
          <input
            type="password"
            id="regPassword"
            placeholder="Min. 8 characters"
            class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
          />
        </div>

        <div class="mb-6">
          <label class="block text-xs font-bold uppercase tracking-widest mb-2"
            >Confirm password</label
          >
          <input
            type="password"
            id="regPasswordConfirmation"
            placeholder="Repeat password"
            class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 focus:bg-white transition-colors"
          />
        </div>

        <label class="flex items-start gap-3 mb-6 cursor-pointer">
          <input type="checkbox" class="mt-0.5 w-4 h-4 accent-black cursor-pointer shrink-0" />
          <span class="text-sm text-gray-500">
            I agree to the
            <a href="#" class="text-gray-900 underline underline-offset-2">Terms of Service</a>
            and
            <a href="#" class="text-gray-900 underline underline-offset-2">Privacy Policy</a>
          </span>
        </label>

        <button
          type="submit"
          class="w-full bg-black text-white font-bold text-sm py-4 rounded-xl hover:opacity-80 transition-opacity"
        >
          Create account
        </button>
      </form>
    </main>

    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
