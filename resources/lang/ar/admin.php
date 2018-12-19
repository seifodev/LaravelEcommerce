<?php
 return [
     'title' => 'لوحة التحكم',
     'auth' => [
         'login_title' => 'دخول',
         'forgot_title' => 'نسيت كلمة المرور',
     ],
     'navbar' => [
         'dashboard' => 'لوحة التحكم',
         'home' => 'الرئيسية',
         'settings' => 'الاعدادات',
         'admin' => 'التحكم بالمشرفين',
         'admin_admins' => 'المشرفين',
         'admin_create' => 'مشرف جديد',
         'user_control' => 'التحكم بالأعضاء',
         'users' => 'الأعضاء',
         'user_create' => 'عضو جديد',
         'countries' => 'الدول',
         'country_create' => 'دولة جديدة',
         'cities' => 'المدن',
         'city_create' => 'مدينة جديدة',
         'states' => 'المناطق/الاحياء',
         'state_create' => 'منطقة/حي جديد'
     ],
     'table' => [
         'name' => 'الاسم',
         'email' => 'البريد الالكتروني',
         'created' => 'تاريخ الانشاء',
         'updated' => 'اخر تعديل',
         'action' => 'التحكم',
         'name_ar' => 'الاسم بالعربي',
         'name_en' => 'الاسم بالانجليزي',
         'country' => 'الدولة'
     ],
     'modal' => [
         'deleteTitle' => 'حذف المشرفين',
         'usersDeleteTitle' => 'حذف الاعضاء',
         'countryDeleteTitle' => 'حذف الدول',
         'cityDeleteTitle' => 'حذف المدن',
         'stateDeleteTitle' => 'حذف المنطقة/الحي',
         'recordsMsg' => 'حذف <span></span> سجلات ؟',
         'noRecordsMsg' => 'لم يتم اختيار اي سجلات للحذف!',
         'close' => 'اغلاق',
         'confirm' => 'تأكيد'
     ],
     'datatables' => [
         "decimal" =>        "",
         "emptyTable" =>     "لا توجد بيانات متاحة",
         "info" =>           "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
         "infoEmpty" =>      "يعرض 0 إلى 0 من أصل 0 سجل",
         "infoFiltered" =>   "(منتقاة من مجموع _MAX_ مُدخل)",
         "infoPostFix" =>    "",
         "thousands" =>      ",",
         "lengthMenu" =>     "أظهر _MENU_ مدخلات",
         "loadingRecords" => "تحميل...",
         "processing" =>     "جارٍ التحميل...",
         "search" =>         "ابحث:",
         "zeroRecords" =>    "لم يعثر على أية سجلات",
         "first" =>      "الأول",
         "last" =>       "السابق",
         "next" =>       "التالي",
         "previous" =>   "الاخير",
         "sortAscending" =>  ": activate to sort column ascending",
         "sortDescending" => ": activate to sort column descending"

     ],
     'form' => [
         'name' => 'الاسم',
         'email' => 'البريد الالكتروني',
         'password' => 'كلمة المرور',
         'cPassword' => 'تأكيد كلمة المرور',
         'namePlaceholder' => 'ادخل الاسم...',
         'emailPlaceholder' => 'ادخل البريد الالكتروني...',
         'passwordPlaceholder' => 'ادخل الرقم السري...',
         'cPasswordPlaceholder' => 'ادخل الرقم السري مرة اخرى...',
         'create' => 'انشاء',
         'reset' => 'الغاء',
         'save' => 'حفظ',
         'site_ar' => 'اسم الموقع بالعربية',
         'site_en' => 'اسم الموقع بالانجليزية',
         'lang' => 'اللغة الافتراضية',
         'logo' => 'شعار الموقع',
         'icon' => 'رمز الموقع',
         'desc' => 'وصف الموقع',
         'keys' => 'الكلمات الدلائلية',
         'status' => 'حالة الموقع',
         'msg' => 'رسالة الصيانة',
         'open' => 'مفتوح',
         'close' => 'مغلق',
         'country_en' => 'اسم الدولة بالانجليزية',
         'country_ar' => 'اسم الدولة بالعربية',
         'country_mob' => 'Mob',
         'country_code' => 'Code',
         'country_logo' => 'الشعار',
         'city_en' => 'اسم المدينة بالانجليزية',
         'city_ar' => 'اسم المدينة بالعربية',
         'state_en' => 'اسم المنطقة/الحي بالانجليزية',
         'state_ar' => 'اسم المنطقة/الحي بالعربية',
         'city' => 'المدينة',
         'country' => 'الدولة',
     ],
     'userLevel' => [
         'level' => 'مستوى العضوية',
         'user' => 'عضو',
         'vendor' => 'متجر',
         'company' => 'شركة'
     ],


     'adminsTitle' => 'التحكم بالمشرفين',
     'usersTitle' => 'التحكم بالأعضاء',
     'alert' => 'تنبيه',
     'adminDeleted' => 'تم حذف :RECORDS مشرفين بنجاح',
     'adminCreated' => 'تم انشاء المشرف (:NAME) بنجاح',
     'adminUpdated' => 'تم تعديل بيانات المشرف (:NAME) بنجاح',
     'createAdmin' => 'انشاء مشرف جديد',
     'editAdmin' => 'تعديل بيانات المشرف :NAME',
     'createUser' => 'انشاء عضو جديد',
     'editUser' => 'تعديل بيانات العضو :NAME',
     'userDeleted' => 'تم حذف :RECORDS عضو بنجاح',
     'userCreated' => 'تم انشاء العضو (:NAME) بنجاح',
     'userUpdated' => 'تم تعديل بيانات العضو (:NAME) بنجاح',
     'settingsUpdated' => 'تم حفظ الاعدادات بنجاح',
     'countriesTitle' => 'الدول',
     'createCountry' => 'اضافة دولة جديدة',
     'editCountry' => 'تعديل الدولة',
     'countryDeleted' => 'تم حذف الدولة بنجاح',
     'countryCreated' => 'تم اضافة الدولة بنجاح',
     'countryUpdated' => 'تم التعديل على الدولة بنجاح',
     'citiesTitle' => 'المدن',
     'createCity' => 'اضافة مدينة',
     'editCity' => 'تعديل المدينة',
     'cityDeleted' => 'تم حذف المدينة بنجاح',
     'cityCreated' => 'تم اضافة المدينة بنجاح',
     'cityUpdated' => 'تم تعديل المدينة بنجاح',
     'statesTitle' => 'المناطق/الاحياء',
     'createState' => 'اضافة منطقة/حي جديد',
     'editState' => 'تعديل المنطقة/الحي',
     'stateDeleted' => 'تم حذف المنطقة/الحي بنجاح',
     'stateCreated' => 'تم اضافة المنطقة/الحي بنجاح',
     'stateUpdated' => 'تم تعديل المنطقة/الحي بنجاح',
 ];