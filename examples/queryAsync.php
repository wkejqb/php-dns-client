<?php

use Metaregistrar\DNS\dnsResponse;

require_once __DIR__ . '/../autoload.php';

$dns = new Metaregistrar\DNS\dnsProtocol();
$dns->setServer('8.8.8.8');
$ready = false;
/** @noinspection PhpUnhandledExceptionInspection */
$dns->QueryAsync('google.com','A', function(?dnsResponse $result, ?string $error = null) use(&$ready) {
    if ($error) {
        echo $error . "\n";
    } else {
        /* @var $result Metaregistrar\DNS\dnsResponse */
        foreach ($result->getResourceResults() as $resource) {
            if ($resource instanceof Metaregistrar\DNS\dnsAresult) {
                echo $resource->getDomain() . ' - ' . $resource->getIpv4() . ' - ' . $resource->getTtl() . "\n";
            }
        }
    }
    $ready = true;
});

while (!$ready) {
    $dns->poll();
    usleep(1000);
}