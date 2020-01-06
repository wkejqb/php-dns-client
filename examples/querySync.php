<?php
require_once __DIR__ . '/../autoload.php';

$dns = new Metaregistrar\DNS\dnsProtocol();
$dns->setServer('8.8.8.8');
/** @noinspection PhpUnhandledExceptionInspection */
$result = $dns->Query('google.com','A');
/* @var $result Metaregistrar\DNS\dnsResponse */
foreach ($result->getResourceResults() as $resource) {
    if ($resource instanceof Metaregistrar\DNS\dnsAresult) {
        echo $resource->getDomain().' - '.$resource->getIpv4().' - '.$resource->getTtl()."\n";
    } else {
        print_r($resource);
    }
}
