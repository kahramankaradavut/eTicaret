<?php

namespace App\Http\Libraries;

class Iyzico
{
    protected $options;
    protected $request;

    public function __construct()
    {
        $this->options = new \Iyzipay\Options();
        $this->options->setApiKey('your api key');
        $this->options->setSecretKey('your secret key');
        $this->options->setBaseUrl('https://sandbox-api.iyzipay.com');
    }

    public function setForm(array $params)
    {
        $this->request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $this->request->setLocale(\Iyzipay\Model\Locale::TR);
        $this->request->setConversationId($params['conversationId']);
        $this->request->setPrice($params['price']);
        $this->request->setPaidPrice($params['paidprice']);
        $this->request->setCurrency(\Iyzipay\Model\Currency::TL);
        $this->request->setBasketId($params['basketId']);
        $this->request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $this->request->setCallbackUrl('https://www.merchant.com/callback');
        $this->request->setEnabledInstallments([2, 3, 6, 9]);
    }

    public function setBuyer(Array $params)
    {
        $this->buyer = new \Iyzipay\Model\Buyer();
        $this->buyer->setId('BY789');
        $this->buyer->setName('John');
        $this->buyer->setSurname('Doe');
        $this->buyer->setGsmNumber('+905350000000');
        $this->buyer->setEmail('email@email.com');
        $this->buyer->setIdentityNumber('74300864791');
        $this->buyer->setLastLoginDate('2015-10-05 12:43:35');
        $this->buyer->setRegistrationDate('2013-04-21 15:12:09');
        $this->buyer->setRegistrationAddress('Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1');
        $this->buyer->setIp('85.34.78.112');
        $this->buyer->setCity('Istanbul');
        $this->buyer->setCountry('Turkey');
        $this->buyer->setZipCode('34732');
        $this->request->setBuyer($buyer);
    }
}
