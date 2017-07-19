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

## API documentation
Based on [http://apidocjs.com](http://apidocjs.com)

### First do it
```bash
$ apt-get install node
$ npm install -g apidoc
$ chmod +x generate-docs.sh
```
### Generate docs after adding new functionality
```bash
$ ./generate-docs.sh
```
### Simple preview in browser
```bash
php -S localhost:8090 -t api-doc
```
then open [http://localhost:8090](http://localhost:8090) in Your browser

## Testing
```bash
vendor/bin/codecept run 
```