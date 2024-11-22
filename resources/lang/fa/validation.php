<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'jdate' => ':attribute تاریخ شمسی معتبر نمی‌باشد.',
    'jdate_equal' => ':attribute تاریخ شمسی برابر :fa-date نمی‌باشد.',
    'jdate_not_equal' => ':attribute تاریخ شمسی نامساوی :fa-date نمی‌باشد.',
    'jdatetime' => ':attribute تاریخ و زمان شمسی معتبر نمی‌باشد.',
    'jdatetime_equal' => ':attribute تاریخ و زمان شمسی مساوی :fa-date نمی‌باشد.',
    'jdatetime_not_equal' => ':attribute تاریخ و زمان شمسی نامساوی :fa-date نمی‌باشد.',
    'jdate_after' => ':attribute تاریخ شمسی باید بعد از :fa-date باشد.',
    'jdate_after_equal' => ':attribute تاریخ شمسی باید بعد یا برابر از :fa-date باشد.',
    'jdatetime_after' => ':attribute تاریخ و زمان شمسی باید بعد از :fa-date باشد.',
    'jdatetime_after_equal' => ':attribute تاریخ و زمان شمسی باید بعد یا برابر از :fa-date باشد.',
    'jdate_before' => ':attribute تاریخ شمسی باید قبل از :fa-date باشد.',
    'jdate_before_equal' => ':attribute تاریخ شمسی باید قبل یا برابر از :fa-date باشد.',
    'jdatetime_before' => ':attribute تاریخ و زمان شمسی باید قبل از :fa-date باشد.',
    'jdatetime_before_equal' => ':attribute تاریخ و زمان شمسی باید قبل یا برابر از :fa-date باشد.',

    "string"=>"فرمت رشته باید باشد",
    "Hello!"=>"سلام!",
    "active"=>"فعال/غیرفعال",
    "delete"=>"حذف",
    "Whoops!"=>'خطا!',
    "accepted"         => ":attribute باید پذیرفته شده باشد.",
    "active_url"       => "آدرس :attribute معتبر نیست",
    "after"            => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha"            => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array"            => ":attribute باید شامل آرایه باشد.",
    "before"           => ":attribute باید تاریخی قبل از :date باشد.",
    "between"          => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array"   => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean"          => "The :attribute field must be true or false",
    "confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
    "date"             => ":attribute یک تاریخ معتبر نیست.",
    "date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
    "different"        => ":attribute و :other باید متفاوت باشند.",
    "digits"           => ":attribute باید :digits رقم باشد.",
    "digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
    "email"            => "فرمت :attribute معتبر نیست.",
    "exists"           => ":attribute انتخاب شده، معتبر نیست.",
    "image"            => ":attribute باید تصویر باشد.",
    "in"               => ":attribute انتخاب شده، معتبر نیست.",
    "integer"          => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip"               => ":attribute باید IP آدرس معتبر باشد.",
    "max"              => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file"    => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes"            => ":attribute باید یکی از فرمت‌های :values باشد.",
    "min"              => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file"    => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array"   => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in"           => ":attribute انتخاب شده، معتبر نیست.",
    "numeric"          => ":attribute باید شامل عدد باشد.",
    "regex"            => ":attribute یک فرمت معتبر نیست",
    "required"         => "فیلد :attribute الزامی است",
    "required_if"      => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all"=> ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same"             => ":attribute و :other باید مانند هم باشند.",
    "size"             => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string"  => ":attribute باید برابر با :size کاراکتر باشد.",
        "array"   => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone"         => "The :attribute must be a valid zone.",
    "unique"           => ":attribute قبلا انتخاب شده است.",
    "uniques"           => ":attribute قبلا انتخاب شده است.",
    "url"              => "فرمت آدرس :attribute اشتباه است.",
    "exists_code"      => "کد ارسالی در سیستم وجود ندارد",
    "expire_code"      => "اعتبار کد ارسالی به پایان رسیده است",
    "used"             => "این کد قبلا مورد استفاده قرار گرفته است",
    "exists_phone"     => "چنین شماره ای در سیستم ثبت نشده است",
    "recaptcha"        => "کپچا اعتبار لازم را ندارد",
    'phone_number'=>'فیلد شماره موبایل معتبر نمی‌باشد',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        "meter_id"=>"سریال کنتور",
        "files.*"=>"فایل",
        "laboratory_id"=>"کد آزمایشگاه",
        "laboratory_no"=>"شماره آزمایشگاه",
        "price_unit"=>"قیمت واحد",
        "currency_id"=>"واحد ارز",
        "status"=>"وضعیت",
        "day_supply"=>"روز تحویل",
        "unit_fa"=>"واحد ارز به فارسی",
        "unit_en"=>"واحد ارز به انگلیسی",
        "rial"=>"واحد ارزی به ریال",
        "symbol"=>"علامت",
        "icon"=>"آیکون",
        "color"=>"رنگ",
        "name_fa" => "نام واحد مقیاس به فارسی",
        "name_en" => "نام واحد مقیاس به انگلیسی",
        "prefix"=>"مخفف",
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه‌ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "tell"=>"شماره تلفن",
        "totalPrice"=>"مجموعه قیمت",
        "deposit"=>"بیعانه",
        "level"=>"نوع کاربر",
        "weight"=>"وزن",
        "length"=>"طول",
        "price"=>"قیمت",
        "number"=>"تعداد",
        "order_id"=>"شمار سفارش",
		"group_id"=>"شماره فاکتور",
        "plate_id"=>"شماره ورق",
        "factor_id"=>"شماره فاکتور",
        "cut_id"=>"شماره برش",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "body" => "متن",
        "comment" => "کامنت",
        "type_of_region_id" => "نوع منطقه",
        "substructure" => "زیر بنا",
        "number_of_unit" => "تعداد واحد",
        "new_consumption_id" => "نوع مصرف",
        "type_of_activity_id" => "نوع فعالیت",
    ),
);
