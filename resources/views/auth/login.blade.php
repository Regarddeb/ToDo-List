@include('partials.__header', ['title' => 'To Do Login'])

<div class="container mx-auto flex flex-grow h-full items-center justify-center px-1 md:px-0">
    <div class="flex flex-col w-full md:w-2/5 py-6 md:px-3 rounded-lg text-xs md:text-sm">
        <p class="w-full text-lg py-6 pt-8 md:py-7 font-extrabold text-hover flex justify-center">Login to your account
        </p>
        {{-- error message --}}
        @if ($errors->has('email'))
            <div class="w-full rounded-lg py-2 bg-red-600 bg-opacity-50 flex items-center justify-center mb-3">
                <p class="text-gray-200 font-bold opacity-100">{{ $errors->first('email') }}</p>
            </div>
        @endif
        {{-- success message --}}
        @if (session('success'))
            <div class="w-full rounded-lg py-2 bg-green-500 bg-opacity-50 flex items-center justify-center mb-3">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="bg-neutral-700 w-full rounded-lg h-8 px-2 custom-outline" placeholder="Enter your email address"
                        required value="{{ old('email') }}">

                </div>
                <div class="flex flex-col space-y-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2" placeholder="Enter your password" required>
                    @if ($errors->has('password'))
                        <span class="text-xs flex justify-end text-red-500">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <button type="submit"
                class="bg-purple-700 mt-9 py-1.5 px-3 font-semibold rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-500 w-full flex justify-center">
                <p class="flex items-center"><i class="bx bx-xs mr-2 -ml-0.5"></i> Login</p>
            </button>
        </form>
        <a href="{{ route('register') }}"><button
                class="border-2 border-purple-700 bg-gray-950 mt-5 py-1.5 px-3 rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-gray-500 focus:ring focus:ring-gray-200 w-full flex justify-center"
                value="Login">
                Not yet registered? Signup.
            </button></a>
    </div>
</div>

@include('partials.__footer')
