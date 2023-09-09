@include('partials.__header', ['title' => 'To Do Register'])

<div class="container mx-auto flex flex-grow h-full items-center justify-center px-1 md:px-0">
    <div class="flex flex-col w-full md:w-3/6 py-6 md:px-3 rounded-lg text-xs md:text-sm">
        <p class="w-full text-lg py-5 pt-2 md:py-5 font-extrabold text-hover flex justify-center">Create an account</p>
    
    <div class="flex max-h-fit justify-center"></div>
    <form action="{{ route('store') }}" method="POST">
            @csrf
        <div class="space-y-3 w-full flex flex-col justify-evenly">
            <div class="flex flex-col space-y-2 w-full">
                <label for="name">Username</label>
                <input required type="text" name="name" id="name" 
                    class="custom-outline form-control bg-neutral-700 w-full rounded-lg h-8 px-2 @error('name') is-invalid @enderror" placeholder="Enter your name" value="{{old('name')}}">

                @if($errors->has('name'))
                <span class="text-xs flex justify-end text-red-500">
                    {{$errors->first('name')}}
                </span>
                @else <span></span>
                @endif
            
            </div>
            <div class="flex flex-col space-y-2">
                <label for="email">Email Address</label>
                <input required type="email" name="email" id="email" 
                class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2 @error('email') is-invalid @else is-valid @enderror" placeholder="Enter your email address" value="{{old('email')}} ">
                
                @if($errors->has('email'))
                <span class="text-xs flex justify-end text-red-500">
                    {{$errors->first('email')}}
                </span>
                @else <span></span>
                @endif
            
            </div>
            <div class="flex flex-col space-y-2">
                <label for="password">Password</label>
                <input required type="password" name="password" id="password" 
                class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2" placeholder="Enter your password">
                
                @if($errors->has('password'))
                <span class="text-xs flex justify-end text-red-500">
                    {{$errors->first('password')}}
                </span>
                @else <span></span>
                @endif
            
            </div>
            <div class="flex flex-col space-y-2">
                <label for="password_confirmation">Confirm password</label>
                <input required type="password" name="password_confirmation" id="password_confirmation" 
                class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2" placeholder="Confirm your password">
                <span></span>
            </div>
        </div>
        <button type="submit"
            class=" bg-purple-700 mt-9 py-1.5 px-3 font-semibold rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-hover focus:ring focus:ring-gray-200 w-full flex justify-center"
            value="Register">
            <p class="flex items-center"><i class="bx bx-xs mr-2 -ml-0.5"></i> Signup</p>
        </button>
    </form>
        <a href="{{ route('login') }}">
            <button
            class="border-2 border-purple-800 bg-darkest mt-5 py-1.5 px-3 rounded-lg hover:bg-purple-500 hover:text-text-gray-950 active:bg-hover focus:ring focus:ring-gray-200 w-full flex justify-center">
            Already have an account? Login.
        </button></a>
    </div>
</div>

@include('partials.__footer')
