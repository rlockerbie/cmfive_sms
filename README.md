# SMS Module for cmfive utilising Twilio SMS service
## Config settings
```php
Config::set("twilio", [
        "account_sid" => "",
        "auth_token" => "",
        "message_service_sid" => "",
        "from" => "",//Mobile number the sms will be sent from
]);
```
## Usage
To send an sms use the SMS service function send
```php
$web->Sms->send('0400000000', 'Message');
```

