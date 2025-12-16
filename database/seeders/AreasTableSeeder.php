<?php

namespace Database\Seeders;

use App\Models\Area;
use Database\Factories\AreaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = [
            [
                'en' => 'Egypt',
                'ar' => 'مصر',
                "governments"  => [
                    [
                        'en' => "Alexandria",
                        "ar" => "الإسكندرية",
                    ],
                    [
                        'en' => "Aswan",
                        "ar" => "أسوان",
                    ],
                    [
                        'en' => "Asyut",
                        "ar" => "أسيوط",
                    ],
                    [
                        'en' => "Beheira",
                        "ar" => "البحيرة",
                    ],
                    [
                        'en' => "Beni Suef",
                        "ar" => "بني سويف",
                    ],
                    [
                        'en' => "Cairo",
                        "ar" => "القاهرة",
                    ],
                    [
                        'en' => "Dakahlia",
                        "ar" => 'الدقهلية',
                    ],
                    [
                        'en' => "Damietta",
                        "ar" => "دمياط",
                    ],
                    [
                        'en' => "Faiyum",
                        "ar" => "الفيوم",
                    ],
                    [
                        'en' => "Gharbia",
                        "ar" => "الغربية",
                    ],
                    [
                        'en' => "Giza",
                        "ar" => "الجيزة",
                    ],
                    [
                        'en' => "Ismailia",
                        "ar" => 'الإسماعيلية',
                    ],
                    [
                        'en' => "Kafr el-Sheikh",
                        "ar" => "كفر الشيخ",
                    ],
                    [
                        'en' => "Luxor",
                        "ar" => "الأقصر",
                    ],
                    [
                        'en' => "Matrouh",
                        "ar" => 'مطروح',
                    ],
                    [
                        'en' => "Minya",
                        "ar" => 'المنيا',
                    ],
                    [
                        'en' => "Monufia",
                        "ar" => "المنوفية",
                    ],
                    [
                        'en' => "New Valley",
                        "ar" => "الوادي الجديد",
                    ],
                    [
                        'en' => "North Sinai",
                        "ar" => 'شمال سيناء',
                    ],
                    [
                        'en' => "Port Said",
                        "ar" => "بورسعيد",
                    ],
                    [
                        'en' => "Qalyubia",
                        "ar" => 'القليوبية',
                    ],
                    [
                        'en' => "Qena",
                        "ar" => 'قنا',
                    ],
                    [
                        'en' => "Red Sea",
                        "ar" => "البحر الاحمر",
                    ],
                    [
                        'en' => "Sharqia",
                        "ar" => 'الشرقية',
                    ],
                    [
                        'en' => "Sohag",
                        "ar" => 'سوهاج',
                    ],
                    [
                        'en' => "South Sinai",
                        "ar" => "جنوب سيناء",
                    ],
                    [
                        'en' => "Suez",
                        "ar" => "السويس",
                    ]
                ]
            ],
            [
                'en' => 'Saudi Arabia',
                'ar' => 'السعودية',
                "governments" => [
                    [
                        'en' => "Asir",
                        "ar" => "عسير",
                    ],
                    [
                        'en' => "Al Bahah",
                        "ar" => 'الباحة',
                    ],
                    [
                        'en' => "Al Jawf",
                        "ar" => 'الجوف',
                    ],
                    [
                        'en' => "Al Madinah",
                        "ar" => "المدينة",
                    ],
                    [
                        'en' => "Al-Qassim",
                        "ar" => "القصيم",
                    ],
                    [
                        'en' => "Eastern Province",
                        "ar" => "المنطقة الشرقية",
                    ],
                    [
                        'en' => "Ha'il",
                        "ar" => "وابل",
                    ],
                    [
                        'en' => "Jizan",
                        "ar" => "جيزان",
                    ],
                    [
                        'en' => "Makkah",
                        "ar" => "مكه",
                    ],
                    [
                        'en' => "Najran",
                        "ar" => 'نجران',
                    ],
                    [
                        'en' => "Northern Borders",
                        "ar" => "الحدود الشمالية",
                    ],
                    [
                        'en' => "Riyadh",
                        "ar" => "الرياض",
                    ],
                    [
                        'en' => 'Tabuk',
                        'ar' => 'تبوك',
                    ],
                ]
            ]
        ];

        $cities = [
            [
                "en" => "Abu Qir",
                'ar' => 'ابو قير',
                "state" => "Alexandria",
            ],
            [
                "en" => "Agami",
                'ar' => 'العجمي',
                "state" => "Alexandria",
            ],
            [
                "en" => "Alexandria",
                'ar' => 'الإسكندرية',
                "state" => "Alexandria",
            ],
            [
                "en" => "Ar-Raml",
                'ar' => 'الرمل',
                "state" => "Alexandria",
            ],
            [
                "en" => "Borg El Arab",
                'ar' => 'برج العرب',
                "state" => "Alexandria",
            ],
            [
                "en" => "Montaza",
                'ar' => 'المنتزة',
                "state" => "Alexandria",
            ],
            [
                "en" => "New Borg El Arab",
                'ar' => 'برج العرب الجديدة',
                "state" => "Alexandria",
            ],
            [
                "en" => "Sidi Bishr",
                'ar' => 'سيدي بشر',
                "state" => "Alexandria",
            ],
            [
                "en" => "Abu Simbel",
                'ar' => 'أبو سمبل',
                "state" => "Aswan",
            ],
            [
                "en" => "Aswan",
                'ar' => 'أسوان',
                "state" => "Aswan",
            ],
            [
                "en" => "Idfū",
                'ar' => 'ادفو',
                "state" => "Aswan",
            ],
            [
                "en" => "Kawm Umbū",
                'ar' => 'كوم أمبو',
                "state" => "Aswan",
            ],
            [
                "en" => "Abnūb",
                'ar' => 'أبنيب',
                "state" => "Asyut",
            ],
            [
                "en" => "Abū Tīj",
                'ar' => 'أبو توج',
                "state" => "Asyut",
            ],
            [
                "en" => "Al Badārī",
                'ar' => 'البداري',
                "state" => "Asyut",
            ],
            [
                "en" => "Al Qūşīyah",
                'ar' => 'القوصية',
                "state" => "Asyut",
            ],
            [
                "en" => "Asyūţ",
                'ar' => 'أسيوط',
                "state" => "Asyut",
            ],
            [
                "en" => "Dayrūţ",
                'ar' => 'ديريت',
                "state" => "Asyut",
            ],
            [
                "en" => "Manfalūţ",
                'ar' => 'منفلوط',
                "state" => "Asyut",
            ],
            [
                "en" => "Abū al Maţāmīr",
                'ar' => 'أبو المعمور',
                "state" => "Beheira",
            ],
            [
                "en" => "Ad Dilinjāt",
                'ar' => 'الدلجات',
                "state" => "Beheira",
            ],
            [
                "en" => "Damanhūr",
                'ar' => 'دمنهور',
                "state" => "Beheira",
            ],
            [
                "en" => "Ḩawsh ‘Īsá",
                'ar' => 'حوش عيسى',
                "state" => "Beheira",
            ],
            [
                "en" => "Idkū",
                'ar' => 'إيدكو',
                "state" => "Beheira",
            ],
            [
                "en" => "Kafr ad Dawwār",
                'ar' => 'كفر الدوار',
                "state" => "Beheira",
            ],
            [
                "en" => "Kawm Ḩamādah",
                'ar' => 'كوم حمادة',
                "state" => "Beheira",
            ],
            [
                "en" => "Rosetta",
                'ar' => 'رشيد',
                "state" => "Beheira",
            ],
            [
                "en" => "Al Fashn",
                'ar' => 'الفشن',
                "state" => "Beni Suef",
            ],
            [
                "en" => "Banī Suwayf",
                'ar' => 'بني سويف',
                "state" => "Beni Suef",
            ],
            [
                "en" => "Būsh",
                'ar' => 'بوش',
                "state" => "Beni Suef",
            ],
            [
                "en" => "Sumusţā as Sulţānī",
                'ar' => 'سمسطا السلطان',
                "state" => "Beni Suef",
            ],
            [
                "en" => "Badr",
                'ar' => 'بدر',
                "state" => "Cairo",
            ],
            [
                "en" => "Bulaq",
                'ar' => 'بولاق',
                "state" => "Cairo",
            ],
            [
                "en" => "Cairo",
                'ar' => 'القاهرة',
                "state" => "Cairo",
            ],
            [
                "en" => "El Mataria",
                'ar' => 'المطرية',
                "state" => "Cairo",
            ],
            [
                "en" => "Fustat",
                'ar' => 'الفسطاط',
                "state" => "Cairo",
            ],
            [
                "en" => "Hadayek El Kobba",
                'ar' => 'حدائق القبة',
                "state" => "Cairo",
            ],
            [
                "en" => "Heliopolis",
                'ar' => 'مصر الجديدة',
                "state" => "Cairo",
            ],
            [
                "en" => "Helwan",
                'ar' => 'حلوان',
                "state" => "Cairo",
            ],
            [
                "en" => "Maadi",
                'ar' => 'المعادى',
                "state" => "Cairo",
            ],
            [
                "en" => "Musturud",
                'ar' => 'موسترود',
                "state" => "Cairo",
            ],
            [
                "en" => "New Administrative Capital of Egypt",
                'ar' => 'العاصمة الإدارية الجديدة لمصر',
                "state" => "Cairo",
            ],
            [
                "en" => "Shubra",
                'ar' => 'شبرا',
                "state" => "Cairo",
            ],
            [
                "en" => "Tura",
                'ar' => 'طرة',
                "state" => "Cairo",
            ],
            [
                "en" => "‘Izbat al Burj",
                'ar' => 'عزبة البرج',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Ajā",
                'ar' => 'اجا',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Al Jammālīyah",
                'ar' => 'الجمالية',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Al Manşūrah",
                'ar' => 'المنصورة',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Al Manzalah",
                'ar' => 'المنزلة',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Al Maţarīyah",
                'ar' => 'المعرية',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Bilqās",
                'ar' => 'بلقاس',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Dikirnis",
                'ar' => 'دكرنس',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Minyat an Naşr",
                'ar' => 'منية النصر',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Shirbīn",
                'ar' => 'شربين',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Ţalkhā",
                'ar' => 'طلخا',
                "state" => "Dakahlia",
            ],
            [
                "en" => "Az Zarqā",
                'ar' => 'الزرقاء',
                "state" => "Damietta",
            ],
            [
                "en" => "Damietta",
                'ar' => 'دمياط',
                "state" => "Damietta",
            ],
            [
                "en" => "Fāraskūr",
                'ar' => 'فراسكور',
                "state" => "Damietta",
            ],
            [
                "en" => "Al Fayyūm",
                'ar' => 'الفيوم',
                "state" => "Faiyum",
            ],
            [
                "en" => "Al Wāsiţah",
                'ar' => 'الواسطي',
                "state" => "Faiyum",
            ],
            [
                "en" => "Ibshawāy",
                'ar' => 'إبشاوي',
                "state" => "Faiyum",
            ],
            [
                "en" => "Iţsā",
                'ar' => 'اتسا',
                "state" => "Faiyum",
            ],
            [
                "en" => "Ţāmiyah",
                'ar' => 'تامية',
                "state" => "Faiyum",
            ],
            [
                "en" => "Al Maḩallah al Kubrá",
                'ar' => 'المحلة الكبرى',
                "state" => "Gharbia",
            ],
            [
                "en" => "Basyūn",
                'ar' => 'بسيون',
                "state" => "Gharbia",
            ],
            [
                "en" => "Kafr az Zayyāt",
                'ar' => 'كفر الزيات',
                "state" => "Gharbia",
            ],
            [
                "en" => "Quţūr",
                'ar' => 'قطور',
                "state" => "Gharbia",
            ],
            [
                "en" => "Samannūd",
                'ar' => 'سمنود',
                "state" => "Gharbia",
            ],
            [
                "en" => "Tanda",
                'ar' => 'تاندا',
                "state" => "Gharbia",
            ],
            [
                "en" => "Zefta",
                'ar' => 'زفتى',
                "state" => "Gharbia",
            ],
            [
                "en" => "Al ‘Ayyāţ",
                'ar' => 'العياط',
                "state" => "Giza",
            ],
            [
                "en" => "Al Bawīţī",
                'ar' => 'الباويطي',
                "state" => "Giza",
            ],
            [
                "en" => "Al Ḩawāmidīyah",
                'ar' => 'الحوامدية',
                "state" => "Giza",
            ],
            [
                "en" => "Aş Şaff",
                'ar' => 'الصف',
                "state" => "Giza",
            ],
            [
                "en" => "Awsīm",
                'ar' => 'أوسيم',
                "state" => "Giza",
            ],
            [
                "en" => "Giza",
                'ar' => 'الجيزة',
                "state" => "Giza",
            ],
            [
                "en" => "6th October City",
                'ar' => 'مدينة 6 أكتوبر',
                "state" => "Giza",
            ],
            [
                "en" => "Ismailia",
                'ar' => 'الإسماعيلية',
                "state" => "Ismailia",
            ],
            [
                "en" => "Al Ḩāmūl",
                'ar' => 'الحامول',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Disūq",
                'ar' => 'دسوق',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Fuwwah",
                'ar' => 'فوة',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Kafr ash Shaykh",
                'ar' => 'كفر الشيخ',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Markaz Disūq",
                'ar' => 'مركز دسوق',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Munshāt ‘Alī Āghā",
                'ar' => 'منشأت علي اغا',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Sīdī Sālim",
                'ar' => 'سيدي سالم',
                "state" => "Kafr el-Sheikh",
            ],
            [
                "en" => "Luxor",
                'ar' => 'الأقصر',
                "state" => "Luxor",
            ],
            [
                "en" => "Markaz al Uqşur",
                'ar' => 'مركز الاقصر',
                "state" => "Luxor",
            ],
            [
                "en" => "Al ‘Alamayn",
                'ar' => 'العلمين',
                "state" => "Matrouh",
            ],
            [
                "en" => "Mersa Matruh",
                'ar' => 'مرسى مطروح',
                "state" => "Matrouh",
            ],
            [
                "en" => "Siwa Oasis",
                'ar' => 'واحة سيوة',
                "state" => "Matrouh",
            ],
            [
                "en" => "Abū Qurqāş",
                'ar' => 'ابو قرقاص',
                "state" => "Minya",
            ],
            [
                "en" => "Al Minyā",
                'ar' => 'المنيا',
                "state" => "Minya",
            ],
            [
                "en" => "Banī Mazār",
                'ar' => 'بني مزار',
                "state" => "Minya",
            ],
            [
                "en" => "Dayr Mawās",
                'ar' => 'دير مواس',
                "state" => "Minya",
            ],
            [
                "en" => "Mallawī",
                'ar' => 'ملوي',
                "state" => "Minya",
            ],
            [
                "en" => "Maţāy",
                'ar' => 'مطاي',
                "state" => "Minya",
            ],
            [
                "en" => "Samālūţ",
                'ar' => 'سمالوط',
                "state" => "Minya",
            ],
            [
                "en" => "Al Bājūr",
                'ar' => 'الباجور',
                "state" => "Monufia",
            ],
            [
                "en" => "Ash Shuhadā’",
                'ar' => 'الشهداء',
                "state" => "Monufia",
            ],
            [
                "en" => "Ashmūn",
                'ar' => 'أشمون',
                "state" => "Monufia",
            ],
            [
                "en" => "Munūf",
                'ar' => 'منيف',
                "state" => "Monufia",
            ],
            [
                "en" => "Quwaysinā",
                'ar' => 'قويسنا',
                "state" => "Monufia",
            ],
            [
                "en" => "Shibīn al Kawm",
                'ar' => 'شبين الكوم',
                "state" => "Monufia",
            ],
            [
                "en" => "Talā",
                'ar' => 'تلا',
                "state" => "Monufia",
            ],
            [
                "en" => "Al Khārijah",
                'ar' => 'الخارجة',
                "state" => "New Valley",
            ],
            [
                "en" => "Qaşr al Farāfirah",
                'ar' => 'قصر الفرافرة',
                "state" => "New Valley",
            ],
            [
                "en" => "Arish",
                'ar' => 'العريش',
                "state" => "North Sinai",
            ],
            [
                "en" => "Port Said",
                'ar' => 'بورسعيد',
                "state" => "Port Said",
            ],
            [
                "en" => "Al Khānkah",
                'ar' => 'الخانكة',
                "state" => "Qalyubia",
            ],
            [
                "en" => "Al Qanāţir al Khayrīyah",
                'ar' => 'القناطر الخيرية',
                "state" => "Qalyubia",
            ],
            [
                "en" => "Banhā",
                'ar' => 'بنها',
                "state" => "Qalyubia",
            ],
            [
                "en" => "Qalyūb",
                'ar' => 'قليوب',
                "state" => "Qalyubia",
            ],
            [
                "en" => "Shibīn al Qanāṭir",
                'ar' => 'شبين القناطر',
                "state" => "Qalyubia",
            ],
            [
                "en" => "Toukh",
                'ar' => 'طوخ',
                "state" => "Qalyubia",
            ],
            [
                "en" => "Dishnā",
                'ar' => 'دشنا',
                "state" => "Qena",
            ],
            [
                "en" => "Farshūţ",
                'ar' => 'فرشوط',
                "state" => "Qena",
            ],
            [
                "en" => "Isnā",
                'ar' => 'إسنا',
                "state" => "Qena",
            ],
            [
                "en" => "Kousa",
                'ar' => 'كوسا',
                "state" => "Qena",
            ],
            [
                "en" => "Naja' Ḥammādī",
                'ar' => 'نجا حمدي',
                "state" => "Qena",
            ],
            [
                "en" => "Qinā",
                'ar' => 'قنا',
                "state" => "Qena",
            ],
            [
                "en" => "Al Quşayr",
                'ar' => 'القصير',
                "state" => "Red Sea",
            ],
            [
                "en" => "El Gouna",
                'ar' => 'الجونة',
                "state" => "Red Sea",
            ],
            [
                "en" => "Hurghada",
                'ar' => 'الغردقة',
                "state" => "Red Sea",
            ],
            [
                "en" => "Makadi Bay",
                'ar' => 'خليج مكادي',
                "state" => "Red Sea",
            ],
            [
                "en" => "Marsa Alam",
                'ar' => 'مرسى علم',
                "state" => "Red Sea",
            ],
            [
                "en" => "Ras Gharib",
                'ar' => 'رأس غريب',
                "state" => "Red Sea",
            ],
            [
                "en" => "Safaga",
                'ar' => 'سفاجا',
                "state" => "Red Sea",
            ],
            [
                "en" => "10th of Ramadan",
                'ar' => 'العاشر من رمضان',
                "state" => "Sharqia",
            ],
            [
                "en" => "Al Qurein",
                'ar' => 'القرين',
                "state" => "Sharqia",
            ],
            [
                "en" => "Awlad Saqr",
                'ar' => 'اولاد صقر',
                "state" => "Sharqia",
            ],
            [
                "en" => "Bilbeis",
                'ar' => 'بلبيس',
                "state" => "Sharqia",
            ],
            [
                "en" => "Diyarb Negm",
                'ar' => 'ديارب نجم',
                "state" => "Sharqia",
            ],
            [
                "en" => "El Husseiniya",
                'ar' => 'الحسينية',
                "state" => "Sharqia",
            ],
            [
                "en" => "Faqous",
                'ar' => 'فاقوس',
                "state" => "Sharqia",
            ],
            [
                "en" => "Hihya",
                'ar' => 'هيهيا',
                "state" => "Sharqia",
            ],
            [
                "en" => "Kafr Saqr",
                'ar' => 'كفر صقر',
                "state" => "Sharqia",
            ],
            [
                "en" => "Markaz Abū Ḩammād",
                'ar' => 'مركز أبو حمد',
                "state" => "Sharqia",
            ],
            [
                "en" => "Mashtoul El Souk",
                'ar' => 'مشتول السوق',
                "state" => "Sharqia",
            ],
            [
                "en" => "Minya El Qamh",
                'ar' => 'منيا القمح',
                "state" => "Sharqia",
            ],
            [
                "en" => "New Salhia",
                'ar' => 'الصالحية الجديدة',
                "state" => "Sharqia",
            ],
            [
                "en" => "Zagazig",
                'ar' => 'الزقازيق',
                "state" => "Sharqia",
            ],
            [
                "en" => "Akhmīm",
                'ar' => 'أخميم',
                "state" => "Sohag",
            ],
            [
                "en" => "Al Balyanā",
                'ar' => 'البلينا',
                "state" => "Sohag",
            ],
            [
                "en" => "Al Manshāh",
                'ar' => 'المنشاه',
                "state" => "Sohag",
            ],
            [
                "en" => "Jirjā",
                'ar' => 'جرجا',
                "state" => "Sohag",
            ],
            [
                "en" => "Juhaynah",
                'ar' => 'جهينة',
                "state" => "Sohag",
            ],
            [
                "en" => "Markaz Jirjā",
                'ar' => 'مركز جرجا',
                "state" => "Sohag",
            ],
            [
                "en" => "Markaz Sūhāj",
                'ar' => 'مركز سهاج',
                "state" => "Sohag",
            ],
            [
                "en" => "Sohag",
                'ar' => 'سوهاج',
                "state" => "Sohag",
            ],
            [
                "en" => "Ţahţā",
                'ar' => 'طهطا',
                "state" => "Sohag",
            ],
            [
                "en" => "Dahab",
                'ar' => 'دهب',
                "state" => "South Sinai",
            ],
            [
                "en" => "El-Tor",
                'ar' => 'الطور',
                "state" => "South Sinai",
            ],
            [
                "en" => "Nuwaybi‘a",
                'ar' => 'النويبع',
                "state" => "South Sinai",
            ],
            [
                "en" => "Saint Catherine",
                'ar' => 'سانت كاترين',
                "state" => "South Sinai",
            ],
            [
                "en" => "Sharm el-Sheikh",
                'ar' => 'شرم الشيخ',
                "state" => "South Sinai",
            ],
            [
                "en" => "Ain Sukhna",
                'ar' => 'العين السخنة',
                "state" => "Suez",
            ],
            [
                "en" => "Suez",
                'ar' => 'السويس',
                "state" => "Suez",
            ],
            [
                "en" => "Abha",
                'ar' => 'أبها',
                "state" => "Asir",
            ],
            [
                "en" => "Al Majāridah",
                'ar' => 'المجردة',
                "state" => "Asir",
            ],
            [
                "en" => "Al Qahab",
                'ar' => 'القحاب',
                "state" => "Asir",
            ],
            [
                "en" => "Khamis Mushait",
                'ar' => 'خميس مشيط',
                "state" => "Asir",
            ],
            [
                "en" => "Ma`riyah",
                'ar' => 'معرية',
                "state" => "Asir",
            ],
            [
                "en" => "Mifa",
                'ar' => 'ميفا',
                "state" => "Asir",
            ],
            [
                "en" => "Munayzir",
                'ar' => 'منيرز',
                "state" => "Asir",
            ],
            [
                "en" => "Tabālah",
                'ar' => 'طبالة',
                "state" => "Asir",
            ],
            [
                "en" => "Al Bahah",
                'ar' => 'الباحة',
                "state" => "Al Bahah",
            ],
            [
                "en" => "Al Mindak",
                'ar' => 'المينداك',
                "state" => "Al Bahah",
            ],
            [
                "en" => "Hajrah",
                'ar' => 'هجرة',
                "state" => "Al Bahah",
            ],
            [
                "en" => "Al Isawiyah",
                'ar' => 'العيسوية',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Al-Haditha",
                'ar' => 'الحديثة',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Halat Ammar",
                'ar' => 'حالة عمار',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Qurayyat",
                'ar' => 'قريات',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Sakakah",
                'ar' => 'سكاكا',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Şuwayr",
                'ar' => 'طوير',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Tabarjal",
                'ar' => 'طبرجل',
                "state" => "Al Jawf",
            ],
            [
                "en" => "Ţubarjal",
                'ar' => 'طبرجل',
                "state" => "Al Jawf",
            ],
            [
                "en" => "`Ajmiyah",
                'ar' => 'العجمية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "`Alya'",
                'ar' => 'علياء',
                "state" => "Al Madinah",
            ],
            [
                "en" => "`Ushash",
                'ar' => 'أوشاش',
                "state" => "Al Madinah",
            ],
            [
                "en" => "`Ushayrah",
                'ar' => 'عشيرة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Abū Shayţānah",
                'ar' => 'أبو شيطان',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Abyar 'Ali",
                'ar' => 'أبيار علي',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Ad Dulu`",
                'ar' => 'Ad Dulu`',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al `Awali",
                'ar' => 'العوالي',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al `Uqul",
                'ar' => 'العقول',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Akhal",
                'ar' => 'الأكحل',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Bardiyah",
                'ar' => 'البردية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Biqa'",
                'ar' => 'البقاع',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Bustan",
                'ar' => 'البستان',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Faqirah",
                'ar' => 'الفقيرة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Furaysh",
                'ar' => 'الفريش',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Jabriyah",
                'ar' => 'الجابرية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Jissah",
                'ar' => 'الجصة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Kharma'",
                'ar' => 'الخرمة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Malbanah",
                'ar' => 'الملبنة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Mufrihat",
                'ar' => 'المفريات',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Multasa",
                'ar' => 'الملتقى',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Musayjid",
                'ar' => 'المسجيد',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al Wuday",
                'ar' => 'الودي',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al-Jafr",
                'ar' => 'الجفر',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Al-Ula",
                'ar' => 'العلا',
                "state" => "Al Madinah",
            ],
            [
                "en" => "As Sadayir",
                'ar' => 'السداير',
                "state" => "Al Madinah",
            ],
            [
                "en" => "As Safra'",
                'ar' => 'العصافرة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "As Sumariyah",
                'ar' => 'السومرية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "As Suwayriqiyah",
                'ar' => 'السويرقية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Ash Shufayyah",
                'ar' => 'الشفية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Asira",
                'ar' => 'عصيرة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Baq`a'",
                'ar' => 'البقعة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Bartiyah",
                'ar' => 'برطية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Bi'r al Mashi",
                'ar' => 'بير الماشي',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Birkah",
                'ar' => 'بيركة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Far`",
                'ar' => 'Far`',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Fiji",
                'ar' => 'فيجي',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Harthiyah",
                'ar' => 'الحارثية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Haylat Radi al Baham",
                'ar' => 'حياة راضي البهام',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Husayniyah",
                'ar' => 'الحسينية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Jadidah",
                'ar' => 'الجديدة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Khayf Fadil",
                'ar' => 'خيف فاضل',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Madsus",
                'ar' => 'مادسوس',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Mahattat al Hafah",
                'ar' => 'محطة الحفة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Maqrah",
                'ar' => 'مقرة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Maqshush",
                'ar' => 'مقشش',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Masahili",
                'ar' => 'مساحيلي',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Mawarah",
                'ar' => 'المواره',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Medina",
                'ar' => 'المدينة المنورة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Milhah",
                'ar' => 'ملحة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Nujayl",
                'ar' => 'نجيل',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Qaba'",
                'ar' => 'قباء',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Rayyis",
                'ar' => 'الريس',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Sha`tha'",
                'ar' => 'شعثه',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Sidi Hamzah",
                'ar' => 'سيدي حمزة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Suq Suwayq",
                'ar' => 'سوق سويق',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Suqubiya",
                'ar' => 'السقبية',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Suwadah",
                'ar' => 'سوادة',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Wasitah",
                'ar' => 'واسطه',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Yanbu",
                'ar' => 'ينبع',
                "state" => "Al Madinah",
            ],
            [
                "en" => "Adh Dhibiyah",
                'ar' => 'الظبية',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Al Bukayrīyah",
                'ar' => 'البكيرية',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Al Fuwayliq",
                'ar' => 'الفويلق',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Al Mithnab",
                'ar' => 'المذنب',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Al Thybiyah",
                'ar' => 'الذبية',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Ar Rass",
                'ar' => 'الرس',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Buraidah",
                'ar' => 'بريدة',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Buraydah",
                'ar' => 'بريدة',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Dukhnah",
                'ar' => 'الدخنة',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Qiba",
                'ar' => 'قباء',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Tanūmah",
                'ar' => 'تنومة',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Wed Alnkil",
                'ar' => 'ود النكيل',
                "state" => "Al-Qassim",
            ],
            [
                "en" => "Abqaiq",
                'ar' => 'بقيق',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Awjām",
                'ar' => 'الأوجام',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Baţţālīyah",
                'ar' => 'البعلية',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Hufūf",
                'ar' => 'الهفوف',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Jafr",
                'ar' => 'الجفر',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Jubayl",
                'ar' => 'الجبيل',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Khafjī",
                'ar' => 'الخفجي',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Markaz",
                'ar' => 'المركز',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Mubarraz",
                'ar' => 'المبرز',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Munayzilah",
                'ar' => 'المنييلة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Muţayrifī",
                'ar' => 'المريفي',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Qārah",
                'ar' => 'القراح',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Qaţīf",
                'ar' => 'القيف',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Qurayn",
                'ar' => 'القرين',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al Ubaylah",
                'ar' => 'العبيلة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al-Awamiyah",
                'ar' => 'العوامية',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al-Awjam",
                'ar' => 'الاوجام',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Al-Mubarraz",
                'ar' => 'المبرز',
                "state" => "Eastern Province",
            ],
            [
                "en" => "As Saffānīyah",
                'ar' => 'السفانية',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Aţ Ţaraf",
                'ar' => 'عارف',
                "state" => "Eastern Province",
            ],
            [
                "en" => "At Tūbī",
                'ar' => 'في توبي',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Dammam",
                'ar' => 'الدمام',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Dhahran",
                'ar' => 'الظهران',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Ha'il ",
                'ar' => 'وابل',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Hafar Al-Batin",
                'ar' => 'حفر الباطن',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Haradh",
                'ar' => 'حرض',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Julayjilah",
                'ar' => 'جليجلة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Khobar",
                'ar' => 'مدينه الخبر',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Mulayjah",
                'ar' => 'مليجة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Nariyah",
                'ar' => 'نارية',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Qaisumah",
                'ar' => 'القيصومة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Raḩīmah",
                'ar' => 'رئمة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Şafwá",
                'ar' => 'صفوة',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Sayhāt",
                'ar' => 'سيهات',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Tārūt",
                'ar' => 'تارات',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Udhailiyah",
                'ar' => 'العضيلية',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Umm as Sāhik",
                'ar' => 'أم الساحق',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Uqair",
                'ar' => 'العقير',
                "state" => "Eastern Province",
            ],
            [
                "en" => "Jubbah",
                'ar' => 'جبة',
                "state" => "Ha'il",
            ],
            [
                "en" => "Mawqaq",
                'ar' => 'موقق',
                "state" => "Ha'il",
            ],
            [
                "en" => "Qufar",
                'ar' => 'قفر',
                "state" => "Ha'il",
            ],
            [
                "en" => "Simira",
                'ar' => 'سيميرا',
                "state" => "Ha'il",
            ],
            [
                "en" => "Abū ‘Arīsh",
                'ar' => 'أبو العريش',
                "state" => "Jizan",
            ],
            [
                "en" => "Abu Radif",
                'ar' => 'ابو رديف',
                "state" => "Jizan",
            ],
            [
                "en" => "Ad Darb",
                'ar' => 'Ad Darb',
                "state" => "Jizan",
            ],
            [
                "en" => "Ad Dur`iyah",
                'ar' => 'الدرعية',
                "state" => "Jizan",
            ],
            [
                "en" => "Adh Dhagharir",
                'ar' => 'Adh Dhagharir',
                "state" => "Jizan",
            ],
            [
                "en" => "Al `Ulayin",
                'ar' => 'العليّين',
                "state" => "Jizan",
            ],
            [
                "en" => "Al `Usaylah",
                'ar' => 'الأصيلة',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Badawi",
                'ar' => 'البدوي',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Hadrur",
                'ar' => 'الحضرور',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Hanashah",
                'ar' => 'الحناشة',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Harani",
                'ar' => 'الهاراني',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Hasamah",
                'ar' => 'الحسامه',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Hijfar",
                'ar' => 'الحجفر',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Jadi",
                'ar' => 'الجدي',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Jarādīyah",
                'ar' => 'الجرادية',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Jawah",
                'ar' => 'الجواه',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Jirbah",
                'ar' => 'الجربة',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Karbus",
                'ar' => 'الكاربس',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Kawahilah",
                'ar' => 'الكواحلة',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Khadra' Jizan",
                'ar' => 'الخضراء جيزان',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Kharabah Jizan",
                'ar' => 'الخرابة جيزان',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Kharadilah",
                'ar' => 'الخراديلة',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Khashabiyah",
                'ar' => 'الخشابية',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Khubah",
                'ar' => 'الخوبة',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Kirs",
                'ar' => 'القرس',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Luqiyah",
                'ar' => 'اللقية',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Ma`ayin",
                'ar' => 'المعاين',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Madaya",
                'ar' => 'المضايا',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Mali",
                'ar' => 'مالي',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Mayasam",
                'ar' => 'المياسم',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Qa'im",
                'ar' => 'القائم',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Quful",
                'ar' => 'الكوفول',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Qurayb",
                'ar' => 'القريب',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Quwah",
                'ar' => 'القوه',
                "state" => "Jizan",
            ],
            [
                "en" => "Al Wasili",
                'ar' => 'الواصلي',
                "state" => "Jizan",
            ],
            [
                "en" => "An Najamiyah",
                'ar' => 'النجامية',
                "state" => "Jizan",
            ],
            [
                "en" => "Ar Rukubah",
                'ar' => 'الركوبة',
                "state" => "Jizan",
            ],
            [
                "en" => "Ash Shuqayq",
                'ar' => 'الشقيق',
                "state" => "Jizan",
            ],
            [
                "en" => "Bakhshat Yamani",
                'ar' => 'بخشات يماني',
                "state" => "Jizan",
            ],
            [
                "en" => "Farasān",
                'ar' => 'فرسان',
                "state" => "Jizan",
            ],
            [
                "en" => "Ghawiyah",
                'ar' => 'الغاوية',
                "state" => "Jizan",
            ],
            [
                "en" => "Hamayyah",
                'ar' => 'حمايه',
                "state" => "Jizan",
            ],
            [
                "en" => "Hamdah",
                'ar' => 'حمده',
                "state" => "Jizan",
            ],
            [
                "en" => "Jizan",
                'ar' => 'جيزان',
                "state" => "Jizan",
            ],
            [
                "en" => "Juha Saudi Arabia",
                'ar' => 'جحا السعودية',
                "state" => "Jizan",
            ],
            [
                "en" => "Ka`lul",
                'ar' => 'كاولول',
                "state" => "Jizan",
            ],
            [
                "en" => "Khabath Sa`id",
                'ar' => 'خباث سعيد',
                "state" => "Jizan",
            ],
            [
                "en" => "Khalfah",
                'ar' => 'خلفه',
                "state" => "Jizan",
            ],
            [
                "en" => "Khatib Saudi Arabia",
                'ar' => 'الخطيب السعودية',
                "state" => "Jizan",
            ],
            [
                "en" => "Khumsiyah",
                'ar' => 'خمصية',
                "state" => "Jizan",
            ],
            [
                "en" => "Khushaym",
                'ar' => 'خشيم',
                "state" => "Jizan",
            ],
            [
                "en" => "Mahatah",
                'ar' => 'المحطة',
                "state" => "Jizan",
            ],
            [
                "en" => "Malgocta",
                'ar' => 'مالجوكتا',
                "state" => "Jizan",
            ],
            [
                "en" => "Mislīyah",
                'ar' => 'ميسلية',
                "state" => "Jizan",
            ],
            [
                "en" => "Mizhirah",
                'ar' => 'المزهرة',
                "state" => "Jizan",
            ],
            [
                "en" => "Mukambal",
                'ar' => 'موكامبال',
                "state" => "Jizan",
            ],
            [
                "en" => "Mundaraq",
                'ar' => 'مندرق',
                "state" => "Jizan",
            ],
            [
                "en" => "Muwassam",
                'ar' => 'مواسم',
                "state" => "Jizan",
            ],
            [
                "en" => "Qitabir",
                'ar' => 'Qitabir',
                "state" => "Jizan",
            ],
            [
                "en" => "Quwayda'",
                'ar' => 'قويدا',
                "state" => "Jizan",
            ],
            [
                "en" => "Rahwan",
                'ar' => 'رهوان',
                "state" => "Jizan",
            ],
            [
                "en" => "Rawkhah",
                'ar' => 'روعة',
                "state" => "Jizan",
            ],
            [
                "en" => "Şabyā",
                'ar' => 'صبيا',
                "state" => "Jizan",
            ],
            [
                "en" => "Sadiliyah",
                'ar' => 'السديلية',
                "state" => "Jizan",
            ],
            [
                "en" => "Salamah",
                'ar' => 'سلامة',
                "state" => "Jizan",
            ],
            [
                "en" => "Şāmitah",
                'ar' => 'عميتة',
                "state" => "Jizan",
            ],
            [
                "en" => "Abu `Urwah",
                'ar' => 'أبو عروة',
                "state" => "Makkah",
            ],
            [
                "en" => "Abu Hisani",
                'ar' => 'ابو حصني',
                "state" => "Makkah",
            ],
            [
                "en" => "Abu Qirfah",
                'ar' => 'أبو قرفه',
                "state" => "Makkah",
            ],
            [
                "en" => "Abu Shu`ayb",
                'ar' => 'ابو شعيب',
                "state" => "Makkah",
            ],
            [
                "en" => "Ad Dabbah",
                'ar' => 'الضباح',
                "state" => "Makkah",
            ],
            [
                "en" => "Ad Dawh",
                'ar' => 'Ad Dawh',
                "state" => "Makkah",
            ],
            [
                "en" => "Ad Dur",
                'ar' => 'Ad Dur',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ābār",
                'ar' => 'الصبار',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Adl",
                'ar' => 'العدل',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ashraf",
                'ar' => 'الأشراف',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Balad",
                'ar' => 'البلد',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Barabir",
                'ar' => 'البرابير',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Bi'ar",
                'ar' => 'البيعر',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Birk",
                'ar' => 'البرك',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Buraykah",
                'ar' => 'البريكة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Fawwarah",
                'ar' => 'الفوارة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Faydah",
                'ar' => 'الفيضة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Fazz",
                'ar' => 'الفز',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Gharith",
                'ar' => 'الغارث',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ghassalah",
                'ar' => 'الغسالة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ghulah",
                'ar' => 'الغولة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Hadā",
                'ar' => 'الهدى',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Halaqah",
                'ar' => 'الحلاقة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Hamimah",
                'ar' => 'الحميمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Harra' Makkah",
                'ar' => 'الحراء مكة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Hawiyah",
                'ar' => 'الحوية',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Iskan",
                'ar' => 'الاسكان',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Jadidah",
                'ar' => 'الجديدة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Jami`ah",
                'ar' => 'الجامعة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Jid`",
                'ar' => 'Al Jid`',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ju`ranah",
                'ar' => 'الجعرانة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Jumūm",
                'ar' => 'الجموم',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Khadra' Makkah",
                'ar' => 'الخضراء مكة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Khalas",
                'ar' => 'الخلاص',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Khamrah",
                'ar' => 'الخمرة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Khaydar",
                'ar' => 'الخيدر',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Khayf",
                'ar' => 'الخيف',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Khulasah",
                'ar' => 'الخلاصة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Kidwah",
                'ar' => 'القدوة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Kura`",
                'ar' => 'الكراع',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ma`rash",
                'ar' => 'المعارش',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Madiq Makkah",
                'ar' => 'المضيق مكة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Maghal",
                'ar' => 'المغل',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mahjar",
                'ar' => 'المحجر',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Maqrah",
                'ar' => 'المقرح',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Masarrah",
                'ar' => 'المسرة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Masfalah",
                'ar' => 'المسفلة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mashayikh",
                'ar' => 'المشايخ',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mathnah",
                'ar' => 'المثنة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mubarak",
                'ar' => 'المبارك',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mudawwarah",
                'ar' => 'المدورة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mulayha'",
                'ar' => 'المليحة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Mundassah",
                'ar' => 'المندسة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Muqayti`",
                'ar' => 'المقيتي',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Muqr",
                'ar' => 'المقر',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Muwayh",
                'ar' => 'المويه',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qadimah",
                'ar' => 'القديمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qararah",
                'ar' => 'القرارة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qaryat",
                'ar' => 'القريات',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qawba`iyah",
                'ar' => 'القوبعية',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qirshan",
                'ar' => 'القرشان',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qu`tubah",
                'ar' => 'القبطبة',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qufayf",
                'ar' => 'القفيف',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Qushashiyah",
                'ar' => 'القششية',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Ukhaydir",
                'ar' => 'الأخيضر',
                "state" => "Makkah",
            ],
            [
                "en" => "Al Waht",
                'ar' => 'الوحط',
                "state" => "Makkah",
            ],
            [
                "en" => "Ar Rabwah as Sufla",
                'ar' => 'الربوة as Sufla',
                "state" => "Makkah",
            ],
            [
                "en" => "Ar Rafah",
                'ar' => 'رفح',
                "state" => "Makkah",
            ],
            [
                "en" => "Ar Rawdah ash Shamaliyah",
                'ar' => 'الروضة الشمالية',
                "state" => "Makkah",
            ],
            [
                "en" => "Ar Rudaymah",
                'ar' => 'الرديمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Arya`",
                'ar' => 'آريا',
                "state" => "Makkah",
            ],
            [
                "en" => "As Sadr",
                'ar' => 'الصدر',
                "state" => "Makkah",
            ],
            [
                "en" => "As Samd ash Shamali",
                'ar' => 'الصمد الشمالي',
                "state" => "Makkah",
            ],
            [
                "en" => "As Sayl al Kabir",
                'ar' => 'السيل الكبير',
                "state" => "Makkah",
            ],
            [
                "en" => "As Sayl as Saghir",
                'ar' => 'السيل الصغير',
                "state" => "Makkah",
            ],
            [
                "en" => "As Sifyani",
                'ar' => 'كما سيفاني',
                "state" => "Makkah",
            ],
            [
                "en" => "As Sudayrah Makkah",
                'ar' => 'كسديرة مكة',
                "state" => "Makkah",
            ],
            [
                "en" => "As Suwadah",
                'ar' => 'السوادة',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shafā",
                'ar' => 'الشفا',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shajwah",
                'ar' => 'الشجوة',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shamiyah",
                'ar' => 'الشامية',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shara'i`",
                'ar' => 'الشرعي',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shaybi",
                'ar' => 'الشعيبي',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shi`b",
                'ar' => 'الشعيب',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shishah",
                'ar' => 'الشيشة',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shumaysi",
                'ar' => 'الشّميسي',
                "state" => "Makkah",
            ],
            [
                "en" => "Ash Shuwaybit",
                'ar' => 'الرماد شويبت',
                "state" => "Makkah",
            ],
            [
                "en" => "At Tan`im",
                'ar' => 'التنعيم',
                "state" => "Makkah",
            ],
            [
                "en" => "At Tarfa'",
                'ar' => 'الطرفة',
                "state" => "Makkah",
            ],
            [
                "en" => "At Turqi",
                'ar' => 'في التركى',
                "state" => "Makkah",
            ],
            [
                "en" => "Az Zaymah",
                'ar' => 'Az Zaymah',
                "state" => "Makkah",
            ],
            [
                "en" => "Az Zilal",
                'ar' => 'الزلال',
                "state" => "Makkah",
            ],
            [
                "en" => "Az Zughbah",
                'ar' => 'الزغبة',
                "state" => "Makkah",
            ],
            [
                "en" => "Az Zurra`",
                'ar' => 'الزرة',
                "state" => "Makkah",
            ],
            [
                "en" => "Az Zuwayb",
                'ar' => 'الزويب',
                "state" => "Makkah",
            ],
            [
                "en" => "Bahrat al Qadimah",
                'ar' => 'بحرة القديمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Bahwil",
                'ar' => 'باهويل',
                "state" => "Makkah",
            ],
            [
                "en" => "Baranah",
                'ar' => 'برانة',
                "state" => "Makkah",
            ],
            [
                "en" => "Barzah",
                'ar' => 'برزة',
                "state" => "Makkah",
            ],
            [
                "en" => "Bashm",
                'ar' => 'بشم',
                "state" => "Makkah",
            ],
            [
                "en" => "Buraykah",
                'ar' => 'البريكة',
                "state" => "Makkah",
            ],
            [
                "en" => "Burayman",
                'ar' => 'بريمان',
                "state" => "Makkah",
            ],
            [
                "en" => "CITY GHRAN",
                'ar' => 'مدينة غران',
                "state" => "Makkah",
            ],
            [
                "en" => "Dabyah",
                'ar' => 'دبية',
                "state" => "Makkah",
            ],
            [
                "en" => "Dahaban",
                'ar' => 'ذهبان',
                "state" => "Makkah",
            ],
            [
                "en" => "Dughaybjah",
                'ar' => 'الدغيبة',
                "state" => "Makkah",
            ],
            [
                "en" => "Fayd",
                'ar' => 'فيض',
                "state" => "Makkah",
            ],
            [
                "en" => "Ghran",
                'ar' => 'غران',
                "state" => "Makkah",
            ],
            [
                "en" => "Hadda'",
                'ar' => 'حداء',
                "state" => "Makkah",
            ],
            [
                "en" => "Haddat ash Sham",
                'ar' => 'حدت الشام',
                "state" => "Makkah",
            ],
            [
                "en" => "Hadhah",
                'ar' => 'حضة',
                "state" => "Makkah",
            ],
            [
                "en" => "Hajur",
                'ar' => 'هاجور',
                "state" => "Makkah",
            ],
            [
                "en" => "Halamah",
                'ar' => 'هلمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Husnah",
                'ar' => 'حسنة',
                "state" => "Makkah",
            ],
            [
                "en" => "Jarwal",
                'ar' => 'جاروال',
                "state" => "Makkah",
            ],
            [
                "en" => "Jeddah",
                'ar' => 'جدة',
                "state" => "Makkah",
            ],
            [
                "en" => "Julayyil",
                'ar' => 'جليل',
                "state" => "Makkah",
            ],
            [
                "en" => "Khumrah",
                'ar' => 'خمرة',
                "state" => "Makkah",
            ],
            [
                "en" => "Kulakh",
                'ar' => 'كولاخ',
                "state" => "Makkah",
            ],
            [
                "en" => "Madrakah",
                'ar' => 'مدركة',
                "state" => "Makkah",
            ],
            [
                "en" => "Mafruq",
                'ar' => 'المفرق',
                "state" => "Makkah",
            ],
            [
                "en" => "Malakan",
                'ar' => 'ملكان',
                "state" => "Makkah",
            ],
            [
                "en" => "Mashajji",
                'ar' => 'مشاجي',
                "state" => "Makkah",
            ],
            [
                "en" => "Masihat Mahd al Hayl",
                'ar' => 'مسيحات مهد الحيل',
                "state" => "Makkah",
            ],
            [
                "en" => "Maskar",
                'ar' => 'مسكر',
                "state" => "Makkah",
            ],
            [
                "en" => "Matiyah",
                'ar' => 'المطية',
                "state" => "Makkah",
            ],
            [
                "en" => "Mecca",
                'ar' => 'مكة المكرمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Mina",
                'ar' => 'مينا',
                "state" => "Makkah",
            ],
            [
                "en" => "Murshidiyah",
                'ar' => 'المرشدية',
                "state" => "Makkah",
            ],
            [
                "en" => "Mushrif",
                'ar' => 'مشرف',
                "state" => "Makkah",
            ],
            [
                "en" => "Nughayshiyah",
                'ar' => 'النغيشية',
                "state" => "Makkah",
            ],
            [
                "en" => "Nuzlat al Faqin",
                'ar' => 'نزلة الفقين',
                "state" => "Makkah",
            ],
            [
                "en" => "Qiya",
                'ar' => 'كيا',
                "state" => "Makkah",
            ],
            [
                "en" => "Quwayzah",
                'ar' => 'قويزة',
                "state" => "Makkah",
            ],
            [
                "en" => "Rābigh",
                'ar' => 'رابيغ',
                "state" => "Makkah",
            ],
            [
                "en" => "Rabwah Ghran",
                'ar' => 'ربوة غران',
                "state" => "Makkah",
            ],
            [
                "en" => "Raqiyah",
                'ar' => 'الرقية',
                "state" => "Makkah",
            ],
            [
                "en" => "Sabuhah",
                'ar' => 'صبحه',
                "state" => "Makkah",
            ],
            [
                "en" => "Shi`b `amir",
                'ar' => 'شيب أمير',
                "state" => "Makkah",
            ],
            [
                "en" => "Shira`ayn",
                'ar' => 'شراعين',
                "state" => "Makkah",
            ],
            [
                "en" => "Sulaym",
                'ar' => 'سليم',
                "state" => "Makkah",
            ],
            [
                "en" => "Sumaymah",
                'ar' => 'سميمة',
                "state" => "Makkah",
            ],
            [
                "en" => "Suways",
                'ar' => 'Suways',
                "state" => "Makkah",
            ],
            [
                "en" => "Ta'if",
                'ar' => 'الطائف',
                "state" => "Makkah",
            ],
            [
                "en" => "Tharwah",
                'ar' => 'ثروة',
                "state" => "Makkah",
            ],
            [
                "en" => "Thuwal",
                'ar' => 'ثول',
                "state" => "Makkah",
            ],
            [
                "en" => "Turabah",
                'ar' => 'تورابة',
                "state" => "Makkah",
            ],
            [
                "en" => "Usfan",
                'ar' => 'عسفان',
                "state" => "Makkah",
            ],
            [
                "en" => "Wadi al Jalil",
                'ar' => 'وادي الجليل',
                "state" => "Makkah",
            ],
            [
                "en" => "Najrān",
                'ar' => 'نجران',
                "state" => "Najran",
            ],
            [
                "en" => "Arar",
                'ar' => 'عرعر',
                "state" => "Northern Borders",
            ],
            [
                "en" => "Nisab",
                'ar' => 'نصاب',
                "state" => "Northern Borders",
            ],
            [
                "en" => "Turaif",
                'ar' => 'طريف',
                "state" => "Northern Borders",
            ],
            [
                "en" => "Umm Radamah",
                'ar' => 'أم رضومة',
                "state" => "Northern Borders",
            ],
            [
                "en" => "Ad Dawādimī",
                'ar' => 'الدوادمي',
                "state" => "Riyadh",
            ],
            [
                "en" => "Ad Dilam",
                'ar' => 'الدلم',
                "state" => "Riyadh",
            ],
            [
                "en" => "Afif",
                'ar' => 'عفيف',
                "state" => "Riyadh",
            ],
            [
                "en" => "Ain AlBaraha",
                'ar' => 'عين البراحة',
                "state" => "Riyadh",
            ],
            [
                "en" => "Al Arţāwīyah",
                'ar' => 'العروحية',
                "state" => "Riyadh",
            ],
            [
                "en" => "Al Bir",
                'ar' => 'البير',
                "state" => "Riyadh",
            ],
            [
                "en" => "Al Hair",
                'ar' => 'الشعر',
                "state" => "Riyadh",
            ],
            [
                "en" => "Al Jurayfah",
                'ar' => 'الجريفة',
                "state" => "Riyadh",
            ],
            [
                "en" => "Al Kharj",
                'ar' => 'الخرج',
                "state" => "Riyadh",
            ],
            [
                "en" => "Ar Rayn",
                'ar' => 'Ar Rayn',
                "state" => "Riyadh",
            ],
            [
                "en" => "As Salamiyah",
                'ar' => 'السلمية',
                "state" => "Riyadh",
            ],
            [
                "en" => "As Sulayyil",
                'ar' => 'السليل',
                "state" => "Riyadh",
            ],
            [
                "en" => "Az Zulfī",
                'ar' => 'الزلفي',
                "state" => "Riyadh",
            ],
            [
                "en" => "Dawadmi",
                'ar' => 'الدوادمي',
                "state" => "Riyadh",
            ],
            [
                "en" => "Diriyah",
                'ar' => 'الدرعية',
                "state" => "Riyadh",
            ],
            [
                "en" => "Harmah",
                'ar' => 'حرمة',
                "state" => "Riyadh",
            ],
            [
                "en" => "Jalajil",
                'ar' => 'جلاجل',
                "state" => "Riyadh",
            ],
            [
                "en" => "Layla",
                'ar' => 'ليلى',
                "state" => "Riyadh",
            ],
            [
                "en" => "Manfuha",
                'ar' => 'منفوحة',
                "state" => "Riyadh",
            ],
            [
                "en" => "Marāt",
                'ar' => 'مارات',
                "state" => "Riyadh",
            ],
            [
                "en" => "Najan",
                'ar' => 'نجان',
                "state" => "Riyadh",
            ],
            [
                "en" => "Riyadh",
                'ar' => 'الرياض',
                "state" => "Riyadh",
            ],
            [
                "en" => "Sājir",
                'ar' => 'ساجير',
                "state" => "Riyadh",
            ],
            [
                "en" => "shokhaibٍ",
                'ar' => 'شخيب',
                "state" => "Riyadh",
            ],
            [
                "en" => "Tumayr",
                'ar' => 'تمير',
                "state" => "Riyadh",
            ],
            [
                "en" => "Al Wajh",
                'ar' => 'الوجه',
                "state" => "Tabuk",
            ],
            [
                "en" => "Duba",
                'ar' => 'ضباء',
                "state" => "Tabuk",
            ],
            [

                "en" => "Tabuk",
                'ar' => 'تبوك',
                "state" => "Tabuk",
            ],
            [

                "en" => "Umm Lajj",
                'ar' => 'أم لاج',
                "state" => "Tabuk",
            ],
        ];

        foreach ($countries as $country) {
            $cnrty =  Area::create([
                'title' => [
                    'ar' => $country["ar"],
                    'en' => $country["en"]
                ],
                'active' => 1,
                'parent_id' => 0,
                'level' => 0,
            ]);
            foreach ($country["governments"] as $government) {

                Area::create([
                    'title' => [
                        'ar' => $government["ar"],
                        'en' => $government["en"]
                    ],
                    'active' => 1,
                    'parent_id' => $cnrty->id,
                    'level' => 1,
                ]);
            }
        }

        foreach ($cities as $city) {

            $government = Area::where("title->en", $city["state"])->first();

            Area::create([
                'title' => [
                    'ar' => $city["ar"],
                    'en' => $city["en"]
                ],
                'active' => 1,
                'parent_id' => $government->id,
                'level' => 2,
            ]);
        }


    }
}
