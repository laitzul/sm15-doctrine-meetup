#!/usr/bin/env bash

bin/console doc:data:drop --force;
bin/console doc:data:create;
bin/console doc:mig:mig --no-interaction;
bin/console app:seed:user;
bin/console app:seed:product;
bin/console app:seed:notification;