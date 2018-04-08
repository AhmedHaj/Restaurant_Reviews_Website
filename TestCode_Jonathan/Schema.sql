--This code supports the website  DeepCan.com
  
--Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
--Last Updated: 2018-04-07


--It is recommended that the tables be inserted one-by-one to verify proper table creation.
--Due to foreign key constraints the tables must be added in the right order.


--1.Rater:


CREATE TABLE rater(
   UserID     VARCHAR(4) NOT NULL PRIMARY KEY
  ,email      VARCHAR(21) NOT NULL
  ,name       VARCHAR(15) NOT NULL
  ,joindate   DATE  NOT NULL
  ,type       VARCHAR(11) NOT NULL
  ,reputation INTEGER  NOT NULL CONSTRAINT valid_reputation CHECK (reputation > 0 AND reputation < 6)
);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA1','MojithaS@gmail.com','Mojitha Said','2005-01-25','Online',3);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA2','WilliamW@hotmail.com','William Warren','2004-08-17','Blog',5);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA3','GregF@yahoo.com','Greg Ferguson','2007-06-25','Food Critic',2);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA4','EvanR@gmail.com','Evan Roberts','2004-07-15','Online',4);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA5','JonathanL@hotmail.com','Jonathan Lee','2005-06-20','Online',4);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA6','MimiV@gmail.com','Mimi Vladimir','2011-03-19','Blog',1);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA7','HapS@live.co.uk','Hap Sully','2005-10-09','Online',2);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA8','EmilyW@gmail.com','Emily Warnecke','2011-12-11','Online',3);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA9','CelinaL@yahoo.com','Celina Lee','2012-11-11','Blog',5);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA10','RainaA@gmail.com','Raina Aber','2004-03-22','Food Critic',4);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA11','KristinaP@hotmail.com','Kristina Parker','2010-03-26','Food Critic',5);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA12','FatimaZ@gmail.com','Fatima Zuhair','2009-09-12','Blog',3);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA13','DannyW@gmail.com','Danny Wong','2012-10-11','Online',5);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA14','PaulL@yahoo.com','Paul Larry','2007-12-14','Blog',5);
INSERT INTO rater(UserID,email,name,joindate,type,reputation) VALUES ('RA15','BigPoppa@gmail.com','Drew Kale','2012-01-27','Online',2);





--2.Restaurant:


CREATE TABLE restaurant(
   RestaurantID VARCHAR(3) NOT NULL PRIMARY KEY
  ,Name         VARCHAR(24) NOT NULL
  ,Type         VARCHAR(8) NOT NULL
  ,URL          VARCHAR(36) NOT NULL
);
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R1','Ruth''s Chris Steakhouse','Western','https://www.ruthschris.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R2','Jadeland','Chinese','http://jadeland.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R3','Barberian''s Steak House','Western','http://barberians.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R4','Zab-E-Lee','Thai','http://www.zab-e-lee.biz/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R5','Injoy Indian Delights','Indian','http://www.injoyindian.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R6','Ray''s New York Pizza','Italian','https://www.raysnewyorkpizza.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R7','Tokyo Sushi','Japanese','http://cooknewton.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R8','Pancer''s Original Deli','Western','http://www.pancersoriginaldeli.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R9','Rocky''s Brick Oven Pizza','Italian','http://www.rockysbrickovenpizza.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R10','St. Charles Deli','Western','http://stcharlesdeli.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R11','Original Pancake House','Western','http://www.originalpancakehouse.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R12','Yang Sheng Restaurant','Chinese','http://yangshengottawa.ca/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R13','Shinka Sushi Bar','Japanese','http://www.shinkasushibar.com/');
INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R14','Yazunohana','Japanese','http://yuzunohana.ca/');






--3.Rating:

--NOTE: the current primary key as specified in the requirements prevents the same user from rating more than once per day

