# Zoe engineering test by Carlos Bernal

## Steps to setup a development environment

1. Install [Laravel Homestead](https://laravel.com/docs/5.7/homestead).
2. Clone the project.
3. Edit the `Homestead.yml` file to add the site `zoe-financial.test`. The site should map to the `public` folder of the project.
4. Edit the `Homestead.yml` file to add the database `zoe-financial`.
5. Edit the `hosts` file to map the domain `zoe-financial.test` to the Homestead local ip.
6. Copy to the contents of the `.env.example` file to a new `.env` file at the project root.
7. Start the Homestead virtual machine (`vagrant up`).
8. `SSH` into the Homestead virtual machine (`vagrant ssh`).
9. Install the PostGIS extension.
    ```bash
    sudo add-apt-repository ppa:ubuntugis/ubuntugis-unstable
    sudo apt-get update
    sudo apt-get install postgis
    ```
10. `cd` to project root inside the Homestead virtual machine.
11. Execute `composer install`
12. Execute `php artisan migrate --seed`. The seeding process can take a while, be patient.
13. Go to [http://zoe-financial.test](http://zoe-financial.test)

## About the solution

### The agent contact matcher

The agent-contact match was based on the distance (in meters) between the zip codes of each user type.

The system has a database table with all the U.S. zip codes and their corresponding latitude and longitude, which was obtained from the [United States Census Bureau](https://www.census.gov/geo/maps-data/data/gazetteer2018.html).

With the geographical information of each U.S. zip code, the system use the PostGIS PostgreSQL extension to find all the zip codes with in a certain radius ordered by distance, and then it matches such codes to all related contacts.

The matching solution uses the laravel service container to inject (bind) a matcher implementation. This way, the matching solution can be modified or changed in isolation. The classes of interest are:

1. `App\Matchers\AgentContactMatcher`
2. `App\Matchers\ZipCodeDistanceMatcher`
3. `App\Providers\AppServiceProvider`

### The UI and authentication logic

For the sake of simplicity, all the UI and authentication logic was based on the Laravel default templates and behavior.

Here, the classes of interest are:

1. `App\Http\Controllers\MatchesController`
2. `App\Http\Controllers\UserDetailsController`

As it was asked, only the agents can register and login to the system, however the agents can't modify their information.

### Data seed

During the seeding process, a Contact is created for each possible zip code. This is done so that this assessment can be easily tested.  

### Unit testing

The only class that was tested, was the one directly related to the solution of the problem.

Tha class of interest is:

1. `Tests\Unit\ZipCodeDistanceMatcherTest`

### Things to improve

If this project were to be deployed in to a real application, I would suggest the following improvements:

1. Instead of a fixed list of zip codes geolocations, use a geolocation api. For example, [the google geolocation API](https://developers.google.com/maps/documentation/geolocation/intro).
2. Completely separate the backend form the frontend and use an stateless api to communicate between them.
3. Define a better matching algorithm.
4. Create a new section for the Contacts. 
5. Allow registered users to edit their information.
6. Code testing coverage of at least 70%.



  