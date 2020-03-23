<h1 align="center"> Rachel/wechat </h1>

<p align="center"> 这是基于laravel开发的微信公众号的组件</p>


## Installing

```shell
$ composer require rachel/wechat:mater-dev
```
## 配置文件发布

```shell
php artisan vendor:publish 
```
## Usage
```
laravel应用，在config/app.php注册serviceprovider和facede
"providers": [
                "Rachel\\Wechat\\Providers\\WechatServiceProvider"
            ]
```
```
浏览器访问路由http://localhost/swechat
Route::any('/','WeChatController@index')->middleware('swechat.check');
```
TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com//achel/wechat/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com//achel/wechat/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT