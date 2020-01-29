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

**Update your .env with redis container IP**
```
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
symfony serve
```

Now, you have a node server running on `http://localhost:3000/`
