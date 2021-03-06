# Step 2. Displaying newsline using WACT-template
## Creating database table for news and filling it with data

Create an empty database according to settings in **~crud/settings/db.conf.php** file if not yet. Our project requires just a single table «news». Here is SQL schema for «news» table:

    CREATE TABLE `news` (
      `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
      `title` VARCHAR(255) NOT NULL DEFAULT '',
      `annotation` text NOT NULL,
      `content` longtext NOT NULL,
      `date` DATE NOT NULL DEFAULT '0000-00-00',
      PRIMARY KEY  (`id`),
      KEY `date` (`date`)
    ) TYPE=MyISAM;

Now let's fill «news» table with some initial data:

    INSERT INTO `news` VALUES (3,'We finished model part','Model is finished.','Model is finished. And more text here!','2006-08-15');
    INSERT INTO `news` VALUES (4,'We finished view partfds','All templates are ready!','We created display.html, detail_display.html, create.html, edit.html, admin_display.html','2006-08-16');
    INSERT INTO `news` VALUES (5,'Controller is finished','Controller is ready now!','The most difficult part was to describe controller!','2006-08-17');
    INSERT INTO `news` VALUES (6,'Basic tutorial is finished and ready to be published','All pages are ready as well as php-code. Now it\'s time to rock\'n\'roll!','','2006-08-18');
    
You can find this sql code in archive of crud demo application that can be downloaded from http://projects.limb-project.com. For MySQL use init/db.mysql, for SQLite use init/db.sqlite

## Creating Model class being "news" table gateway
WEB_APP package follows MVC (Model-View-Controller) pattern. It means that our application can be logically divided into three separate components:

* Model (stores base and handles business logic),
* View (renders presentation logic) and
* Controller (controls application flow).

First we need a Model for our application. Let's create **~crud/src/model/** folder and place **News.class.php** in it with the following contents:

    <?php
    lmb_require('limb/active_record/src/lmbActiveRecord.class.php');
 
    class News extends lmbActiveRecord
    {
    }
    ?>

lmbActiveRecord class follows ActiveRecord pattern which means that there is a class encapsulating business logic, database access and acting as a data container at the same time.

lmbActiveRecord class can be found in [ACTIVE_RECORD package](../../../../active_record/docs/en/active_record.md). Limb3 implementation of ActiveRecord pattern follows in many points Ruby-on-Rails ActiveRecord implementation.

News class automatically determines that it should store data in «news» table. Actually lmbActiveRecord tries to guess the table name by converting CamelCased class name to under_scored variant if it's not specified explicitly.

Creating Controller class for news

The term controller can be interpreted in different ways, but in our case controller is a class that «knows» what to do when a user requests some specific functionality, e.g. requests a newsline to be displayed.

So, we need a controller for our newsline. Let's create **~crud/src/controller/** folder and place **NewsController.class.php** file in it with simple php-code:

    <?php
    lmb_require('limb/web_app/src/controller/lmbController.class.php');
 
    class NewsController extends lmbController
    {
    }
    ?>

NewController is just inherits from lmbController and we don't need anything else in our controller just to display newsline.

## Creating template to display newsline
Now it's time for the View part of our project. Generally with Limb3 you don't need to create any View classes — as you will see WACT templates are pretty powerful enough to avoid any additional classes.

Create a folder **~crud/template/news/** for templates and put **display.html** file with the following contents:

    <html>
    <head>
      <title>Newsline</title>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    </head>
    <body>
    <h1>Newsline.</h1>
    </body>
    </html>

It's time to check if we are doing everything right. Type http://%tutorial_address%/news in your browser and you should see a simple page with Newsline title on it.

Now we will display the newsline. To do so we have to modify our ~crud/template/news/display.html (next time we will use a shortcut of path, like news/display.html) template as follows:

    <html>
    <head>
      <title>Newsline</title>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    </head>
    <body>
    <h1>Newsline.</h1>
 
    <active_record:fetch using='src/model/News' target="news" />
 
    <list:LIST id="news">
      <table border="1">
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Title</th>
      </tr>
      <list:ITEM>
      <tr>
        <td>{$id}</td>
        <td>{$date}</td>
        <td>{$title}</td>
      </tr>
      <tr>
        <td colspan='3'>
          {$annotation}
        </td>
      </tr>
      </list:ITEM>
      </table>
    </list:LIST>
    </body>
    </html>

Limb3 uses WACT template engine by default.

The main elements of WACT templates are tags and output expressions. Let's briefly explain what elements of the template engine were used here:

* `<active_record:fetch>` tag is used to fetch data from class specified by **using** attribute (this is our News class) and to transfer fetched data to the component named by **target** attribute. In our case, `<list:list>` with id news will get all the fetched data.
* `<list:LIST>` uses to output lists and tables. The part that lies within `<list:ITEM>` tag is repeated for each record.
* With several output expression like {$date}, {$title}, {$annotation} we display values of each news.

As a result, you should see at http://%tutorial_address%/news something like this:

![Alt-simple_list](http://wiki.limb-project.com/2011.1/lib/exe/fetch.php?cache=&media=limb3:ru:tutorials:basic:simple_list.png)

WACT also supports raw php-blocks in templates so we can skip `<active_record:fetch>` usage and retrieve data with php:

    <html>
    [...]
    <h1>Newsline.</h1>
 
    <?php 
       lmb_require('src/model/News.class.php');
       $news = lmbActiveRecord :: find('News');
    ?>
 
    <list:LIST from="$news">
      [...]
    </list:LIST>
    </body>
    </html>

WACT — is a powerful, extensible and fast template engine. We recommend reading documentation for WACT after completing this tutorial.

Here is a short list of pages that are «a must read» for any WACT user:

* "Introduction to WACT template engine" — about key WACT elements.
* "The compilation and execution of WACT template, runtime components and hierarchy of datasources in template" — describes how WACT ticks. Understanding of the internal structure of the engine is the key to its effective usage.

However it's ok to skip WACT readings and continue our tutorial.

## How news/display.html was displayed?
lmbController (parent class of our NewsController) can do a bit of «magic» by default. When we type http://%tutorial_address%/news in browser, Limb3 based application automatically looks for NewsController in src/controller/ folder and tries to activate controller with default action.

Default action is usually «display». If we typed http://%tutorial_address%/news/create then Limb3 would try to activate controller with «create» action.

When lmbController is activated with some action it tries to execute its class method called as doActionName()(e.g. doDisplay() or doCreate()) and performs it if one exists.

If no such method exists then lmbController just tries to find and render an appropriate template in templates folder of application named according to controller and action name. For example, for http://%tutorial_address%/news/ request template should be news/display.html, for http://%tutorial_address%/news/create — news/create.html. If template is not found or no such controller method exists 404 error will be displayed.

All this «magic» can remind you Ruby-on-Rails framework. Limb3 is not an exception, we really borrowed some ideas from Rails.

## What's next?
[Step 3. Adding forms to allow creating and editing news. Data validation. News removal.](./step3.md)
