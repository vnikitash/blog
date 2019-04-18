Edge cases
 - added validation for userCount parameter [1,1000000]
 - If users less that 50, max related users could be as count(*) from users - 1
 - if users count = 1 - no friends available
 - maximum amount of mysql requests could be 51M as 1 000 000 of users + 50 friends for each (Please assume this when you will make such request, it will take LONG time to execute)
 - For decreasing amount of mysql reuests i used CHUNKS of 10K rows per MySQL request for insert
 - For select I used pagination, as 51M rows per request to show is too much
 - As we have SO HUGE DB, and user has only 1 favourite color, would be doog to place this column in users table, to avoid LEFT JOINS for some colors table
 
 Available requests
 POST localhost/testdata - Produces [userCount] amount of data
 GET localhost/users/1/friends - get all friends list for user with id = 1. You can use [page] and [perPage] get parameters
 GET localhost/users/ - get all list of users with fav colors and friends list. You can use [page] and [perPage] get parameters
 
 How to run the project
 1) docker-compose up
 2) docker ps -> get webdevops/php:7.3 container id
 3) docker exec -it {id} bash
 4) cp .env.example .env && composer install && php artisan key:generate && php artisan migrate && exit
 5) on your MacOS/Linux change hosts file if you do not like to use localhost. Please note that in this case you need to change APP_URL parameter in .env file
 
 Enjoy. 
 If you will have questions contact me 
 email: nikitashvictor@gmail.com
 skype: nickstery