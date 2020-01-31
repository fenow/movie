# Da movie Game

## Install
**Run redis container**
```
docker run --name my-redis -d redis
```

**Get Redis container IP**
```
docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' my-redis
```

**Create and update your .env with redis container IP**
```
cp .env.example .env
REDIS_URL=redis://172.17.0.2
```

**Backend part**
```
cd hexagon && composer install
symfony serve
```

Now, you have a PHP server running on `http://localhost:8000/`

**Frontend part**
```
cd ../front && yarn
yarn start
```

Now, you have a node server running on `http://localhost:3000/`

## Let's play and enjoy
**Url to play**: `http://localhost:3000/`

**Documentation for API**: `http://localhost:8000/api/doc`

**Warning**: Duning the first game, first question will a litle bit long to display. Indeed, we have to populate Redis with questions.

## Improvements in future lots

- i18n in ReactApp
- Work with rabbit MQ to asynchrone populating when system detect less than 5 questions stored
- Manage users and question consuming by user
