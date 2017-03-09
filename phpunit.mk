#------------------------------------------------------------------------------
# PHPUnit
#------------------------------------------------------------------------------
CONTAINER_NAME=puzzle/assert/phpunit

phpunit = docker run -it --rm --name phpunit \
	                 -v ${PUZZLE_ASSERT_DIR}:/usr/src/puzzle-assert \
	                 -w /usr/src/puzzle-assert \
	                 -u ${USER_ID}:${GROUP_ID} \
	                 ${CONTAINER_NAME} \
	                 vendor/bin/phpunit $1 $(CLI_ARGS)

phpunit: vendor/bin/phpunit create-phpunit-image
	$(call phpunit, )

phpunit-coverage: vendor/bin/phpunit create-phpunit-image
	$(call phpunit, --coverage-html=coverage/)

vendor/bin/phpunit: composer-install

create-phpunit-image:
	docker build -q -t ${CONTAINER_NAME} docker/images/phpunit/

clean-phpunit-image:
	docker rmi ${CONTAINER_NAME}

.PHONY: phpunit create-phpunit-image clean-phpunit-image
