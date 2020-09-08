<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;
use Cielo\API30\Ecommerce\Request\CieloRequestException;

use Cart;
use App\Sold;
use App\Product;
use App\Shop;
use App\Coupon;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class CieloController extends CartController
{
    private $environment;
    private $merchant;
    private $cielo;
    private $sale;
    private $payment;

    public function __construct(Request $request){
        $this->environment = Environment::sandbox();
        $this->merchant = new Merchant(config('cielo.MerchantId'), config('cielo.MerchantKey'));
        $this->cielo = new CieloEcommerce($this->merchant, $this->environment);
        $this->sale = new Sale('123');
        $this->payment = Payment::PAYMENTTYPE_CREDITCARD;
    }
    
    public function index()
    {
        $data = CartController::index();
        $shop = new Shop;
        $shopc = new Coupon;

        $shop->final = $data->shop->final;
        $shop->fmt_final = $data->shop->fmt_final;

        return view('checkout', compact('shop','shopc'));
    }
    
    public function coupon(Request $request)
    {

        $data = CartController::index();
        $shopc = new Coupon;

        if($coupon = Coupon::all()->where('cod',$request->cod)->first())
        {
    
            $shopc->value = str_replace('.','',$data->shop->fmt_final);
            $shopc->value = str_replace(',','.',$shopc->value);
    
            $shopc->discount = ($coupon->discount / 100) * $shopc->value;
            
            $shopc->final = $shopc->value - $shopc->discount;
            $shopc->fmt_final = number_format($shopc->final,2,',','.');
            $shopc->message = "Desconto aplicado com sucesso!";

            return view('checkout',compact('coupon','shopc'));
        }
        else
        {

            $shop = new Shop;
            $shop->final = $data->shop->final;
            $shop->fmt_final = $data->shop->fmt_final;
            
            $shopc->message = "Cupom não encontrado";
            
            return view('checkout',compact('shop','shopc'));
        }
        
        // dd($shopc);
    }

    public function payer(Request $request)
    {

        $data = CartController::index();
        $shop = new Shop;
        
        $shop->final = $data->shop->final;
        $shop->name = auth()->user()->name;
        $shop->email = auth()->user()->email;

        foreach (Cart::content() as $item)
        {
            $p[] = $item->qty." - ".$item->model->name." (".$item->model->id.")";
        }

        if($request->fpag == 'credit')
        {
            $saveCart = [
                'userId' => auth()->user()->id,
                'street' => auth()->user()->street,
                'number' => auth()->user()->number,
                'comp' => auth()->user()->comp,
                'city' => auth()->user()->city,
                'state' => auth()->user()->state,
                'zipcode' => auth()->user()->zipcode,
                'paymentType' => $this->payment ." - ". $request->flag,
                'value' => $data->shop->final,
                'installments' => $request->installments,
                'trackingNumber' => null,
                'cart' => serialize($p),
            ];

            // dump($saveCart);
            // dd();
            
            // Crie uma instância de Customer informando o nome do cliente
            $this->sale->customer($request->holder);
            
            // Crie uma instância de Payment informando o valor do pagamento
            $payment = $this->sale->payment($shop->final, $request->installments);
            
            // Crie uma instância de Credit Card utilizando os dados de teste
            // esses dados estão disponíveis no manual de integração
            // dd($request->installments);
            // $this->cardData($shop->final,$request->cvv,$request->date,$request->installments,$request->numberCard,$request->holder);
            $payment->setType($this->payment)
                        ->creditCard($request->cvv, CreditCard::MASTERCARD)
                        ->setExpirationDate($request->date)
                        ->setCardNumber($request->numberCard)
                        ->setHolder($request->holder);

            $merchantOrderId = $this->sale->getMerchantOrderId();
            $saveCart['merchantOrderId'] = $merchantOrderId;
            
            // Crie o pagamento na Cielo
            try {
                // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
                $sale = ($this->cielo)->createSale($this->sale);
                
                // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
                // dados retornados pela Cielo
                $paymentId = $sale->getPayment()->getPaymentId();
                $tId = $sale->getPayment()->getTid();
                
                // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
                $sale = ($this->cielo)->captureSale($paymentId, $shop->final, 0);

                // Salvar no banco os dados da compra
                $saveCart['paymentId'] = $paymentId;
                $saveCart['tid'] = $tId;
                $saveCart['status'] = 'waiting';
                $saveCart['success'] = true;
                Sold::create($saveCart);
                
                // Enviar email de sucesso
                $details = [
                    'idPed' => $tId,
                    'title' => 'Agradecemos por sua compra em nossa loja.',
                    'body' => 'Caso precise de alguma ajuda com o seu pedido, fale conosco através do WhatsApp® (19) 91234-5678.'
                ];
            
                \Mail::to($shop->email)->send(new \App\Mail\SoldMail($details));        

                return view('success', compact('shop'));

            } catch (CieloRequestException $e) {
                // Em caso de erros de integração, podemos tratar o erro aqui.
                // os códigos de erro estão todos disponíveis no manual de integração.
                // dd($e);
                $error = $e->getCieloError();

                // Salvar no banco os dados da compra
                $saveCart['status'] = 'fail';
                $saveCart['success'] = false;
                $saveCart['errorCod'] = $error->getCode();
                Sold::create($saveCart);

                return view('error', compact('error'));
            }
        }
        elseif($request->fpag == 'boleto')
        {
            // Crie uma instância de Customer informando o nome do cliente,
            // documento e seu endereço
            $customer = $this->sale->customer(auth()->user()->name." ".auth()->user()->lastname)
            ->setIdentity(auth()->user()->doc)
            ->setIdentityType('CPF')
            ->address()->setZipCode(auth()->user()->zipcode)
                    ->setCountry('BRA')
                    ->setState(auth()->user()->state)
                    ->setCity(auth()->user()->city)
                    ->setDistrict(auth()->user()->neigh)
                    ->setStreet(auth()->user()->street)
                    ->setNumber(auth()->user()->number);

            // Crie uma instância de Payment informando o valor do pagamento
            $payment = $this->sale->payment($data->shop->final)
            ->setType(Payment::PAYMENTTYPE_BOLETO)
            ->setAddress('Rua de Teste')
            ->setBoletoNumber('1234')
            ->setAssignor('Iluminatta')
            ->setDemonstrative('Obtenha mais informações sobre essa compra no site www.iluminatta.com.br')
            ->setExpirationDate(date('d/m/Y', strtotime('+2 days')))
            ->setIdentification('11884926754')
            ->setInstructions("<br>Obrigado por sua compra em nossa loja on-line.<br><br>Atenciosamente,<br>Equipe Iluminatta");

            // Crie o pagamento na Cielo
            try {
            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $sale = ($this->cielo)->createSale($this->sale);

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
            // dados retornados pela Cielo
            $paymentId = $sale->getPayment()->getPaymentId();
            $boletoURL = $sale->getPayment()->getUrl();

            
            echo'<iframe src="'.$boletoURL.'" name="boleto" style="width:100%;height:1200px;border:none;" title="Iframe Boleto"></iframe>';
            
            } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            // $error = $e->getCieloError();
            echo '<div style="width:100%;float:left;text-align:center;border: solid 1px #ddd;border-radius:5px;padding:2em 0;margin: 2em auto 0 auto;">';
            echo '<p style="font-family:arial;font-size:13px;color:#111;">Aconteceu algum erro ao gerar o seu boleto. Por favor, tente outra forma de pagamento ou entre em contato conosco.</p>';
            echo '<button style="border:none;padding:10px;font-family:arial;font-size:13px;background:#999;color:#fff;border-radius:5px;" onclick="window.close()">Fechar janela</button>';
            echo '</div>';
            
            }
        }
        elseif($request->fpag == 'debitoxx')
        {
            // echo '<div style="width:100%;float:left;text-align:center;border: solid 1px #ddd;border-radius:5px;padding:2em 0;margin: 2em auto 0 auto;">';
            // echo '<p style="font-family:arial;font-size:13px;color:#111;">Forma de pagamento (débito) em manutenção. Por favor, escolha outra forma de pagamento.</p>';
            // echo '<button style="border:none;padding:10px;font-family:arial;font-size:13px;background:#999;color:#fff;border-radius:5px;" onclick="history.back(-1)">Voltar ao checkout</button>';
            // echo '</div>';

            // Crie uma instância de Customer informando o nome do cliente
            $customer = $this->sale->customer('Fulano de Tal');

            // Crie uma instância de Payment informando o valor do pagamento
            $payment = $this->sale->payment(15700);

            // Defina a URL de retorno para que o cliente possa voltar para a loja
            // após a autenticação do cartão
            $payment->setReturnUrl('http://localhost:8000/checkout');
            $payment->setCapture(true);
            $payment->setAuthenticate(true);

            // Crie uma instância de Debit Card utilizando os dados de teste
            // esses dados estão disponíveis no manual de integração
            $payment->debitCard("123", CreditCard::VISA)
                    ->setExpirationDate("12/2018")
                    ->setCardNumber("0000000000000001")
                    ->setHolder("Fulano de Tal");

            // Crie o pagamento na Cielo
            try {
                // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
                $sale = ($this->cielo)->createSale($this->sale);

                // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
                // dados retornados pela Cielo
                $paymentId = $sale->getPayment()->getPaymentId();
                

                // Utilize a URL de autenticação para redirecionar o cliente ao ambiente
                // de autenticação do emissor do cartão
                $authenticationUrl = $sale->getPayment()->getAuthenticationUrl();
                echo $authenticationUrl;
            } catch (CieloRequestException $e) {
                // Em caso de erros de integração, podemos tratar o erro aqui.
                // os códigos de erro estão todos disponíveis no manual de integração.
                echo $error = $e->getCieloError();
            }
        }
    }
}
