.DEFAULT_GOAL := help
.PHONY: help
.PHONY: refresh clean


help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

clean: ## Clean untracked migrations, databases / repositories and dependencies
	# Clean untracked migration to avoid migrations errors on refresh
	git clean -f -d src/Infrastructure/Migrations/
	rm -f var/*.repository
	rm -f var/metinet.db
	rm -fr vendor/

refresh: clean ## Clean project and start a fresh project (with new fixtures)
	composer install || php composer.phar install
	php bin/console doctrine:migrations:migrate -n
	php bin/console doctrine:fixtures:load -n
