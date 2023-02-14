PHP_CONTAINER = esignature
EXEC = docker exec -it $(PHP_CONTAINER)
EXEC_PHP = $(EXEC) php -d memory_limit=-1

sh:
	$(EXEC) sh

phpstan:
	$(EXEC_PHP) vendor/bin/phpstan analyse -c phpstan.neon

phpunit:
	$(EXEC_PHP) bin/phpunit tests/unit

tests-smoke:
	$(EXEC_PHP) vendor/bin/codecept run api -g smoke

tests-sanity:
	$(EXEC_PHP) vendor/bin/codecept run api -g smoke

deptrac:
	$(EXEC_PHP) vendor/bin/deptrac analyse

cc:
	$(EXEC_PHP) bin/console cache:clear

git-hooks:
	find .git/hooks -type l -exec rm {} \;
	find .githooks -type f -exec ln -sf ../../{} .git/hooks/ \;