CREATE TABLE rating(
   UserID       VARCHAR(4) NOT NULL REFERENCES rater (userID)
  ,Date         DATE  NOT NULL 
  ,price        INTEGER  NOT NULL CONSTRAINT valid_price_rating CHECK (price > 0 AND price < 6)
  ,food         INTEGER  NOT NULL CONSTRAINT valid_food_rating CHECK (food > 0 AND food < 6)
  ,mood         INTEGER  NOT NULL CONSTRAINT valid_mood_rating CHECK (mood > 0 AND mood < 6) 
  ,staff        INTEGER  NOT NULL CONSTRAINT valid_staff_rating CHECK (staff > 0 AND staff < 6)
  ,comments     VARCHAR(166) NOT NULL
  ,restaurantID VARCHAR(3) NOT NULL REFERENCES restaurant (restaurantID)
  ,PRIMARY KEY(UserID,Date,restaurantID)
);
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2018-03-12',4,4,2,5,'Perfect Breakfast location.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2016-02-13',5,2,3,2,'Steak was too dry.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2017-03-28',2,1,4,4,'Sushi was excellent.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2018-02-14',4,4,1,5,'Food was okay.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2017-03-02',3,2,4,2,'Waitress was nice.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2017-05-28',1,4,2,3,'Food was great.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2018-07-22',3,5,1,4,'Drinks were phenomenal.','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2014-05-15',3,2,4,1,'The food was too salty.','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2014-05-25',3,4,2,4,'We waited more than 30 minutes for our food.','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2014-12-18',4,3,4,2,'Way too expensive for the quality it provides.','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2018-03-20',4,1,5,1,'a great morning atmosphere and excellent service','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2013-05-27',2,3,2,4,'the restaurant is packed make sure to give your name and number to a staff member','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2017-08-17',1,3,4,2,'Pack light if you''re coming here though, not much space around your seat to leave knapsacks and such.','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2016-07-19',2,3,3,4,'Our orders came out pretty quickly and my plate was filled with greens (it just looked as if it was a mountain of greens and potatoes)','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2015-08-05',3,4,1,5,'The seasoning on everything was to my liking and I didn''t have to add anything to them.','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2016-05-22',4,4,3,2,'If you want a meal that''s not too heavy in the morning','R2');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2014-04-13',2,2,3,4,'The portions for both were great','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2017-09-04',5,1,3,3,'portion sizes that match the price','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2014-01-14',2,2,4,1,'Good customer service.','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2015-10-12',4,3,4,3,'a solid bang for your buck','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2016-04-06',4,4,2,3,'No one had to wait too long for their food','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2014-12-03',1,2,1,3,'I found the chicken wings to be overcooked','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2017-03-14',3,5,2,4,'Sometimes it''s fantastic but other times it''s just good.','R3');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2017-11-02',2,2,3,4,'Caesar is an awesome server. Super friendly and loves to talk','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2015-07-16',4,2,4,2,'The restaurant was well kept and the lighting was not that bright.','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2013-03-29',2,4,2,1,'We were greeted at the door and seated quickly.','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2015-03-14',5,1,5,2,'Overall the service was consistently excellent both times that I''ve been here.','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2013-05-07',2,3,2,3,'had a promo that''s been going on for a while where you get 10% off if you take a picture and post either on Instagram or Facebook while tagging them and their hashtag','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2014-01-27',1,2,2,4,'I''ll definitely come by again to see if this place is consistently as good as it was today','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2017-03-24',4,4,4,2,'Service is friendly but uneven and understaffed','R4');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2013-09-18',5,2,1,5,'Excellent bread. I think it is Art is In bakery','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2015-01-29',3,5,3,2,'Perfect Breakfast location.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2013-08-19',2,2,2,2,'Steak was too dry.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2015-01-31',1,1,4,4,'Sushi was excellent.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2013-07-06',3,4,2,1,'Food was okay.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2013-10-10',2,5,5,3,'Waitress was nice.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2013-01-26',4,3,2,2,'Food was great.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2013-05-09',5,2,1,4,'Drinks were phenomenal.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2016-10-26',2,1,4,2,'The food was too salty.','R5');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2014-12-18',1,3,5,5,'We waited more than 30 minutes for our food.','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2018-04-09',3,2,3,2,'Way too expensive for the quality it provides.','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2017-09-26',4,4,2,1,'a great morning atmosphere and excellent service','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2016-05-28',2,5,1,4,'the restaurant is packed make sure to give your name and number to a staff member','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2013-12-23',1,2,3,5,'Pack light if you''re coming here though, not much space around your seat to leave knapsacks and such.','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2017-01-08',4,1,2,3,'Our orders came out pretty quickly and my plate was filled with greens (it just looked as if it was a mountain of greens and potatoes)','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2017-12-11',2,3,4,2,'The seasoning on everything was to my liking and I didn''t have to add anything to them.','R6');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2015-06-13',1,4,5,1,'If you want a meal that''s not too heavy in the morning','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2017-05-13',3,2,2,3,'The portions for both were great','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2015-06-20',4,1,1,2,'portion sizes that match the price','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2016-03-08',2,4,3,4,'Good customer service.','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2017-10-23',1,2,4,5,'a solid bang for your buck','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2017-03-10',4,1,2,2,'No one had to wait too long for their food','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2013-04-05',2,3,1,1,'I found the chicken wings to be overcooked','R7');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2013-07-11',1,4,4,3,'Sometimes it''s fantastic but other times it''s just good.','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2014-10-28',3,2,2,4,'Caesar is an awesome server. Super friendly and loves to talk','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2017-03-09',4,1,1,2,'The restaurant was well kept and the lighting was not that bright.','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2016-03-06',2,4,3,1,'We were greeted at the door and seated quickly.','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2014-09-10',1,2,4,4,'Overall the service was consistently excellent both times that I''ve been here.','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2017-04-13',4,1,2,2,'had a promo that''s been going on for a while where you get 10% off if you take a picture and post either on Instagram or Facebook while tagging them and their hashtag','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2016-06-01',3,3,1,1,'I''ll definitely come by again to see if this place is consistently as good as it was today','R8');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2015-03-23',2,4,4,3,'Service is friendly but uneven and understaffed','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2014-04-19',1,2,2,4,'Excellent bread. I think it is Art is In bakery','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2015-03-24',4,1,1,2,'Perfect Breakfast location.','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2014-07-10',2,4,3,1,'Steak was too dry.','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2014-01-19',1,3,4,4,'Sushi was excellent.','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2016-04-19',2,2,2,2,'Food was okay.','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2017-11-08',4,1,1,1,'Waitress was nice.','R9');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2014-04-18',2,4,4,3,'Food was great.','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2016-11-15',1,2,3,4,'Drinks were phenomenal.','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2017-02-03',4,1,2,2,'The food was too salty.','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2016-04-19',3,2,1,1,'We waited more than 30 minutes for our food.','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2017-07-05',1,4,4,4,'Way too expensive for the quality it provides.','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2013-12-13',2,2,2,3,'a great morning atmosphere and excellent service','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2013-06-18',4,1,1,2,'the restaurant is packed make sure to give your name and number to a staff member','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2014-02-19',2,4,2,1,'Pack light if you''re coming here though, not much space around your seat to leave knapsacks and such.','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2013-03-15',1,3,4,4,'Our orders came out pretty quickly and my plate was filled with greens (it just looked as if it was a mountain of greens and potatoes)','R10');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2015-10-09',2,1,2,2,'The seasoning on everything was to my liking and I didn''t have to add anything to them.','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2014-10-19',1,2,1,1,'If you want a meal that''s not too heavy in the morning','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2013-05-30',3,4,4,2,'The portions for both were great','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2013-08-12',2,2,3,4,'portion sizes that match the price','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2013-04-27',1,1,1,2,'Good customer service.','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2014-01-06',4,2,2,1,'a solid bang for your buck','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2017-10-29',2,1,4,4,'No one had to wait too long for their food','R11');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2015-04-21',5,3,2,3,'I found the chicken wings to be overcooked','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2013-01-12',3,2,1,1,'Sometimes it''s fantastic but other times it''s just good.','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2015-12-17',1,1,2,2,'Caesar is an awesome server. Super friendly and loves to talk','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2015-10-23',5,4,1,4,'The restaurant was well kept and the lighting was not that bright.','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2014-09-30',3,2,3,2,'We were greeted at the door and seated quickly.','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2015-08-10',1,5,2,1,'Overall the service was consistently excellent both times that I''ve been here.','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2016-08-20',2,3,1,2,'had a promo that''s been going on for a while where you get 10% off if you take a picture and post either on Instagram or Facebook while tagging them and their hashtag','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2018-03-09',3,1,4,1,'I''ll definitely come by again to see if this place is consistently as good as it was today','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA3','2017-12-11',2,5,2,3,'Service is friendly but uneven and understaffed','R12');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA5','2016-03-22',2,3,5,2,'Excellent bread. I think it is Art is In bakery','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA9','2015-12-16',1,1,3,1,'Perfect Breakfast location.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2014-11-20',1,2,1,4,'Steak was too dry.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA10','2016-03-06',4,3,5,2,'Sushi was excellent.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2016-09-09',2,2,3,5,'Food was okay.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2018-02-21',2,2,1,3,'Waitress was nice.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2015-08-20',5,1,2,1,'Food was great.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2013-07-01',5,1,3,5,'Drinks were phenomenal.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA15','2014-06-01',2,4,2,3,'The food was too salty.','R13');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA11','2014-07-17',3,2,2,1,'We waited more than 30 minutes for our food.','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA13','2018-02-13',1,2,1,2,'Way too expensive for the quality it provides.','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA14','2017-05-13',1,5,1,3,'a great morning atmosphere and excellent service','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA12','2017-06-28',4,5,4,2,'the restaurant is packed make sure to give your name and number to a staff member','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA2','2017-12-06',5,2,2,2,'Pack light if you''re coming here though, not much space around your seat to leave knapsacks and such.','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA4','2013-03-09',3,3,2,1,'Our orders came out pretty quickly and my plate was filled with greens (it just looked as if it was a mountain of greens and potatoes)','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA6','2017-06-07',2,1,5,1,'The seasoning on everything was to my liking and I didn''t have to add anything to them.','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA7','2016-08-08',1,1,5,4,'If you want a meal that''s not too heavy in the morning','R14');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA8','2016-08-31',2,4,2,2,'The portions for both were great','R14');








