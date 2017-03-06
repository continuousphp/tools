# continuousphp tools
This repository is a ZF2 module with the following tools :
* Queue
* Alerting
* Encryption
 
Every tool comes with an adapter pattern. Currently support are AWS SQS, SNS and KMS.

## AWS configuration

To configure the AWS SDK client, simply add your AWS config in the ZF2 config :
```
'aws' =>
    [
        'region' => 'us-east-1',
        'credentials' =>
            [
                'key'    => '...',
                'secret' => '...',
            ],
        '...'
    ]
```

it will be merged automatically when the AWS SDK client is created.