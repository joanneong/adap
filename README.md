# Attack and Defence for Access Points 

## Table of Contents
- [Setting up](#setting-up)
- [Using this repository](#using-this-repository)
- [Running this application](#running-this-application)

## Setting up

The steps in this section only have to be done once.

##### Download the Bitnami software

Download the M/W/LAPP stack according to your system:
- (Mac) MAPP 7.1.23-0 (64-bit): https://bitnami.com/stack/mapp/installer
- (Windows) WAPP 7.1.23-0 (64-bit): https://bitnami.com/stack/wapp/installer
- (Linux) LAPP 7.1.23-0 (64-bit): https://bitnami.com/stack/lapp/installer

Follow the steps in [bitnami.pdf](bitnami.pdf) Step 2.

For standardisation:
- Simply install the Varnish and PhpPgAdmin components, and disregard the rest
- Set 123 as the PostgreSQL postgres user password

##### Download pgAdmin4

Ignore Step 3. Proceed to Step 4, but install pgAdmin4-3.4 instead of pgAdmin4-1.6.
- Follow steps a) to f)
- In step g), change the database name to "adap" instead of "Project1"
- Ignore all the remaining steps after g)

##### Link adap to apache2 server

1. In the MAPP/WAPP/LAPP application, navigate to the `apache2` folder.
2. Navigate to the `conf` folder.
3. Navigate to the `bitnami` folder.
4. Open `bitnami-apps-prefix.conf` in any text editor (e.g. VS Code) and copy and paste the following line to the end of the file:

Include "/Applications/mappstack-7.1.23-0/apps/adap/conf/httpd-prefix.conf"

5. Save the file.

##### Get `psycopg2` for python initialiser

`psycopg2` has these pre-requisites:
- A C compiler (e.g. gcc/clang)
- Python header files
- `libpq` header files
- Python 2.7/ Python 3 from versions 3.4 to 3.7
- PostgreSQL server versions from 7.4 to 10
- PostgreSQL client library version from 9.1

For Mac users, you can follow these steps:
1. `brew install postgresql`
2. `gem install pg`
3. `pip install psycopg2-binary`

For Windows users, you can follow these steps:
1. `python -m pip install -U pip`
2. `python -m pip install psycopg2-binary`

Please check the [psycopg installation page](http://initd.org/psycopg/docs/install.html#install-from-source) for more details.

##### Get `json` files for CVE database

1. Go to https://nvd.nist.gov/vuln/data-feeds#JSON_FEED
2. Download the `.zip` files for `CVE-Modified`, `CVE-Recent`, `CVE-2018`...`CVE-2012` (inclusive).
3. Unzip the files.
4. Shift the extracted `json` files into a folder named `json` in the `init` folder (i.e. on the same level as the `sql` folder).
5. Save a copy of the `json` folder locally (i.e. in some other location) so that you can just copy this folder in future.

Note that this is needed because the `.json` files are too large to be stored using GitHub, and using [GitHub Large File Storage](https://git-lfs.github.com/) somehow freezes things up.

## Using this repository

The steps in this section can be executed whenever there are updates to this repository.

When there are changes to the `attack.sh` file:
1. Get the latest changes locally using `git pull`.
2. Navigate to the project folder.
3. Run by doing `./attack.sh`.

When there are changes to the `init` folder:
1. Get the latest changes locally using `git pull`.

When there are changes to the `adap` folder:
1. Get the latest changes locally using `git pull`.
2. In your application, navigate into the `apps` folder.
3. Replace the `adap` folder.
4. Restart the servers using `manager-osx` (for example).
5. Go to `localhost:8080/adap` to view the site.

Before inter-page routing is completed, individual pages can be accessed by heading to `localhost:8080/adap/<filename>`.

## Running this application

To run this application:
1. `cd` into the `init` folder, and run the Python script to initalise the database:

`python initialise_db.py`

The script will run for approximately 2.5 minutes. This is because it is loading ~5 years worth of CVE data into the database. As it runs, there will be status messages printed to the console/terminal; these are intended for debugging and reassurance that the program is still running.

If the script is running too quickly (e.g. done in 10 seconds), check that your `json` folder is not empty!

2. Restart the servers using `manager-osx` (for example).
3. [Optional] Verify that the information has been updated by checking the database tables via pgAdmin4
4. Go to `localhost:8080/adap/login.php` (for now) to view the site.
5. You can use the test account with username `cs3235@gmail.com` and password `123` to test the application.
