## Development

Run docker container
```shell
docker run --rm -it --name php-redis -v $PWD:/home/php-redis $(docker build -q .)
```

Run tests on the container
```shell
docker exec -it php-redis composer test
```