--4.Location:


CREATE TABLE location(
   LocationID      VARCHAR(3) NOT NULL PRIMARY KEY
  ,firstopendate   DATE  NOT NULL
  ,managername     VARCHAR(19) NOT NULL
  ,phonenumber     VARCHAR(13) NOT NULL
  ,streetaddress   VARCHAR(44) NOT NULL
  ,houropen        TIME  NOT NULL
  ,hourclose       TIME  NOT NULL
  ,restaurantID    VARCHAR(3) NOT NULL REFERENCES restaurant (restaurantID)
);
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L1','2012-12-30','Mark Graham','201-863-5100','1000 Harbor Blvd., Weehawken, 07086','9:00','17:00','R1');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L2','1992-03-30','Robert Shabob','212-245-9600','148 West 51st Street, New York, 10019','10:00','18:30','R1');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L3','2002-01-04','Zinoviy Daniel','516-222-0220','600 Old Country Road, Garden City, 11530','9:30','18:00','R1');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L4','1989-11-22','Girish Lee','613-233-0204','625 Somerset St. W, Ottawa, ON, K1R 5K3','9:00','20:00','R2');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L5','1997-05-29','Georgina Moti','416-598-1114','500-75 Sherbourne St, Toronto, ON, M5A 2P9','13:00','23:00','R2');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L6','2003-10-02','Jonathan Calles','780-675-5009','19-2501 41 Ave , Athabasca, AB, T9S 1V7','11:00','23:00','R3');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L7','1988-08-01','Finley Viljem','780-675-1145','215 Jasper Way, Banff, AB, T1L','10:30','22:30','R4');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L8','1985-02-13','Hanna Spiridon','613-283-5161','65 Chambers St 1, Smiths Falls, ON, K7A 2Y5','6:00','18:30','R5');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L9','2009-08-15','Letha Nada','450-263-9707','331 Bernard Rue, Cowansville, QC, J2K 3W2','13:00','0:30','R6');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L10','2000-12-14','Widald Samet','905-775-6836','5 Brownlee Dr Bradford, ON, L3Z 2A4','7:30','18:30','R7');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L11','1999-12-30','Martin Deepak','613-565-9735','170 Lees Ave, Ottawa, ON, K1S 5G5','8:00','21:00','R8');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L12','2006-06-06','Kirsi Chipo','613-730-4172','43 Aylmer Ave, Ottawa, ON, K1S 5R4','9:00','21:00','R9');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L13','2011-08-18','Thancmar Diksha','613-226-8537','8 Birchview Rd, Nepean, ON, K2G 3G4','11:00','21:30','R10');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L14','2009-07-06','Camilla Anu','613-723-5853','1311 Morley Blvd, Ottawa, ON, K2C 1R1','11:00','21:00','R10');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L15','2010-01-03','Cassander Tancredi','205-933-8837','6840 East Camelback Road, Scottsdale, 85251','9:00','20:00','R11');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L16','1997-08-13','Austyn Eve','613-235-5794','662 Somerset St W, Ottawa, ON, K1R 5K4','11:00','23:00','R12');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L17','1973-05-05','Nitika Goretti','613-565-8998','150 Laurier Ave. West, Ottawa, ON, K1P 5J4','10:30','22:30','R13');
INSERT INTO location(LocationID,firstopendate,managername,phonenumber,streetaddress,houropen,hourclose,restaurantID) VALUES ('L18','1992-01-28','Mario Pittman','416-205-9808','236 Adelaide St W, Toronto, ON, M5H 1W7','6:00','18:30','R14');






