<?php

class Chat_api
{
  
  private $number = "WhatsappNumber";
  private $token = "TokenWhatsappApi";
  private $body = "";
  private $fields = [];
  private $instance =""; // Instance

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
      log_message("error", "Fallo el envio de whatsapp, siguiente mensaje" . $response->message);
    }

    return $response;
  }

  function setNumber($number)
  {
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
