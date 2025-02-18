#!/bin/bash

bin/console doctrine:database:create --if-not-exists
bin/console d:s:u --force --complete
apache2-foreground