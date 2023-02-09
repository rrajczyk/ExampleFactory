<?php

abstract class Creator
{
    abstract public function factoryMethod(string $type): Sender;

    public function preapreAndSend(string $type): string
    {
        $product = $this->factoryMethod($type);

        $result = "Creator: The same creator's code has just worked with " .
            $product->prepare() .
            $product->send();

        return $result;
    }
}

class senderFactory extends Creator
{
    public function factoryMethod(string $type): Sender
    {
        switch ($type) {
            case 'sms':
                return new SmsGateway();
                break;
            case 'email':
                return new EmailGateway();
                break;
        }
    }
}

interface Sender
{
    public function send(): string;

    public function prepare(): string;
}

class SmsGateway implements Sender
{
    public function send(): string
    {
        return "Result of the sms Send";
    }

    public function prepare(): string
    {
        return "<br>Prepare sms<br>";
    }
}

class EmailGateway implements Sender
{
    public function send(): string
    {
        return "Result of the email Send";
    }

    public function prepare(): string
    {
        return "<br>Prepare sms<br>";
    }
}

$factory = new senderFactory();
echo $factory->factoryMethod('sms')->send();
echo "<hr>";
echo $factory->preapreAndSend('sms');
echo "<hr>";

echo $factory->factoryMethod('email')->send();
echo "<hr>";
echo $factory->preapreAndSend('sms');
