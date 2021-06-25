# SDK_Chat-Api_PHP
This piece of code is simple, but powerful. It is written in PHP, you can implement it in Library in CodeIgniter 3.x, 4.x
## Table of Contents
1. [Motivation](#motivation)
2. [General Info](#general-info)
3. [Technologies](#technologies)
4. [Installation](#installation)

## Motivation
It motivated me to create this code, because in the web app that I am creating in CodeIgniter 3x I had to implement the unofficial whatsapp api "Chat-Api" and as it has an option for URL and how it can support the cURL, create a class for this library

## General Info
I use this SDK within CodeIgniter 3x, but it can be used in any MVC framework and you only have to call the created object, when it is CodeIgniter or create an object of the class "Chat_api"
## Technologies
* [It is writed in PHP](https://www.php.net/)
* [Chat-Api, Unofficial API Whatsapp, ](https://chat-api.com/)


## Installation
Download file in side yout proyect
If you uses PHP pure, then you have include your project.
You must instantiate the class 'Chat_api'

If you use CodeIgniter, then include in to folder 'Library' 
and you have load library Ej $this->load->library("Chat_api"); $this->Chat_api->setNumber("+1205464564");

```
<?php

class Chat_api
{

  
  private $number = "1205123456"; // Whatsapp default number
  private $token = "Token"; // This is token Chat-Api
  private $body = ""; // Text of Whatsapp message
  private $instance = "instance5454654564"; // This is TokenTest (Example)
  private $fields = [];

  public function Run()
  {
    $chat_api = "https://api.chat-api.com/$this->instance/sendMessage?token=$this->token";
    $this->setFields();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $chat_api);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->getFields()));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($data);

    if ($response->sent == 0) {
      log_message("error", "Fail send message" . $response->message);
    }

    return $response;
  }

  function setNumber($number)
  {
  //This is case you use CodeIgniter, else delete if block
    if (ENVIRONMENT === "production") {
      $this->number = $number;
    }
  }
  function setBody($body)
  {
    $this->body = $body;
  }
  private function setFields()
  {
    $this->fields =  [
      "body" => $this->body,
      "phone" => $this->number
    ];
  }
  private function getFields()
  {
    return $this->fields;
  }
}

