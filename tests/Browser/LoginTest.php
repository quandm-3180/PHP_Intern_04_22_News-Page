<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    const EMAIL = 'quanvip123@gmail.com';
    const PASSWORD = '123123123';
    const WRONG_EMAIL = 'wrongemail.com';
    const WRONG_PASSWORD = 'wrongpassword';

    public function testLoginView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee(__('Login'))
                ->assertSee(__('Email Address'))
                ->assertInputPresent('email')
                ->assertSee(__('Password'))
                ->assertInputPresent('password')
                ->assertSee(__('Forgot Your Password?'))
                ->assertSee(__('Remember Me'))
                ->assertInputPresent('remember')
                ->assertSeeIn('@submit-form-login', __('Login'));
        });
    }

    public function testClickForgotPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->click('@forgot-password')
                ->assertRouteIs('password.request');
        });
    }

    public function testClickRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->click('@btn-register')
                ->waitForRoute('register')
                ->assertRouteIs('register');
        });
    }

    public function testRequiredValidate()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->disableClientSideValidation()
                ->type('email', '')
                ->type('password', '')
                ->click('@submit-form-login')
                ->assertRouteIs('login')
                ->assertSee(__('The email field is required.'))
                ->assertSee(__('The password field is required.'));
        });
    }

    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->disableClientSideValidation()
                ->type('email', static::WRONG_EMAIL)
                ->type('password', static::WRONG_PASSWORD)
                ->clickAndWaitForReload('@submit-form-login')
                ->assertSee(__('These credentials do not match our records.'));
        });
    }

    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->disableClientSideValidation()
                ->type('email', static::EMAIL)
                ->type('password', static::PASSWORD)
                ->clickAndWaitForReload('@submit-form-login')
                ->assertRouteIs('client.home')
                ->assertSee(__('HOME'));
        });
    }
}
