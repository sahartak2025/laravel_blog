<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return RedirectResponse
     */
    public function userLogin(LoginRequest $request, AuthService $authService): RedirectResponse
    {
        if ($authService->login($request)) {
            return redirect()->intended('profile');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }


    /**
     * @return View
     */
    public function signup(): View
    {
        return view('auth.signup');
    }

    /**
     * @param SignupRequest $request
     * @param AuthService $authService
     * @return RedirectResponse|Redirector
     */
    public function userSignup(SignupRequest $request, AuthService $authService)
    {
        $authService->signup($request);
        return redirect("profile");
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