--5.Menu Item:


CREATE TABLE menuItem(
   ItemID       VARCHAR(3) NOT NULL PRIMARY KEY
  ,name         VARCHAR(40) NOT NULL
  ,type         VARCHAR(8) NOT NULL
  ,category     VARCHAR(7) NOT NULL
  ,description  VARCHAR(378) NOT NULL
  ,price        DECIMAL(5,2) NOT NULL CONSTRAINT positive_price CHECK (price > 0)
  ,RestaurantID VARCHAR(3) NOT NULL REFERENCES restaurant (restaurantID)
);
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M1','Fried Fish Slices','food','main','Better than sushi',22.78,'R1');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M2','Spicy Cold Chicken','food','main','Perfect for that summer heat',15.68,'R1');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M3','Clotted Cream Splits','food','dessert','A grown up twist on an old classic from your child hood',21.54,'R1');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M4','Rolled Meatloaf','food','main','Carefully rolled',6.41,'R2');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M5','Crunchy Pumpkin Seeds','food','starter','Properly toasted they are wonderfully crunchy to eat',10.80,'R2');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M6','El Presidente','beverage','dessert','This classic rum cocktail is refreshing and full of flavor.',21.23,'R2');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M7','French Bread Sauce','food','starter','Extremely light and tasty',24.29,'R3');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M8','Molten Light Beer','beverage','main','Spicy craft beer',5.64,'R3');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M9','Bacon and Veal Neck Casserole','food','main','This is a simple casserole, which is packed full of flavour',17.72,'R3');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M10','Diesel Fuel','beverage','dessert','Jagermeister, Rum',10.57,'R4');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M11','Turkey bites with tomato and fruit salsa','food','starter','From our freshly picked fruits imported from local farms',6.83,'R4');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M12','Rachel''s cupcakes','food','dessert','An in house recipe passed from generation to generation',17.87,'R4');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M13','WaterMelon Shooter Virginia Style','beverage','dessert','Creme d''Almond, Pineapple Juice, Southern Comfort, Vodka',15.91,'R4');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M14','Honey BBQ chicken kebabs','food','main','Skewed to perfection, honey glazed chicken',24.50,'R5');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M15','Very boozy Christmas cake','food','dessert','Don''t share with the kids',13.50,'R5');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M16','Cheeseburger Apocalypse','food','main','I know fast food is bad for you, but this is ridiculous!',18.88,'R6');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M17','Alien Blood','beverage','dessert','Coffee with a strangely red hue',8.99,'R6');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M18','Fresh blackberry cobbler','food','dessert','Name says it all',12.24,'R6');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M19','Shiokara','food','main','Now this really does sound bad. A dish made of pieces of meat taken from a selection of sea creatures, served in a brown, viscous paste of their own salted and fermented viscera. Oh, I forgot to say, it’s all served raw. You enjoy, I’m going to grab a bucket.',7.45,'R7');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M20','Jing Leed','food','main','So, yes, this is a big old grasshopper seasoned with salt, pepper power and chilli and fried in a big wok. Tastes a little like hollow popcorn skin… except a little juice squirts out when you bite into it… nice.',11.54,'R7');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M21','Frozen Caramel Coffee Coolatta','beverage','dessert','The large Frozen Caramel Coffee Coolatta not only has more calories than a Big Mac but it has more calories than an entire Double Cheeseburger meal with medium fries and Coca-Cola',21.70,'R7');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M22','Coconut and lime rice','food','main','Put the lime in the coconut, then put it in rice',16.23,'R8');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M23','Bird’s Nest Soup','food','starter','This Asian delicacy is made from the nest of the swiftlet bird, who instead of collecting twigs for its bed, builds it out of its own gummy saliva, which goes hard when exposed to air. Usually the built high up on cliff faces, harvesting them is a dangerous business and many people die each year. Whether its ‘rubbery taste’ is worth this human sacrifice, I’ve yet to find out.',23.84,'R8');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M24','Cherry Blossom Meat','food','main','Cherry blossom meat is raw horse, served either on its own or as part of sushi. It’s said to be low in calories and low in fat, but it’s not something I can see myself trying, despite savouring the raw flesh of cows.',8.26,'R8');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M25','Rainbow Beer','beverage','dessert','Japan’s Abashiri Brewery is best known for its line of brightly colored beers that includes blue Ryuhyo Draft, red Hamanasu Draft, green Shiretoko Draft and pink/purple Jyaga Draft.',16.48,'R9');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M26','Fluffy Scrambled Eggs','food','starter','Just like your regular scrambled eggs, but fluffy.',5.65,'R9');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M27','Tuna Eyeballs','food','starter','Although it sounds nasty, apparently it’s rather tame, tasting pretty similar to squid or octopus.',12.05,'R9');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M28','Gluten-free Pancakes','food','dessert','Apparently, they are also low in fat',3.72,'R10');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M29','Twelve Mile Limit','beverage','dessert','A forgotten cocktail from the era of Prohibition, the Twelve Mile Limit is one of the booziest cocktails you''ll ever drink.',10.98,'R10');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M30','Baked Alaska','food','dessert','Not only do you set this dessert on fire, but it also requires you to make a sponge cake, top it with ice cream (which you bake, but don’t let melt) and then add the meringue.',14.00,'R10');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M31','Green Ghost','beverage','dessert','This tasty drink highlights the Chartreuse and will impress anyone who likes a pretty drink because unlike many pretty drinks, this one has flavor to match its beauty.',16.94,'R11');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M32','Cheesy Nachos','food','starter','Nachos with a whole lot of cheese.',4.13,'R11');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M33','Pepsi','beverage','main','Better than Coca-Cola',3.14,'R11');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M34','Bermuda Black','beverage','dessert','Fresh ginger juice adds heat, rum adds richness, and lime juice keeps it bright.',3.41,'R11');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M35','Lettuce Wraps','food','starter','Lettuce with chicken, tza tziki, and your choice of sauce',13.67,'R12');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M36','Fajitas','food','main','Your choice of chicken, beef, or shrimp fajitas',22.96,'R12');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M37','Camel milk cocktail','beverage','dessert','A non-alcoholic cocktail originally created for Muslims fasting during Ramadan.',17.37,'R13');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M38','Baumkuchen','food','dessert','Just look at all the layers! To make this European dessert, cake batter is poured in layers over a continuously revolving spit in front of an open flame. Each layer of cake must brown before the next one is added.',12.82,'R13');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M39','Country-Grilled Steak','food','main','Country-style Steak grilled to your liking',9.36,'R13');
INSERT INTO menuItem(ItemID,name,type,category,description,price,RestaurantID) VALUES ('M40','Chocolate Ice-cream','food','dessert','Do you really need a description?',13.58,'R13');







