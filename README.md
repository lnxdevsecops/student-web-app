# student_web_app



* This application is going to connect with mysql database wiht "mysql" hostname and port 3306. This application will create a  database automatically in background.


* Make sure we create a custom bridge network while working on docker and deploy both app container and mysql container in same network.
> docker network create -d bridge student
 

* Running application on student network.
> docker run -d -p 8080:80  --name student-web-app  --network student   lnxadm1991/student-web-app


 * Create mysql container in student network with following command. Make sure container name should be mysql.
   
> docker run -d \
  --name mysql \
  -e MYSQL_ROOT_PASSWORD=Linux.adm@1 \
  -p 3306:3306 \
  --network student \
  mysql:latest


* There are two uris.

a. To access the index.html to insert the student score results.
http://184.72.94.168:8080/

b. The second to see the student score results.
http://184.72.94.168:8080/score.php


* Getting the error while inserting the data. However we can able to insert the data from page. Tried to fix the issue but I could not. Need to work on to fix the issue.

 Database created successfully.
Table created successfully.

Warning: Cannot modify header information - headers already sent by (output started at /var/www/html/process.php:20) in /var/www/html/process.php on line 63
