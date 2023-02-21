# digital-signature

Digital signature app

## How to start

1. `git clone git@github.com:telemedico/digital-signature.git`
2. `cd digital-signature`
3. `docker-compose up -d`
4. `cd ./app`
5. `make sh`
6. `composer install`
7. `php bin/console lexik:jwt:generate-keypair` (once, before the first start)
8. Open `http://localhost:8079/api/docs`

## Login data 

`{"username":"user","password":"X7VmcLBscqu9XvY"}`
