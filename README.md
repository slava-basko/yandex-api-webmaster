yandex-api-webmaster
====================

How to use?
-----------
```php
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;
use YandexWebmaster\Http\Client;

$client = Client::create('client_id', 'client_password');
$user = new User('user_id', new Token('token'));

$action = new \YandexWebmaster\Action\AddSiteAction($user, 'example.com');
$client->call($action);
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