<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contect page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
  </head>
  <body class="bg-white text-gray-900">
    @include('components.navbar')
    
    <main class="max-w-7xl mx-auto px-8 py-12 md:py-20 w-full flex-1">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-24">
        <div>
          <h1 class="text-4xl md:text-5xl font-extrabold mb-6 tracking-tight">Get in touch</h1>
          <p class="text-gray-500 mb-8 leading-relaxed">
            Have a question about our products, your order, or just want to say hi? Drop us a
            message and our team will get back to you within 24 hours.
          </p>

          <div class="flex flex-col gap-6">
            <div class="flex items-start gap-4">
              <div
                class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center shrink-0"
              >
                <img src="{{ asset('static/search.svg') }}" class="w-4 h-4 opacity-50" alt="Email" />
              </div>
              <div>
                <p class="text-sm font-bold uppercase tracking-widest mb-1">Email</p>
                <a
                  href="mailto:support@wtech.com"
                  class="text-gray-600 hover:text-black font-mono transition-colors"
                  >support@wtech.com</a
                >
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div
                class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center shrink-0"
              >
                <img src="{{ asset('static/search.svg') }}" class="w-4 h-4 opacity-50" alt="Phone" />
              </div>
              <div>
                <p class="text-sm font-bold uppercase tracking-widest mb-1">Phone</p>
                <a
                  href="tel:+1234567890"
                  class="text-gray-600 hover:text-black font-mono transition-colors"
                  >+1 (234) 567-890</a
                >
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-50 p-8 rounded-3xl border border-gray-200">
          <form class="flex flex-col gap-5">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2">Name</label>
              <input
                type="text"
                placeholder="Gleb Kalyta"
                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 transition-colors"
              />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email</label>
              <input
                type="email"
                placeholder="kalytagleb@gmail.com"
                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 transition-colors"
              />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest mb-2">Message</label>
              <textarea
                rows="4"
                placeholder="How can we help you?"
                class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono outline-none focus:border-gray-900 transition-colors resize-none"
              ></textarea>
            </div>

            <button
              type="button"
              class="w-full bg-black text-white font-bold text-sm py-4 rounded-xl hover:opacity-80 transition-opacity mt-2"
            >
              Send Message
            </button>
          </form>
        </div>
      </div>
    </main>
    <script src="{{ asset('script.js') }}"></script>
  </body>
</html>
