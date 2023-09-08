<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // General msgs
    'AddedSuccessfully'                 => ':resource Data added successfully',
    'UpdatedSuccessfully'               => ':resource Data updated successfully',
    'DataSuccessfullyFetched'           => ':resource Data fetched successfully',
    'DeletedSuccessfully'               => ':resource Data deleted successfully',
    'SendingOTPVerificationCode'        => 'A verification OTP code has been sent to your email address, '.
                                           'please use this code to verify your account.',
    'SuccessfullyResettingPassword'    =>  'The code is correct and you have successfully resetting your password.',
    'InvalidOTPCode'                    => 'OTP code is invalid',
    'EmptyData'                         => ':resource Is Empty ',
    'UserIsAlreadyExist'                => ':resource already exists',
    'Success'                           => 'Success',
    'Failed'                            => 'Failed',


    // General Errors
    'ResourceNotFoundF'         => ':resource Not Found',
    'ResourceNotFound'          => ':resource Not Found',
    'ResourceAlreadyExist'      => ':resource already exist for :objectTwo',
    'DeletingFailed'            => 'Deleting Failed',
    'NoPermission'              => 'You do not have permission',
    'RoleNotFound'              => 'Role not found',
    'MethodNotAllowed'          => 'The specified method for the request is invalid.',
    'URLNotFound'               => 'The specified URL cannot be found',
    'LanguageNotSupported'      => 'Language not supported.',
    'UserTypeNotSupported'      => 'User type not supported.',

    // Auth Controller msgs
    'PasswordChangedSuccessfully'       => 'Password changed successfully !',
    'UserSuccessfullyRegistered'        => 'User successfully registered',
    'LoginSuccessfully'                 => 'logged in successfully',
    'LoggoutSuccessfully'               => 'logged out successfully',
    'UnmatchedUserType'                 => 'Unmatched user type, enter barber or customer as user type in the header of request.',
    // ERRORS

    // Auth Controller error msgs
    'WrongPassword'                     => 'Invalid password.',
    'Unauthenticated'                   => 'Unatuehenticated! you must login to the system first.',
    'EmailNotVerified'                  => 'Your email is not verified.',
    'UnactiveAccount'                   => 'Unauthorized!, Your account is Unactive, a verification OTP code has been sent to your email, '.
                                           'please use this code to verify your identity and activate your account.',
    'IncompleteAccount'                  => 'Unauthorized!, Your account is Uncompleted, a verification OTP code has been sent to your email, '.
                                           'please use this code to verify your identity and complete your account registration information.',
    'RefuseResetPassword'               => 'Bad Request!, Customer does not specify forget password befor that.',
    'EmailAlreadyTaken'                 => 'Unauthorized!, The email address you entered is already taken and registered on the system.',

    'newPasswordError'                  => 'New Password cannot be same as your current password. Please choose a different password.',
    'Unauthorized'                      => 'Error in Credentials',
    'ErrorInUserNameOrPhoneNumber'      => 'Error in phone number or user name',
    'AlreadyHandled'                    => 'reserve request already handled',
    'RequestHasAlreadyBeenSent'         => 'Request has already been sent',
    'UserNameOrPhoneNumberAlreadyExist' => 'user name or phone number already exists',
    'OrderNotAllowed'                   => 'order is not allowed because the order price is greater than the amount in your wallet.'
];
