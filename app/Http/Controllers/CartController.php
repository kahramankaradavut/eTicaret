<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Libraries\Iyzico;

class CartController extends Controller
{
    public function index()
    {
        $cartItem = $this->sepetList();

        $seolists = metaolustur('sepet');

        $seo = [
            'title' => $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url' => $seolists['currenturl'],
            'canonical' => $seolists['trpage'],
            'robots' => 'noindex, follow',
        ];

        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Sepet',
        ];

        return view('frontend.pages.cart', compact('breadcrumb', 'seo', 'cartItem'));
    }

    public function sepetList()
    {
        $cartItem = session()->get('cart') ?? [];
        $totalPrice = 0;
        foreach ($cartItem as $cart) {
            $toplamTutar = $cart['price'] * $cart['qty'];
            $totalPrice += $toplamTutar;
        }
        if (session()->get('coupon_code') && $totalPrice != 0) {
            $kupon = Coupon::where('name', session()->get('coupon_code'))
                ->where('status', '1')
                ->first();
            $kuponrate = $kupon->discount_rate ?? 0;
            $kuponprice = $kupon->price ?? 0;
            if ($kuponprice > 0) {
                $newtotalPrice = $totalPrice - $kuponprice;
            }
            if ($kuponrate > 0) {
                $newtotalPrice = $totalPrice - ($totalPrice * $kuponrate) / 100;
            }
        } else {
            $newtotalPrice = $totalPrice;
        }

        session()->put('total_price', $newtotalPrice);

        if (count($cartItem) == 0) {
            session()->forget('coupon_code');
        }

        return $cartItem;
    }

    public function sepetListadd()
    {
        $cartItem = session()->get('cart') ?? [];
        $totalPrice = 0;
        foreach ($cartItem as $cart) {
            $toplamTutar = $cart['price'] * $cart['qty'];
            $totalPrice += $toplamTutar;
        }
        if (session()->get('coupon_code') && $totalPrice != 0) {
            $kupon = Coupon::where('name', session()->get('coupon_code'))
                ->where('status', '1')
                ->first();
            $kuponrate = $kupon->discount_rate ?? 0;
            $kuponprice = $kupon->price ?? 0;
            if ($kuponprice > 0) {
                $newtotalPrice = $totalPrice - $kuponprice;
            }
            if ($kuponrate > 0) {
                $newtotalPrice = $totalPrice - ($totalPrice * $kuponrate) / 100;
            }
        } else {
            $newtotalPrice = $totalPrice+110;
        }

        session()->put('total_price', $newtotalPrice);

        if (count($cartItem) == 0) {
            session()->forget('coupon_code');
        }

        return $cartItem;
    }

    public function sepetform()
    {
        $cartItem = $this->sepetListadd();

        $seolists = metaolustur('sepet');

        $seo = [
            'title' => $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url' => $seolists['currenturl'],
            'canonical' => $seolists['trpage'],
            'robots' => 'noindex, follow',
        ];

        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Sepet',
        ];

        return view('frontend.pages.cartform', compact('breadcrumb', 'seo', 'cartItem'));
    }
    public function sepetformCredit()
    {
        $cartItem = $this->sepetList();

        $seolists = metaolustur('sepet');

        $seo = [
            'title' => $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url' => $seolists['currenturl'],
            'canonical' => $seolists['trpage'],
            'robots' => 'noindex, follow',
        ];

        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Sepet',
        ];

        return view('frontend.pages.cartformcredit', compact('breadcrumb', 'seo', 'cartItem'));
    }

    public function add(Request $request)
    {
        $productID = $request->product_id;
        $qty = $request->qty ?? 1;
        $size = $request->size;
        $urun = Product::find($productID);
        if (!$urun) {
            return back()->withError('Ürün Bulanamadı!');
        }
        $cartItem = session('cart', []);

        if (!empty($request->coupon_code) && $request->coupon_code == 'tumurun') {
            $kupon = Coupon::where('name', $request->coupon_code)
                ->where('status', '1')
                ->first();

            $kuponprice = $kupon->discount_rate ? 2 : 1;

            session()->put('coupon_code', $request->coupon_code);
        } else {
            $kuponprice = 1;
        }

        if (array_key_exists($productID, $cartItem)) {
            $cartItem[$productID]['qty'] += $qty;
        } else {
            $cartItem[$productID] = [
                'image' => $urun->image,
                'name' => $urun->name,
                'price' => $urun->price / $kuponprice,
                'qty' => $qty,
                'size' => $size,
            ];
        }
        session(['cart' => $cartItem]);

        if ($request->ajax()) {
            return response()->json(['sepetCount' => count(session()->get('cart')), 'message' => 'Ürün Sepete Eklendi!']);
        }

        return back()->withSuccess('Ürün Sepete Eklendi!');
    }

    public function newqty(Request $request)
    {
        $productID = $request->product_id;
        $qty = $request->qty ?? 1;
        $itemtotal = 0;
        $urun = Product::find($productID);
        if (!$urun) {
            return response()->json('Ürün Bulanamadı!');
        }
        $cartItem = session('cart', []);

        if (array_key_exists($productID, $cartItem)) {
            $cartItem[$productID]['qty'] = $qty;
            if ($qty == 0 || $qty < 0) {
                unset($cartItem[$productID]);
            }

            if (session()->get('coupon_code') && session()->get('coupon_code') == 'tumurun') {
                $price = $urun->price / 2;
            } else {
                $price = $urun->price;
            }
            $itemtotal = $price * $qty;
        }

        session(['cart' => $cartItem]);

        $this->sepetList();

        if ($request->ajax()) {
            return response()->json(['itemTotal' => $itemtotal, 'totalPrice' => session()->get('total_price'), 'message' => 'Sepet Güncellendi']);
        }
    }

    public function remove(Request $request)
    {
        $productID = sifrelecoz($request->product_id);
        $cartItem = session('cart', []);
        if (array_key_exists($productID, $cartItem)) {
            unset($cartItem[$productID]);
        }
        session(['cart' => $cartItem]);

        if (count(session()->get('cart')) == 0) {
            session()->forget('coupon_code');
        }

        if ($request->ajax()) {
            return response()->json(['sepetCount' => count(session()->get('cart')), 'message' => 'Ürün Sepetten Kaldırıldı!']);
        }

        return back()->withSuccess('Başarıyla Sepetten Kaldırıldı!');
    }

    public function couponcheck(Request $request)
    {
        $kupon = Coupon::where('name', $request->coupon_name)
            ->where('status', '1')
            ->first();

        if (empty($kupon)) {
            return back()->withError('Kupon Bulunamadı!');
        }

        $kuponcode = $kupon->name ?? '';
        session()->put('coupon_code', $kuponcode);

        $kuponprice = $kupon->price ?? 0;
        session()->put('coupon_price', $kuponprice);

        $this->sepetList();

        return back()->withSuccess('Kupon Uygulandı!');
    }

    function generateKod()
    {
        $siparisno = generateOTP(7);
        if ($this->barcodeKodExists($siparisno)) {
            return $this->generateKod();
        }

        return $siparisno;
    }

    function barcodeKodExists($siparisno)
    {
        return Invoice::where('order_no', $siparisno)->exists();
    }

    public function cartSave(Request $request)
    {
        $request->validate(
            [
                'identity' => 'required|valid_tc_kimlik',
                'name' => 'required|string|min:3',
                'surname' => 'required|string|min:3',
                'email' => 'required|email',
                'phone' => 'required|valid_phone_number',
                'company_name' => 'nullable|string',
                'address' => 'required|string',
                'country' => 'required|string',
                'city' => 'required|string',
                'district' => 'required|string',
                'zip_code' => 'required|string',
                'note' => 'nullable|string',
            ],
            [
                'identity.required' => __('TC Kimlik alanı zorunludur.'),
                'identity.valid_tc_kimlik' => __('TC Kimlik geçersiz!'),
                'name.required' => __('İsim alanı zorunludur.'),
                'name.string' => __('İsim bir metin olmalıdır.'),
                'name.min' => __('İsim en az 3 karakterden oluşmalıdır.'),
                'surname.required' => __('Soyad alanı zorunludur.'),
                'surname.string' => __('Soyad bir metin olmalıdır.'),
                'surname.min' => __('Soyad en az 3 karakterden oluşmalıdır.'),
                'email.required' => __('E-posta alanı zorunludur.'),
                'email.email' => __('Geçerli bir e-posta adresi girilmelidir.'),
                'phone.required' => __('Telefon alanı zorunludur.'),
                'phone.valid_phone_number' => __('Telefon numarasını gösterilen şekilde giriniz.'),
                'company_name.string' => __('Şirket adı bir metin olmalıdır.'),
                'address.required' => __('Adres alanı zorunludur.'),
                'address.string' => __('Adres bir metin olmalıdır.'),
                'country.required' => __('Ülke alanı zorunludur.'),
                'country.string' => __('Ülke bir metin olmalıdır.'),
                'city.required' => __('Şehir alanı zorunludur.'),
                'city.string' => __('Şehir bir metin olmalıdır.'),
                'district.required' => __('İlçe alanı zorunludur.'),
                'district.string' => __('İlçe bir metin olmalıdır.'),
                'zip_code.required' => __('Posta kodu alanı zorunludur.'),
                'zip_code.string' => __('Posta kodu bir metin olmalıdır.'),
                'note.string' => __('Not bir metin olmalıdır.'),
            ],
        );
        $invoce = Invoice::create([
            'user_id' => auth()->user()->id ?? null,
            'order_no' => $this->generateKod(),
            'country' => $request->country,
            'identity' =>$request->identity,
            'name' => $request->name,
            'surname' => $request->surname,
            'company_name' => $request->company_name ?? null,
            'address' => $request->address ?? null,
            'city' => $request->city ?? null,
            'district' => $request->district ?? null,
            'zip_code' => $request->zip_code ?? null,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'note' => $request->note ?? null,
        ]);

        $cart = session()->get('cart') ?? [];

        foreach ($cart as $key => $item) {
            $product = Product::find($key);
            $category = Category::find($product->category_id);
            Order::create([
                'order_no' => $invoce->order_no,
                'product_id' => $key,
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'category_name' => $category->name,
            ]);
        }

        session()->forget('cart');
        return redirect()
            ->route('anasayfa')
            ->withSuccess('Alışveriş Başarıyla Tamamlandı.');
    }

    public function cartSaveWCredit(Request $request)
    {
        $request->validate(
            [
                'identity' => 'required|valid_tc_kimlik',
                'name' => 'required|string|min:3',
                'surname' => 'required|string|min:3',
                'email' => 'required|email',
                'phone' => 'required|valid_phone_number',
                'company_name' => 'nullable|string',
                'address' => 'required|string',
                'country' => 'required|string',
                'city' => 'required|string',
                'district' => 'required|string',
                'zip_code' => 'required|string',
                'note' => 'nullable|string',
            ],
            [
                'identity.required' => __('TC Kimlik alanı zorunludur.'),
                'identity.valid_tc_kimlik' => __('TC Kimlik geçersiz!'),
                'name.required' => __('İsim alanı zorunludur.'),
                'name.string' => __('İsim bir metin olmalıdır.'),
                'name.min' => __('İsim en az 3 karakterden oluşmalıdır.'),
                'surname.required' => __('Soyad alanı zorunludur.'),
                'surname.string' => __('Soyad bir metin olmalıdır.'),
                'surname.min' => __('Soyad en az 3 karakterden oluşmalıdır.'),
                'email.required' => __('E-posta alanı zorunludur.'),
                'email.email' => __('Geçerli bir e-posta adresi girilmelidir.'),
                'phone.required' => __('Telefon alanı zorunludur.'),
                'phone.valid_phone_number' => __('Telefon numarasını gösterilen şekilde giriniz.'),
                'company_name.string' => __('Şirket adı bir metin olmalıdır.'),
                'address.required' => __('Adres alanı zorunludur.'),
                'address.string' => __('Adres bir metin olmalıdır.'),
                'country.required' => __('Ülke alanı zorunludur.'),
                'country.string' => __('Ülke bir metin olmalıdır.'),
                'city.required' => __('Şehir alanı zorunludur.'),
                'city.string' => __('Şehir bir metin olmalıdır.'),
                'district.required' => __('İlçe alanı zorunludur.'),
                'district.string' => __('İlçe bir metin olmalıdır.'),
                'zip_code.required' => __('Posta kodu alanı zorunludur.'),
                'zip_code.string' => __('Posta kodu bir metin olmalıdır.'),
                'note.string' => __('Not bir metin olmalıdır.'),
            ],
        );
        $invoce = Invoice::create([
            'user_id' => auth()->user()->id ?? null,
            'order_no' => $this->generateKod(),
            'country' => $request->country,
            'identity' =>$request->identity,
            'name' => $request->name,
            'surname' => $request->surname,
            'company_name' => $request->company_name ?? null,
            'address' => $request->address ?? null,
            'city' => $request->city ?? null,
            'district' => $request->district ?? null,
            'zip_code' => $request->zip_code ?? null,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'note' => $request->note ?? null,
        ]);

        $cart = session()->get('cart') ?? [];

        foreach ($cart as $key => $item) {
            $product = Product::find($key);
            $category = Category::find($product->category_id);
            Order::create([
                'order_no' => $invoce->order_no,
                'product_id' => $key,
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'category_name' => $category->name,
            ]);
        }

        
        return redirect()->route('odeme');
    }

    public function odeme()
    {
        $invoice = Invoice::latest()->firstOrFail();
        $order = Order::latest()->firstOrFail();
        $orderNo = $order->order_no;
        $orders = Order::where('order_no', $orderNo)->get();

        $items = [];
        $totalPrice = 0;
        foreach ($orders as $order) {
            $totalPrice = $totalPrice + $order->price;
        }
        
        foreach ($orders as $order) {
                $items[] = [
                    'id' => $order->product_id,
                    'name' => $order->name,
                    'category' => $order->category_name,
                    'price' => number_format($order->price, 1),
                ];
        }


        $iyzico = new Iyzico();
        $payment = $iyzico
            ->setForm([
                'price' => number_format($totalPrice, 1),
                'paidPrice' => number_format($totalPrice, 1),
                'basketId' => $invoice->order_no,
            ])
            ->setBuyer([
                'id' => 120,
                'name' => $invoice->name,
                'surname' => $invoice->surname,
                'phone' => $invoice->phone,
                'email' => $invoice->email,
                'identity' => $invoice->identity,
                'address' => $invoice->address,
                'ip' => request()->ip(),
                'city' => $invoice->city,
                'country' => 'Türkiye',
            ])
            ->setShipping([
                'name' => $invoice->name . ' ' . $invoice->surname,
                'city' => $invoice->city,
                'country' => 'Türkiye',
                'address' => $invoice->address,
            ])
            ->setBilling([
                'name' => $invoice->name . ' ' . $invoice->surname,
                'city' => $invoice->city,
                'country' => 'Türkiye',
                'address' => $invoice->address,
            ])
            ->setItems($items)
            ->paymentForm();


        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Ödeme Sayfası',
        ];
        return view(
            'frontend.pages.odeme',
            [
                'paymentContent' => $payment->getCheckoutFormContent(),
                'paymentStatus' => $payment->getStatus(),
            ],
            compact('breadcrumb'),
        );
    }

    public function callback()
    {
        $invoice = Invoice::latest()->firstOrFail();
        $token = $_REQUEST['token'];
        $conversationId = $invoice->identity;
        $iyzico = new Iyzico();
        $response = $iyzico->callbackForm($token, $conversationId);

        $breadcrumb = [
            'sayfalar' => [],
            'active' => 'Ödeme',
        ];
        session()->forget('cart');
        return view(
            'frontend.pages.callback',
            [
                'paymentStatus' => $response->getPaymentStatus(),
            ],
            compact('breadcrumb'),
        );
    }
}
