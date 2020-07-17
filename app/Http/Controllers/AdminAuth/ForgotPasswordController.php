<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin'); // guest | admin = guard
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('admin-auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function validateEmail(Request $request)
    {
        return $request->validate([
            'email' => 'required|email|exists:admins,email'
        ], $this->validateError());
    }

    /**
     * Handlong Validate Error the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function validateError()
    {
        return [
            'email' => 'Your email doesn\'t exists.'
        ];
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins'); // auth.php Resetting Password
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function credentials(Request $request)
    {
        return $request->only('email');
    }
}
