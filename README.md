yandex-api-webmaster
====================

Credentials?
------------
How to get a token? No matter. Choose your way [https://tech.yandex.com/oauth/doc/dg/concepts/ya-oauth-intro-docpage/](https://tech.yandex.com/oauth/doc/dg/concepts/ya-oauth-intro-docpage/)

How to use?
-----------
```php
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;
use YandexWebmaster\Http\Client;

$client = Client::create('client_id', 'client_password');
$user = new User('user_id', new Token('token'));

try {
    $action = new \YandexWebmaster\Action\AddSiteAction($user, 'example.com');
    $client->call($action);
} catch (\Yandex\Exception\YandexException $ex) {
    //TODO: maybe write to log...
}
```

Action => Return Type
---------------------
Action | Type | Notes
------ | ---- | -----
GetUserIdAction | int | -
AddSiteAction | string | Host ID
AddOriginalTextAction | OriginalText | -
AddSitemapAction | string | Sitemap ID
DeleteOriginalTextAction | true | -
DeleteSiteAction | true | -
DeleteSitemapAction | true | -
GetListOfSitesAction | Site[] | -
GetSiteAction | Site | -
GetSiteOwnersAction | SiteOwner | -
GetSiteStatAction | SiteStat | -
GetSiteVerificationStatusAction | SiteVerificationStatus | -
VerifySiteAction | SiteVerificationStatus | -