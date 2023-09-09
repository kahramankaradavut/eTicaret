<?php

namespace App\Providers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('valid_tc_kimlik', function ($attribute, $value, $parameters, $validator) {
            // TC kimlik numarasının geçerliliğini kontrol etmek için gereken algoritma
            if (strlen($value) != 11) {
                return false; // TC kimlik numarası 11 karakterden oluşmalıdır
            }
            
            $digits = str_split($value);
            
            // İlk haneler sıfır olamaz
            if ($digits[0] == '0') {
                return false;
            }
            
            // 10. hane, 1, 3, 5, 7, ve 9. hanelerin toplamının 7 katı - 2, 4, 6 ve 8. hanelerin toplamının 9 katı
            $oddSum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8];
            $evenSum = $digits[1] + $digits[3] + $digits[5] + $digits[7];
            $t = ($oddSum * 7 - $evenSum) % 10;
            if ($digits[9] != $t) {
                return false;
            }
            
            // 1, 2, 3, 4, 5, 6, 7, 8, 9 ve 10. hanelerin toplamının 10'a bölümünden kalan, 11. hane olmalıdır
            $checksum = ($oddSum + $evenSum + $digits[9]) % 10;
            if ($digits[10] != $checksum) {
                return false;
            }
            
            return true; // TC kimlik numarası geçerli ise true, değilse false döner
        });

        Validator::extend('valid_phone_number', function ($attribute, $value, $parameters, $validator) {
            // Türkiye'deki 10 haneli cep telefonu numarası formatını kontrol etmek için gerekli kod
            return preg_match('/^05\d{9}$/', $value);
        });
    }
}
