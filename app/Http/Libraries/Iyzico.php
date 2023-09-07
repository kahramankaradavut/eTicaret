<?php

namespace App\Http\Libraries;

class Iyzico
{
    protected $options;
    protected $request;
    protected $basketItems;

    public function __construct()
    {
        $this->options = new \Iyzipay\Options();
        $this->options->setApiKey('your api key');
        $this->options->setSecretKey('your secret key');
        $this->options->setBaseUrl('https://sandbox-api.iyzipay.com');
        $this->basketItems = [];
    }

    public function setForm(array $params)
    {
        $this->request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $this->request->setLocale(\Iyzipay\Model\Locale::TR);
        $this->request->setConversationId($params['conversationId']);
        $this->request->setPrice($params['price']);
        $this->request->setPaidPrice($params['paidPrice']);
        $this->request->setCurrency(\Iyzipay\Model\Currency::TL);
        $this->request->setBasketId($params['basketId']);
        $this->request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $this->request->setCallbackUrl('https://www.merchant.com/callback');
        $this->request->setEnabledInstallments([2, 3, 6, 9]);
        
        return $this;
    }

    public function setBuyer(array $params)
    {
        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($params['id']);
        $buyer->setName($params['name']);
        $buyer->setSurname($params['surname']);
        $buyer->setGsmNumber($params['phone']);
        $buyer->setEmail($params['email']);
        $buyer->setIdentityNumber($params['identity']);
        $buyer->setRegistrationAddress($params['address']);
        $buyer->setIp($params['ip']);
        $buyer->setCity($params['city']);
        $buyer->setCountry($params['country']);
        $this->request->setBuyer($buyer);
        
        return $this;
    }

    public function setShipping(array $params)
    {
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($params['name']);
        $shippingAddress->setCity($params['city']);
        $shippingAddress->setCountry($params['country']);
        $shippingAddress->setAddress($params['address']);
        $this->request->setShippingAddress($shippingAddress);
        
        return $this;
    }

    public function setBilling(array $params)
    {
        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($params['name']);
        $billingAddress->setCity($params['city']);
        $billingAddress->setCountry($params['country']);
        $billingAddress->setAddress($params['address']);
        $this->request->setBillingAddress($billingAddress);

        return $this;
    }

    public function setItems(array $items)
    {
        foreach ($items as $key => $value) {
            dd($value['name']);
            $basketItem = new \Iyzipay\Model\BasketItem();
            $basketItem->setId($value['id']);
            $basketItem->setName($value['name']);
            $basketItem->setCategory1($value['category']);
            $basketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
            $basketItem->setPrice($value['price']);
            array_push($this->basketItems, $basketItem);
        }
        $this->request->setBasketItems($basketItems);
        return $this;
    }

    public function paymentForm(){
        $form = \Iyzipay\Model\CheckoutFormInitialize::create($this->request, $this->options);
        return $form;
    }
}
