# krafjp/dd

## Installation
Database definition tool provided by kraf is located in the krafjp/dd Composer  package, which may be installed using Composer:

```shell
composer require krafjp/dd
```


## Export html(blade) template
```shell
php artisan db:dd [--force]
```

## publish database definition document
```shell
php artisan db:dd-gen
```
Generate Database Definition Document Command.

### Usage:
```
db:dd-gen [options] [--] [<conn>]
```

### Arguments:
- conn                  db connection null by default
### Options:
- -m, --output-md       output format markdown.(default html)

