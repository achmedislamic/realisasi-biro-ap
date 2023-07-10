<x-guest-layout>
    <section class="w-full h-full bg-white">
        <div class="flex items-center justify-center">
            <div class="mx-auto my-auto max-w-7xl">
                <div class="flex flex-col lg:flex-row">
                    <div class="relative w-full bg-cover lg:w-6/12 xl:w-7/12 bg-gradient-to-r from-white via-white to-gray-100">
                        <div class="relative flex flex-col items-center justify-center w-full h-full px-10 my-20 lg:px-16 lg:my-0">
                            <div class="flex flex-col items-start space-y-8 tracking-tight lg:max-w-3xl">
                                <div class="relative">
                                    <p class="mb-2 font-medium text-gray-700 uppercase">Work smarter</p>
                                    <h2 class="text-5xl font-bold text-gray-900 xl:text-6xl">Features to help you work smarter</h2>
                                </div>
                                <p class="text-2xl text-gray-700">We've created a simple formula to follow in order to gain more out of your business and your application.</p>
                                <a href="#_" class="inline-block px-8 py-5 text-xl font-medium text-center text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 ease" data-primary="blue-600" data-rounded="rounded-lg">Get Started Today</a>
                            </div>
                        </div>
                    </div>

                    <div class="w-full bg-white lg:w-6/12 xl:w-5/12">
                        <form method="POST" action="{{ route('login') }}">
                            <div class="flex flex-col items-start justify-start w-full h-full p-10 lg:p-16 xl:p-24">
                                <h4 class="w-full text-3xl font-bold">Signup</h4>
                                <p class="text-lg text-gray-500">or, if you have an account you can <a href="#_" class="text-blue-600 underline" data-primary="blue-600">sign in</a></p>
                                <div class="relative w-full mt-10 space-y-8">
                                    <div class="relative">
                                        <x-input-label for="email" :value="__('Surel (Email)')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                                      required autofocus />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="relative">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                                      autocomplete="current-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="relative">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                                        </label>
                                    </div>
                                    <div class="relative">
                                        <x-primary-button>
                                            Masuk
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
</x-guest-layout>
