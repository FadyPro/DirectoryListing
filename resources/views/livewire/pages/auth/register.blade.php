<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.frontend.master')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <!--==========================
       BREADCRUMB PART START
   ===========================-->
    <div id="breadcrumb_part">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>sign up</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"> Home </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> sign up </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==========================
        BREADCRUMB PART END
    ===========================-->


    <!--=========================
        SIGN IN START
    ==========================-->
    <section class="wsus__login_page">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="wsus__login_area">
                        <h2>Welcome back!</h2>
                        <p>sign up to continue</p>
                        <form wire:submit="register">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <label>name</label>
                                        <input wire:model="name" type="text" placeholder="Name" name="name" value="{{ old('name') }}" required>
                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <label>email</label>
                                        <input wire:model="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                        @error('email') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <label>password</label>
                                        <input wire:model="password" type="password" placeholder="Password" name="password" required>
                                        @error('form.password') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <label>confirm password</label>
                                        <input wire:model="password_confirmation" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                        @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <button type="submit" class="common_btn">registration</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="or"><span>or</span></p>
                        {{-- <ul class="d-flex">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul> --}}
                        <p class="create_account">Dont’t have an aceount ? <a href="{{ route('login') }}">login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        SIGN IN END
    ==========================-->


</div>
