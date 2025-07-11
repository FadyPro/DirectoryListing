<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.frontend.master')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function alertSuccess($rel)
    {
        $this->dispatch('alert',
            ['types' => 'success',  'message' => $rel]);
    }
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        if(\Illuminate\Support\Facades\Auth::user()->role === 'admin'){
            $this->redirectIntended(default: RouteServiceProvider::ADMIN, navigate: true);
            $this->alertSuccess('Login Successfully');
        }else if (\Illuminate\Support\Facades\Auth::user()->role === 'user'){
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
            $this->alertSuccess('Login Successfully');
        }
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
                        <h4>sign in</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"> Home </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> sign in </li>
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
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="wsus__login_page">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="wsus__login_area">
                        <h2>Welcome back!</h2>
                        <p>sign in to continue</p>
                        <form wire:submit="login">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <label>email</label>
                                        <input wire:model="form.email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                        @error('form.email') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <label>password</label>
                                        <input wire:model="form.password" id="password" type="password" placeholder="Password" name="password" required autocomplete="current-password">
                                        @error('form.password') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_imput wsus__login_check_area">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckDefault" name="remember">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Remeber Me
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}">Forget Password ?</a>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_imput">
                                        <button type="submit">login</button>
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
                        <p class="create_account">Dont’t have an aceount ? <a href="{{ route('register') }}">Create Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
            SIGN IN END
    ==========================-->
<style>
    .error{
        color: red;
    }
</style>

</div>
