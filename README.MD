# Da movie Game

## Install
**Run redis container**
```
docker run --name my-redis -d redis
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
