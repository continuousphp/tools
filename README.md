# continuousphp tools
This repository is a ZF2 module with tools like a Queue, Alerting, ...
 
Every tool comes with an adapter pattern.

## AWS config

When using AWS adapters like SQS or SNS, you can provide the region, key and secret by specifying them in the ZF config:

```
'aws' =>
    [
        'region'      => '<AWS region>',
        'credentials' =>
            [
                'key'    => '<AWS key>',
                'secret' => '<AWS secret>'
            ]
    ]
```
