<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */

    protected function passwordRules()
    {
        $newPassword = new Password;
        $newPassword->length(10);
        $newPassword->requireUppercase();
        return ['required', 'string', $newPassword, 'confirmed'];
        // return ['required', 'string', new Password, 'confirmed'];
    }
}
