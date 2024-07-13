<x-guest-layout title="Login">
  <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
    <img class="w-8 h-8 mr-2" src="https://cdn.discordapp.com/attachments/1221432112444604547/1261543329405866054/heart-rate.png?ex=66935748&is=669205c8&hm=4f30338ee6d1defc8cf7ea1b142bc126bda62f98aac09e7027f65b5030d3e201&" alt="logo">
    {{ config('app.name') }}    
  </div>
  <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-lg xl:p-0 dark:bg-gray-800 dark:border-gray-700">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
              Sign in to your account
          </h1>
          <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
              <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="name@company.com" name="email" :value="old('email')" required autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>
              <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>
              <div class="flex items-center justify-between">
                  <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                      </div>
                      <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                      </div>
                  </div>
                  <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
              </div>
              <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
              <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                  Don’t have an account yet? <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
              </p>
          </form>
      </div>
  </div>
</x-guest-layout>