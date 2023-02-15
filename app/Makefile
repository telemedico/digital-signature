PHP_CONTAINER = esignature
EXEC = docker exec -it $(PHP_CONTAINER)
EXEC_PHP = $(EXEC) php -d memory_limit=-1

sh:
	$(EXEC) sh

phpstan:
	$(EXEC_PHP) vendor/bin/phpstan analyse -c phpstan.neon
cc:
	$(EXEC_PHP) bin/console cache:clear

