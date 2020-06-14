# Interaktyvios technologijos
#####Mykolas Vitkus IFF-7/1 2020

## How to run
To build and run this application your system must have docker with docker-compose installed and enabled

https://docs.docker.com/get-docker/

If you have docker installed, simply run this command from root project directory

``$ docker-compose up -d``

After executing this command(it can take some time to finish), 3 containers should be initialized and running (client, server and mongodb)

Application is then accessible on port `3001` and Admin panel on port `8080`

To load some test data into your application run this command:

``$ docker-compose exec server composer reset-db``
