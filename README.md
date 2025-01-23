## About Challenge

This is a coding challenge from Innoscripta. It is for three sources
- The Guardian
- New York Times
- News API Org

### Steps to install and run
**_All the commands down below should be run in project's root directory_**
1. Clone the repository by running the following command
```sh
git clone git@github.com:ismail17719/news-aggregator-challenge.git
```
2. Open the terminal and go to the project root directory
3. Run the composer command to install all dependencies
```sh
composer install
```
4. Open .env.example and save it as .env file in the same root directory
5. Open .env file and change the following database details
```
DB_CONNECTION=sqlite
```

6. Run the following command to generate a unique for the application
```sh
php artisan key:generate
```
7.  Next we need to build the database. In order to do that run the following command in terminal. Let the process complete
```sh
php artisan migrate
```
8. In order to fetch the articles, run the following command.
```sh
php artisan schedule:run
```
9. After the above command, the aggregator job is queued. Therefore, you need to run the following command to actually run fetching the articles
```sh
php artisan queue:work
```
9. Congrats!! You are done. Everything else is done for. Now checkout the routes/api.php route file to see and test different routes. You can make http requests using something like Postman or Insomnia.  
 :boom: :boom: :boom:
