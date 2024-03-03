<?php

class Jacktrac {

  var $debug;
  var $url;

  function __construct($url = '', $debug = false) {
    $this->url = $url;
    $this->debug = $debug;
  }

  function init($url, $debug = false) {
    $this->url = $url;
    $this->debug = $debug;
  }

  function save_device_log($token, $device_log) {
    return $this->get_response($this->post($this->url . '/api/save_device_log', $device_log));
  }

  function get_device_logs($token, $device_uid) {
    $data = array('device_uid' => $device_uid);
    return $this->get_response($this->get($this->url . '/api/get_device_logs', $data));
  }

  function get($url, $data = array()) {
    $curl = curl_init();

    $params = http_build_query($data);
    $url_with_params = $url . '?' . $params;
    if ($this->debug) {
      echo $url_with_params . '<br>';
    }
    curl_setopt($curl, CURLOPT_URL, $url_with_params);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_HTTPGET, 1);

    $output = curl_exec($curl);

    curl_close($curl);
    return $output;
  }

  function post($url, $data, $headers = null, $username = '', $password = '') {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    // $params = http_build_query($data);
    if ($this->debug) {
      echo $url . ' <br>';
      print_pre($data);
      echo '<br>';
    }
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen(json_encode($data))
    ));
    // if ($headers) {
    //   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // }
    if ($username && $password) {
      curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
    }

    $output = curl_exec($ch);

    curl_close($ch);
    return $output;
  }

  function get_response($response) {
//    if (!$this->debug) {
    $response = json_decode($response);
//    }
    return $response;
  }

}
