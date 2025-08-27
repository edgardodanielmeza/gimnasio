<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Theme Test Page</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Theme Manager Script -->
        <script>
            const savedTheme = localStorage.getItem('theme') || 'black';
            document.documentElement.setAttribute('data-theme', savedTheme);
            function setTheme(theme) {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
            }
        </script>
    </head>
    <body class="antialiased bg-base-200 text-base-content">
        <div class="p-4 sm:p-8">
            <!-- Header -->
            <div class="navbar bg-base-100 rounded-box shadow-lg">
                <div class="flex-1">
                    <a class="btn btn-ghost text-xl">DaisyUI Theme Test</a>
                </div>
                <div class="flex-none">
                    @if (Route::has('login'))
                        <div class="flex items-center gap-2">
                            <x-theme-switcher />
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-ghost">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-ghost">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>

            <!-- Components Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

                <!-- Buttons -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Buttons</h2>
                        <p>Click me!</p>
                        <div class="card-actions justify-end mt-2">
                            <button class="btn">Default</button>
                            <button class="btn btn-primary">Primary</button>
                            <button class="btn btn-secondary">Secondary</button>
                            <button class="btn btn-accent">Accent</button>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Alerts</h2>
                        <div role="alert" class="alert alert-info mt-2">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                          <span>This is an info alert.</span>
                        </div>
                        <div role="alert" class="alert alert-success mt-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                          <span>This is a success alert.</span>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="card bg-base-100 shadow-xl image-full">
                    <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">Card with Image</h2>
                        <p>This card uses `bg-base-100` but has an image background.</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <!-- Toggles and Inputs -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Form Elements</h2>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <span class="label-text">Remember me</span>
                                <input type="checkbox" checked="checked" class="checkbox checkbox-primary" />
                            </label>
                        </div>
                        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs mt-2" />
                        <div class="rating mt-2">
                          <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                          <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked />
                          <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                          <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                          <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                        </div>
                    </div>
                </div>

                 <!-- Another Card -->
                <div class="card lg:col-span-2 bg-primary text-primary-content shadow-xl">
                  <div class="card-body">
                    <h2 class="card-title">Card with Primary Color</h2>
                    <p>This card uses `bg-primary` and `text-primary-content` classes.</p>
                    <div class="card-actions justify-end">
                        <button class="btn">Get Started</button>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </body>
</html>
