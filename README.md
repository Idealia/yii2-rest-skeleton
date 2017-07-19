# Yii2 REST skeleton
Yii2 REST app skeleton with oAuth2 authorization.

## Install
### Vendors
```bash
$ composer global require "fxp/composer-asset-plugin:^1.3.1"
$ composer install
```
### Create unversioned files
```bash
$ php init
```

### Database settings
Update database settings in *src/common/config/local.php*

### Database sample structure
```bash
$ php yii migrate
```

## Make documentation
```bash
$ sudo npm install -g apidoc
$ chmod +x doc.sh
$ ./doc.sh
```

## Testing
```bash
vendor/bin/codecept run 
```