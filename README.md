# Attack and Defence for Access Points 

## Table of Contents
- [Setting up](#setting-up)
- [Using this repository](#using-this-repository)

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

## Using this repository

The steps in this section can be executed whenever there are updates to this repository.

When there are changes to the `attack.sh` file:
1. Get the latest changes locally using `git pull`.
2. Navigate to the project folder.
3. Run by doing `./attack.sh`.

When there are changes to the `SQL` folder:
1. Get the latest changes locally using `git pull`. Alternatively, you can just copy and paste the commands directly from GitHub.
2. Copy and paste the commands into pgAdmin4 before using the application.

When there are changes to the `adap` folder:
1. Get the latest changes locally using `git pull`.
2. In your application, navigate into the `apps` folder.
3. Replace the `adap` folder.
4. Restart the servers using `manager-osx` (for example).
5. Go to `localhost:8080/adap` to view the site.

Before inter-page routing is completed, individual pages can be accessed by heading to `localhost:8080/adap/<filename>`.
