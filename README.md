# Symfony meetup #15 demo Skeleton app

## Setting up
After you clone this repository you will need to install any third party dependencies used by running `composer install`.  
Next step would be to copy the existing `.env` file to a new `.env.local` file and add your database connection string to it, in the DB_URL variable.  
Now let's run a `bin/console cache:clear` to make sure all is alright.  
In order to seed the data that we used you cah run the `./shell/reset-db.sh`command that contains some Symfony command calls to the commands defined in the `Command` folder.  
One command is a bit more special, the Buyer one, which we used to both seed the data (first part) and also execute the buyer movement in the line (second part). Uncomment and run as you wish.  

## Entities and Repos
* The User and AbstractEntity classes can show the use of events and callbacks
* The Buyer Repository demonstrates what we've tried with the query iterator
* The Product Entity, ProductRepository, ProductQueryBuilder and ProductController classes are an example of the custom repository QueryBuilder approach
* The Notification classes and stacks represent an example of the Single or Class Table Inheritance strategies. To switch between strategies, change the Notification class annotations to whatever strategy you like (JOINED, SINGLE_TABLE) and the generate and run a migration. You might want to run that `reset-db.sh` script again after doing this, to have some data in the new tables.
