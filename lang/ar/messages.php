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
    'AddedSuccessfully'                 => 'تمت إضافة بيانات :resource بنجاح',
    'UpdatedSuccessfully'               => 'تم تعديل بيانات :resource بنجاح',
    'DataSuccessfullyFetched'           => 'تم جلب بيانات :resource بنجاح',
    'DeletedSuccessfully'               => 'تم حذف بيانات :resource بنجاح',
    'SendingOTPVerificationCode'        => ' تم إرسال رمز التحقق من الحساب بنجاح إلى بريدك الإلكتروني,'.
                                           'من فضلك استخدم هذا الرمز للتحقق من هويتك',
    'SuccessfullyResettingPassword'    =>  'الرمز الذي قمت بإدخاله صحيح وتمت عملية إعادة تعيين كلمة المرور بنجاح',
    'InvalidOTPCode'                    => 'رمز التحيقق من الحساب غير صحيح أو قد انتهت صلاحيته',
    'EmptyData'                         => ':resource خالية',
    'AlreadyExist'                      => ':resource موجود بالفعل',
    'Success'                           => '.تمت العملية بنجاح',
    'Failed'                            => '.فشلت العملية',

    // General Errors
    'ResourceNotFoundF'             => '.غير موجودة:resource',
    'ResourceNotFound'              => '.غير موجود:resource',
    'ResourceAlreadyExist'          => '  :resource  موجود مسبقا ل :resourceTwo ',
    'DeletingFailed'                => 'فشلت عملية الحذف',
    'NoPermission'                  => 'لا تملك صلاحيات',
    'RoleNotFound'                  => 'هذا الدور غير موجود',
    'MethodNotAllowed'                    => '.الإجراء غير صالح',
    'URLNotFound'                   => 'المحدد غير موجود URL ال',
    // Auth Controller msgs
    'PasswordChangedSuccessfully'   => 'تم تغيير كلمة المرور بنجاح',
    'UserSuccessfullyRegistered'    => 'تم تسجيل المستخدم بنجاح',
    'LoginSuccessfully'             => 'تم تسجيل الدخول بنجاح',
    'LoggoutSuccessfully'           => 'تم تسجيل الخروج بنجاح',
    'UserSuccessfullySignedOut'     => 'تم تسجيل الخروج بنجاح',

    // ERRORS

    // Auth Controller error msgs
    'newPasswordError'              => 'كلمة المرور الجديدة لا يمكن ان تكون مماثلة للقديمة . يرجى إعادة المحاولة',
    'WrongPassword'                 => 'كلمة المرور غير صالحة',
    'WrongOldPassword'              => 'كلمة المرور القديمة غير صالحة',
    'passwordConfirmationNotMatch'  => 'تأكيد كلمة المرور غير متطابقة. يرجى إعادة المحاولة',
    'UnactiveAccount'               => 'غير مصرح لك! إن حسابك غير نشط, سيتم إرسال ' .
                                       'رمز التحقق من الحساب إلى بريدك الإلكتروني ' .
                                       'من فضلك استخدم هذا الرمز للتحقق من هويتك وتنشيط حسابك',
    'IncompleteAccount'            => 'غير مصرح لك! إن حسابك غير مكتمل المعلومات, سيتم إرسال' .
                                      'رمز التحقق من الحساب إلى بريدك الإلكتروني ' .
                                      'من فضلك استخدم هذا الرمز للتحقق من هويتك وإكمال معلومات تسجيل الحساب',
    'RefuseResetPassword'           => 'طلب سيء! الزبون لم يقم بطلب نسيان كلمة المرور قبل طلب إعادة تعيين كلمة المرور',
    'EmailAlreadyTaken'             => '.غير مصرح لك! عنوان البريد الإلكتروني الذي قمت بإدخالة هو مأخوذ ومسجل على النظام بالفعل',

    'EmailNotVerified'              => 'لم يتم التحقق من بريدك الإلكتروني',

    'NotAuthorized'                 => 'انت غير مخول لفعل هذا الأجراء',

    'Unauthenticated'               => '.غير مصرح لك!الرجاء تسجيل الدخول إلى النظام أ,لاً',

    'ErrorInUserNameOrPhoneNumber'  => 'خطأ في اسم المستخدم او رقم الهاتف',
    'AlreadyHandled'                => 'تمت معالجة الطلب من قبل ',
    'RequestHasAlreadyBeenSent'     => 'تم إرسال الطلب مسبقاً',
    'UserNameOrPhoneNumberAlreadyExist' => 'اسم المستخدم أو رقم الهاتف موجود مسبقاً',
    'LanguageNotSupported'          => '.اللغة غير مدعومة',
    'UserTypeNotSupported'      => '.نوع المستخدم غير مدعوم',
    'OrderNotAllowed'               => 'غير مسموح طلب شراء وذلك لأن سعر الطلبية أكبر من المبلغ الموجود في حافظتك.'
];
