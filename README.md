Parasut Php SDK
==
Install:
```
composer require bigoen/parasut
```
Base defines:
```php
use Symfony\Component\HttpClient\HttpClient;

$clientId = '';
$clientSecret = '';
$email = 'Panel email';
$password = 'Panel password';
$companyId = '123'; // https://uygulama.parasut.com/123/
$httpClient = HttpClient::create();
```
AccountService:
```php
use Bigoen\Contracts\Parasut\Constant\CurrencyConstant;
use Bigoen\Contracts\Parasut\Constant\AccountTypeConstant;
use Bigoen\Parasut\Services\AccountService;
use Bigoen\Parasut\Model\Account;

$service = new AccountService(
    $clientId, 
    $clientSecret,
    $email,
    $password,
    $companyId, 
    $httpClient
);
// set queries. 
$queries = [
    'page[size]' => 20,
];
// return array.
$service->getAccounts($queries);
// return objects.
$service->getObjectAccounts($queries);
// post object.
$object = new Account();
$object->name = "Test";
$object->currency = CurrencyConstant::TRL;
$object->accountType = AccountTypeConstant::BANK;
$object->bankName = "Test Bank";
$object->bankBranch = "Test";
$object->bankAccountNo = "123456";

$service->postObjectAccount($object);
// put object.
$object = $service->getObjectAccount(123);
$object->name = "New Name";

$service->putObjectAccount($object);
// delete object.
$service->deleteAccount(123);
```
ContactService:
```php
use Bigoen\Parasut\Services\ContactService;
use Bigoen\Parasut\Model\Contact;

$service = new ContactService(
    $clientId, 
    $clientSecret,
    $email,
    $password,
    $companyId, 
    $httpClient
);
// set queries. 
$queries = [
    'page[size]' => 20,
];
// return array.
$service->getContacts($queries);
// return objects.
$service->getObjectContacts($queries);
// post object.
$object = new Contact();
$object->name = "Test";
$object->shortName = "Short";
$object->taxOffice = "Tax Office";
$object->taxNumber = "123123";
$object->city = "İzmir";
$object->district = "Konak";

$service->postObjectContact($object);
// put object.
$object = $service->getObjectContact(123);
$object->name = "New Name";

$service->putObjectContact($object);
// delete object.
$service->deleteContact(123);
```
SalesInvoiceService:
```php
use Bigoen\Contracts\Parasut\Constant\PaymentItemTypeConstant;
use Bigoen\Contracts\Parasut\Constant\CurrencyConstant;
use Bigoen\Parasut\Model\SalesInvoicePayment;
use Bigoen\Parasut\Services\SalesInvoiceService;
use Bigoen\Parasut\Model\SalesInvoice;

$service = new SalesInvoiceService(
    $clientId, 
    $clientSecret,
    $email,
    $password,
    $companyId, 
    $httpClient
);
// set queries. 
$queries = [
    'page[size]' => 20,
];
// return array.
$service->getSalesInvoices($queries);
// return objects.
$service->getObjectSalesInvoices($queries);
// post object.
$object = new SalesInvoice();
$object->itemType = PaymentItemTypeConstant::INVOICE;
$object->description = "Test";
$object->issueDate = new DateTime();
$object->dueDate = new DateTime();
$object->currency = CurrencyConstant::TRL;
$object->exchangeRate = 1;
// set other variables.

$service->postObjectSalesInvoice($object);
// put object.
$object = $service->getObjectSalesInvoice(123);
$object->description = "New Description";

$service->putObjectSalesInvoice($object);
// payment.
$includeQueries = 'payable, transaction';
$payment = new SalesInvoicePayment();
$payment->salesInvoiceId = 123;
$payment->notes = "Notes";
$payment->accountId = 123;
$payment->date = new DateTime();
$payment->amount = 100.5;
$payment->exchangeRate = 1;

$service->postObjectSalesInvoicePayment($payment, $includeQueries);
// delete object.
$service->deleteSalesInvoice(123);
```
PurchaseBillService:
```php
use Bigoen\Contracts\Parasut\Constant\PaymentItemTypeConstant;
use Bigoen\Contracts\Parasut\Constant\CurrencyConstant;
use Bigoen\Parasut\Services\PurchaseBillService;
use Bigoen\Parasut\Model\PurchaseBill;
use Bigoen\Parasut\Model\PurchaseBillPayment;

$service = new PurchaseBillService(
    $clientId, 
    $clientSecret,
    $email,
    $password,
    $companyId, 
    $httpClient
);
// set queries. 
$queries = [
    'page[size]' => 20,
];
// return array.
$service->getPurchaseBills($queries);
// return objects.
$service->getObjectPurchaseBills($queries);
// post object.
$object = new PurchaseBill();
$object->itemType = PaymentItemTypeConstant::PURCHASE_BILL;
$object->description = "Test";
$object->issueDate = new DateTime();
$object->dueDate = new DateTime();
$object->currency = CurrencyConstant::TRL;
$object->exchangeRate = 1;
$object->netTotal = 100.0;
$object->totalVat = 18.0;
// set other variables.

// basic or detailed.
$service->postObjectPurchaseBillBasic($object);
$service->postObjectPurchaseBillDetailed($object);
// put object.
$object = $service->getObjectPurchaseBill(123);
$object->description = "New Description";

$service->putObjectPurchaseBillBasic($object);
// payment.
$includeQueries = 'payable, transaction';
$payment = new PurchaseBillPayment(); 
$payment->purchaseBillId = 123;
$payment->notes = "Notes";
$payment->accountId = 123;
$payment->date = new DateTime();
$payment->amount = 100.5;
$payment->exchangeRate = 1;

$service->postObjectPurchaseBillPayment($payment, $includeQueries);
// delete object.
$service->deletePurchaseBill(123);
```