--6.Rating Item:


CREATE TABLE ratingItem(
   UserID  VARCHAR(4) NOT NULL REFERENCES rater (userID)
  ,Date    DATE  NOT NULL
  ,ItemID  VARCHAR(3) NOT NULL
  ,rating  INTEGER  NOT NULL CONSTRAINT valid_rating CHECK (rating > 0 AND rating < 6)
  ,comment VARCHAR(166) NOT NULL
  ,PRIMARY KEY(UserID,Date,ItemID)
);
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA1','2015-05-02','M1',2,'Perfect Breakfast location.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA3','2016-03-15','M1',1,'Steak was too dry.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA5','2018-01-17','M3',4,'Sushi was excellent.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA9','2017-12-29','M4',2,'Food was okay.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA8','2017-05-13','M5',5,'Waitress was nice.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA10','2016-04-29','M6',3,'Food was great.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA2','2018-01-25','M7',1,'Drinks were phenomenal.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA4','2017-01-24','M8',2,'The food was too salty.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA6','2015-07-16','M9',3,'We waited more than 30 minutes for our food.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA7','2016-09-27','M10',1,'Way too expensive for the quality it provides.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA15','2016-02-23','M11',2,'a great morning atmosphere and excellent service');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA11','2013-11-02','M12',3,'the restaurant is packed make sure to give your name and number to a staff member');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA13','2013-07-26','M13',2,'Pack light if you''re coming here though, not much space around your seat to leave knapsacks and such.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA14','2016-03-31','M14',2,'Our orders came out pretty quickly and my plate was filled with greens (it just looked as if it was a mountain of greens and potatoes)');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA12','2017-03-15','M15',1,'The seasoning on everything was to my liking and I didn''t have to add anything to them.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA1','2013-04-24','M16',1,'If you want a meal that''s not too heavy in the morning');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA3','2016-05-24','M16',4,'The portions for both were great');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA5','2017-06-17','M16',2,'portion sizes that match the price');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA9','2016-08-27','M18',2,'Good customer service.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA8','2014-12-11','M20',5,'a solid bang for your buck');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA10','2014-10-26','M21',5,'No one had to wait too long for their food');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA2','2016-08-22','M22',2,'I found the chicken wings to be overcooked');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA4','2014-08-13','M23',3,'Sometimes it''s fantastic but other times it''s just good.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA6','2015-07-09','M24',1,'Caesar is an awesome server. Super friendly and loves to talk');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA7','2018-02-23','M24',1,'The restaurant was well kept and the lighting was not that bright.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA15','2013-04-15','M26',4,'We were greeted at the door and seated quickly.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA11','2018-01-01','M27',1,'Overall the service was consistently excellent both times that I''ve been here.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA13','2014-01-23','M28',3,'had a promo that''s been going on for a while where you get 10% off if you take a picture and post either on Instagram or Facebook while tagging them and their hashtag');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA14','2013-09-07','M29',4,'I''ll definitely come by again to see if this place is consistently as good as it was today');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA12','2016-04-21','M30',2,'Service is friendly but uneven and understaffed');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA1','2015-10-12','M31',1,'Excellent bread. I think it is Art is In bakery');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA3','2018-03-14','M31',4,'Perfect Breakfast location.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA5','2014-09-22','M33',3,'Steak was too dry.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA9','2017-12-26','M34',2,'Sushi was excellent.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA8','2017-10-06','M35',1,'Food was okay.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA10','2014-11-17','M35',4,'Waitress was nice.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA2','2015-05-26','M37',2,'Food was great.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA4','2014-06-25','M38',1,'Drinks were phenomenal.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA6','2017-09-05','M38',2,'The food was too salty.');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA7','2013-07-31','M40',4,'We waited more than 30 minutes for our food.');




--updates to improve data to better reflect the queries
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2018-03-10',5,5,5,2,'Excellent Service!','R1');
INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('RA1','2018-04-04',1,1,3,2,'Service was bad today','R1');
INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('RA1','2015-05-02','M3',1,'I did not like it very much');