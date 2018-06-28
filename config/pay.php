<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => '2016091400506411',

        // 支付宝异步通知地址
        'notify_url' => env('APP_URL').'alinotify',

        // 支付成功后同步通知地址
        'return_url' => env('APP_URL').'/alicallback',

        // 阿里公共密钥，验证签名时使用
        'ali_public_key'=> 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5VnWmoQbi1dgQ51/IB0l6Svh129IgmPtqw9lRJNuFISRBaCqSnZ+X3ZNKsGrO+3oDDXp8pjW6OfutzcaXEGwyhkHr+CXgEGrfWeibTUPj+bIwDSRAvfPrG4kVTnyQNg0EEH7vLWvsaQjH/9tUNEy8OW66QaRa5EV2BBYhBUk6kzfO5gwLVuDlU+aif3EpUoNeGYmfnxBDABvBEKh+IVpg3xA3N1DQ18oGP0fXOnVg/i6CuvFSULQOyW1tIwXcPpe+EqElt8ZX1M/e4SkIA+RhWPIKk5oc+qtMvDQsceZSpgZ9XyGKJm1pGdD3fwaRmMpi2A013EJGShe2NQKJmJd/QIDAQAB',
        'private_key' => 'MIIEpQIBAAKCAQEA+wCua/EXNcG4PJWcrDUBQ3Lh1uhn+N3XLX0ZpiqiqOMdIvfOdhGaT5aq035QyQo6+qbQz+lfcWg3BeICKPf2LbOtbGO0M1Sg1bXfdZYtbhJ/+W/86lyndMEcc70bYJ9d/eO/CbxkqbxY6fvHpFuJYzWEGfFXOWrGr+j2zjQT57ayFf3uImViBgg3OS9D5W8/+RTPd6KY0kQERh57zwKZ9dyI5bGsaa9lf0LgymbHVqhkboL+k1csQu2HIx9pnmTcMjYg4DNEN5Sz1E1U8QsP/U85o/0utW4OLa4stPNyokhaohHTkdJHlqYwngCbMKwIlTRmPx0hnqZgFC4+2Glr0QIDAQABAoIBAQDDJZd2cr4R3GgqKkPiG1+9Ge9+D7juY0OtqSqs508JsXHwwutxHmRz5ncv8XBLrbmHMPT+ALpkyJqm5z24rnhmteBqeeYbVnupTDrNCBKQFrAKtcfUSm8jNhSx42AKsjz4bP4VSrSUxsv2NvvTzBs319658MpY6KxLDfv8+75SEk2dRYWRlUbns6IfKYYNXclGDIGoFnNrVrDWx7WTdBO9JnR6B5x3ffTiIxmkRZHkJ9Xn6Oy0qaVbcJE6KtEwvTfLQsNal/YJsUKmG+PK2zmiyRe6izDQgmVDeuQyipne/kWd0x9vp8k6TfXZDZJHSfExoIUHk9k4EvhXAQCrCkOFAoGBAP7LKI9d/JpunNlzfMpLcQlyZL5ld5uGcoyX7NmZd4X1gSuseCWxzTj5d+WFTgVvilkI6WxJgIx4dB4x9YfCu7CSSntkU+eUBh3564820H6r9tPyDHC6vil1DNuoW4NeX/WsEfYcojYlPo5YgnYHC0D3oJwckZQB8/L5nVLzXubHAoGBAPww7YXCgsruxetFWYo2U/k4oJVdwISs4YTgctYeZ0Ovb3+Gzv1j6UlOVyisDWWVdGvAw/paPurOsKIMgqN+kdcW6B8QSXNUgQ2qCTc0x6fkQBepErGxBAAVdlNojZpMIbpY7ZNWF3XC8TY5o3LO0aDD6J2TEY4+27u/kLy6GCCnAoGAdcTJlprGq0r9TLVItOhx8v/g+PBFfKmEQN/oJhv9VvnHHry1PBcW2ILWnEwlZ/XKaKTp35eJx2PVqC9HYdzsjAzSSH5zGdMdkLV339ZiQGqTyBtVDLYEN31W2CDVS79Pc2p5UtyhTY2hgIIAqzVOSlUq831w/Ix6iZA+25yJ/PkCgYEAz8TbmwyyRtBK3NcourahnjyqCATSPDxWG+vykDdCKkBZ4r3EwHvU0aEqK4b8Don//Vo124cIONkKKqeV5W68ZnEn0ZfQe6TOIdzJdOMV7lsc9qFDloNY4VzNPFByAQHh862aJX2THGD76wm3gDml+QYOGev1VbSxwU9Exkem4xcCgYEA/kgHFpAQcqwRH/zaRfTHjP250qTlJxZU0Y7qnVIUkLWpg1humFLhIE+TuQslw+EYZV53vltloCosGNi1gyfr4YRU32fFvPOYGZUyjYNHufYEZU5YRjmCc8gxqF4MFt1xlOjhsuMTqGrzDi5O64a7vgYY80loZOYD0Pcnw88EdNk=',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        //     'level' => 'debug'
        ],

        // optional，设置此参数，将进入沙箱模式
         'mode' => 'dev',
    ],

    'wechat' => [
        // 公众号 APPID
        'app_id' => '',

        // 小程序 APPID
        'miniapp_id' => '',

        // APP 引用的 appid
        'appid' => '',

        // 微信支付分配的微信商户号
        'mch_id' => '',

        // 微信支付异步通知地址
        'notify_url' => '',

        // 微信支付签名秘钥
        'key' => '',

        // 客户端证书路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => '',

        // 客户端秘钥路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => '',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
//             'level' => 'debug'
        ],

        // optional
        // 'dev' 时为沙箱模式
        // 'hk' 时为东南亚节点
        // 'mode' => 'dev',
    ],
];
