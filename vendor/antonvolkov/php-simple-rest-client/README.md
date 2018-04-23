# About
Simple rest-api client for php

# Installation 
> $ php composer.phar require antonvolkov/php-simple-rest-client

# Basic usage
> $get = SimpleRestClient::get("https://httpbin.org/get", ["asd" => 123, "zxc" => 456]);

> $post = SimpleRestClient::post("https://httpbin.org/post", ['asd' => 'test'], ['Content-Type' => 'application/json']);
